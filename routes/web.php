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


Route::get('/', "App\Http\Controllers\Order@index");
Route::get('/openmodal/{id?}', "App\Http\Controllers\Order@openmodal");
Route::get('/cart', "App\Http\Controllers\Cart@index");

Route::post('/cart/add/', 'App\Http\Controllers\Cart@add');
Route::put('/cart/update/{id}', 'App\Http\Controllers\Cart@update');
Route::put('/cart/remove/{id}', 'App\Http\Controllers\Cart@remove');
Route::get('/cart/clear/', 'App\Http\Controllers\Cart@clear');





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