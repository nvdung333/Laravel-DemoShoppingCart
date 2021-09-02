<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', "App\Http\Controllers\OrderController@index");
Route::get('/cart', "App\Http\Controllers\CartController@index");
Route::get('/cart/add/{id?}', "App\Http\Controllers\CartController@add");
Route::post('/cart/store/', 'App\Http\Controllers\CartController@store');
Route::put('/cart/update/{id}', 'App\Http\Controllers\CartController@update');
Route::put('/cart/remove/{id}', 'App\Http\Controllers\CartController@remove');
Route::get('/cart/clear/', 'App\Http\Controllers\CartController@clear');


// Check Session
use Illuminate\Support\Facades\Session;
Route::get('session', function() {
    dump(session()->all());
});


// CheckModel
use App\Models\Cart;
Route::get('model', function(){
    $cart = new Cart();
    $v1 = $cart->getTotalItem();
    $v2 = $cart->getTotalQuantity();
    $v3 = $cart->getTotalPrice();

    echo "<pre>";
    echo "Total item: ".$v1;
    echo "<br>Total quantity: ".$v2;
    echo "<br>Total price: ".$v3;
    echo "</pre>";
});
