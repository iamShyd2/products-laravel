<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductFeature extends TestCase
{

    public function test_example()
    {
        $response = $this->get(route('products.create'));
        $token = session('_token');
        $this->withSession(['foo' => 'bar']);
        $response = $this->post(route("products.store"), [
          "name" => "Nike Shoes",
          "cost_price" => 20,
          "selling_price" => 10,
          "units" => 2,
          "image" => UploadedFile::fake()->image('photo1.jpg'),
          "_token" => $token,
        ]);

        $this->assertDatabaseHas('products', [
          'name' => 'Nike Shoes'
        ]);

    }
}
