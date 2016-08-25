<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

   Route::get('/', function () {
       return view('welcome');
   });



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

   Route::group(['middleware' => ['web']], function () {
       //

      Route::auth();
      Route::get('/home', 'HomeController@index');
      route::get('dashboard','Desktop\DashboardController@index');

      //Marcas
      route::resource('mark','Product\MarkController');
      route::get('listallmark/{page?}','Product\MarkController@listall');
      
      // Productos
      route::resource('product','Product\ProductController');
      route::get('listall/{page?}','Product\ProductController@listall');
      route::get('modelweb','Desktop\DashboardController@modelweb');

      /* --------- upload image  ---------- */
      route::get('photo/{page?}','Product\ProductController@photo');
      Route::post('photoproduct','Product\ProductController@update_photo');
      /* --------- upload image  ---------- */
      

   });


