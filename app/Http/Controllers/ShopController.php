<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
   public function index()
   {
      $products = Product::all();

      return view('shop.index', compact('products'));
   }

   public function singleProduct($id)
   {
      $product = Product::where('id', $id)->first();

      return view('shop.singleProduct', compact('product'));
   }

   public function orderProduct($id)
   {
      return view('shop.orderProduct');
   }




   //Example
   public function indexProba()
   {

      return view('welcome2');
   }
}
