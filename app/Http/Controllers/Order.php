<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class Order extends Controller
{
    public function shareKey() {
        $cart = new Cart();
        $totalItem = $cart->getTotalItem();
        $totalQuantity = $cart->getTotalQuantity();
        $totalPrice = $cart->getTotalPrice();
        view()->share('totalItem', $totalItem);
        view()->share('totalQuantity', $totalQuantity);
        view()->share('totalPrice', $totalPrice);
    }

    public function index() {
        $this->shareKey();
        // dump(session()->all());
        $products = DB::table('t_products')->get();
        return view('order', compact('products'));
    }

    public function openmodal($id) {
        $products = DB::table('t_products')->find($id);
        return response()->json($products);
    }
}
