<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Cart extends Controller
{
    // SHOW CART
    public function index() {

        // dump(session()->all());
        $cart = Session::get('cart');
        $items = $cart;
        $data['items'] = $items;

        return view('cart', $data);
    }

    
    // ADD ITEM TO CART
    public function add(Request $request) {

        $products = [];
        $id=$request->ssID;
        $products['ssID'] = $request->ssID;
        $products['mID'] = $request->mID;
        $products['mName'] = $request->mName;
        $products['mPrice'] = $request->mPrice;
        $products['mQtt'] = $request->mQtt;
        $products['mNote'] = $request->mNote;

        $cart = Session::get('cart');
        $cart[$id] = $products;

        Session::put('cart', $cart);

        return redirect('cart');
    }


    // UPDATE CART
    public function update(Request $request, $id) {

        if(Session::has('cart'))
        {
            $cart = Session::get('cart');
            $newQtt = $request->newQtt;
            $items = [];
            foreach ($cart as $item) {
                if ($item['ssID'] == $id) {
                    $item['mQtt'] = $newQtt;
                    $items = $item;
                }
            }
            $cart[$id] = $items;
            Session::put('cart', $cart);
            return Response::json($cart);
        }
    }


    // REMOVE ITEM FROM CART
    public function remove(Request $request, $id) {

        if(Session::has('cart'))
        {
            $cart = Session::get('cart');
            $items = [];
            foreach ($cart as $item) {
                if ($item['ssID'] != $id) {
                    $items[] = $item;
                }
            }
            Session::forget('cart');
            $cart = Session::get('cart');
            foreach ($items as $item) {
                $cart[$item['ssID']] = $item;
                Session::put('cart', $cart);
            }
        }
        return Response::json($cart);
    }

    
    // CLEAR CART
    public function clear() {

        if(Session::has('cart'))
        {
            Session::pull('cart');
        }
        return view('cart');
    }

}
