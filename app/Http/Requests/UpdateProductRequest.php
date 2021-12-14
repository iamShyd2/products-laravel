<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{

     public function rules()
     {
         return [
            'name' => 'required|unique:products',
             'cost_price' => 'required',
             'selling_price' => 'required',
             'units' => 'required',
         ];
     }
}
