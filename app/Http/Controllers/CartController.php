<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    // SHOW CART
    public function index() {
        $cart = new Cart();
        $cart = $cart->getAll();
        $data = [];
        $data['items'] = $cart;
        return view('cart', $data);
    }


    // ADD ITEM TO CART
    public function add($id) {
        $products = DB::table('t_products')->find($id);
        return response()->json($products);
    }
    

    // STORE TO CART
    public function store(Request $request) {
        $cart = new Cart();
        $dataReq = $request->all();
        $cart->storeCart($dataReq);        
        return redirect('cart');
    }


    // UPDATE CART
    public function update(Request $request, $id) {
        $cart = new Cart();
        $dataReq = $request->all();
        $data = $cart->updateCart($dataReq, $id);
        return Response::json($data);
    }


    // REMOVE ITEM FROM CART
    public function remove($id) {
        $cart = new Cart();
        $data = $cart->removeCart($id);
        return Response::json($data);
    }

    
    // CLEAR CART
    public function clear() {
        $cart = new Cart();
        $cart->clearCart();
        return view('cart');
    }

}
