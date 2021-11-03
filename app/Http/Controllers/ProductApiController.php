<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductApiController extends Controller
{
   public function products()
   {
      return response()->json(Product::get(), 200);
   }

   public function singleProduct($id)
   {
      $product = Product::where('id', $id)->first();
      return response()->json($product, 200);
   }

   public function newProduct(Request $request)
   {
      $rules = [
         'title' => 'required|string|min:3',
         'price' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
         return response()->json($validator->errors(), 400);
      }

      $product = Product::create($request->all());
      return response()->json($product, 201);
   }

   public function editProductPosting(Request $request, $id)
   {
      $product = Product::find($id);

      if (!$product) {
         return response()->json(["message" => "Product nema."], 404);
      }

      $product->update($request->all());
      return  response()->json($product, 200);
   }

   public function deleteProduct($id)
   {
      $product = Product::where('id', $id)->first();
      $product->delete();
      return  response()->json(null, 204);
   }
}
