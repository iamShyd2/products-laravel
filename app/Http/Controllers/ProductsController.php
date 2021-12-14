<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $products = Product::paginate(5);
        return view("products.index", ["products" => $products]);
    }

    public function create()
    {
       return view("products.create");
    }

    public function edit(Product $product)
    {
        return view("products.edit", ["product" => $product]);
    }

    public function store(StoreProductRequest $request)
    {
        $params = $this->buildImage($request);
        $product = Product::create($params);
        if((bool) $product) return $this->redirectToProduct($product, "created");
        return redirect()->route("products.create")->with("error", "Failed to create product");
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $params = $this->buildImage($request);
        if($product->update($params)) return $this->redirectToProduct($product, "updated");
        return redirect()->route("products.edit", [$product])->with("error", "Failed to update product");
    }


    public function show(Product $product)
    {
       return view("products.show", ["product" => $product]);
    }


    public function destroy(Request $request, Product $product)
    {
        $page = $request->page;
        if($product->delete()) return redirect()->route("products.index", ["page" => $page])->with("success", "Product deleted successfully");
        return redirect()->route("products.index", ["page" => $page])->with("error", "Failed to delete product");

    }

    private function buildImage($request)
    {
        // since validation is done we know that its either store or update so we can ignore checking
        $params = $request->all();
        if($request->image)
        {
            $imageName = $params["image"]->getClientOriginalName();
            $params["image"]->move(public_path('images'), $imageName);
            $params["image"] = "/images/$imageName";
        }
        return $params;
    }

    private function redirectToProduct($product, $message)
    {
        return redirect()
                ->route("products.show", [$product])
                ->with("success", "Product $message successfully");
    }
}
