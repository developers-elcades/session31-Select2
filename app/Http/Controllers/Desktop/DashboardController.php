<?php

namespace Market\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Market\Http\Requests;
use Market\Http\Controllers\Controller;
use Market\Models\Product\Product;


class DashboardController extends Controller
{
    //

   public function __construct()
   {
      //$this->middleware('auth');
   }

   public function index()
   {

         $product = Product::lists('name','id')->prepend('Seleccione');
         return view('dashboard',['product'=>$product]);

   }

   public function modelweb()
   {
      return view('modelweb');
   }

}
