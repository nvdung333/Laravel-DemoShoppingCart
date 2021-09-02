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
}
