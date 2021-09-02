<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public function getAll() {
        $cart = [];
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        }
        return $cart;
    }


    public function getTotalItem() {
        $totalItem = 0;
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $array = [];
            foreach($cart as $item) {
                $array[] = $item["mID"];
            }
            $totalItem = count(array_unique($array));
        }
        return $totalItem;
    }

    public function getTotalQuantity() {
        $totalQtt = 0;
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $array = [];
            foreach($cart as $item) {
                $array[] = (int)$item["mQtt"];
            }
            $totalQtt = array_sum($array);
        }
        return $totalQtt;
    }

    public function getTotalPrice() {
        $totalPrice = 0;
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $array = [];
            foreach($cart as $item) {
                $price = (float)$item['mPrice'];
                $quantity = (int)$item['mQtt'];
                $array[] = $price*$quantity;
            }
            $totalPrice = array_sum($array);
        }
        return $totalPrice;
    }


    // STORE TO CART
    public function storeCart($dataRaw) {
        $items = [];
        $id = $dataRaw['ssID'];
        $items['ssID'] = $dataRaw['ssID'];
        $items['mID'] = $dataRaw['mID'];
        $items['mName'] = $dataRaw['mName'];
        $items['mPrice'] = $dataRaw['mPrice'];
        $items['mQtt'] = $dataRaw['mQtt'];
        $items['mNote'] = $dataRaw['mNote'];

        $cart = Session::get('cart');
        $cart[$id] = $items;
        Session::put('cart', $cart);
    }
    

    // UPDATE CART
    public function updateCart($dataRaw, $id) {
        $cart = [];
        if(Session::has('cart'))
        {
            $cart = Session::get('cart');
            $newQtt = $dataRaw['newQtt'];
            $items = [];
            foreach ($cart as $item) {
                if ($item['ssID'] == $id) {
                    $item['mQtt'] = $newQtt;
                    $items = $item;
                }
            }
            $cart[$id] = $items;
            Session::put('cart', $cart);
        }
        return $cart;
    }


    // REMOVE ITEM FROM CART
    public function removeCart($id) {
        $cart = [];
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
        return $cart;
    }


    // CLEAR CART
    public function clearCart() {
        if(Session::has('cart'))
        {
            Session::pull('cart');
        }
    }

}
