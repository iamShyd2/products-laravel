<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $products = Product::shortage()->get();
        return view("home.index", ["products" => $products]);
    }

}
