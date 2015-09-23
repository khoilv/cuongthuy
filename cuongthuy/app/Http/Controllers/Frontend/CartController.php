<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller {

    public function getIndex() {
        $_SESSION['cart'] = array(1 => 1, 2 => 2, 3 => 1);
        $item = array_keys($_SESSION['cart']);

        $products = DB::table('products')->whereIn('product_id', $item)->get();

        return view('Frontend.cart', compact('products'));
    }

    public function updateCart() {
        
    }

    public function deleteCart() {
        
    }

    public function addCart() {
        if (isset($_SESSION['cart'][$id])) {
            $quantity = $_SESSION['cart'][$id] + 1;
        } else {
            $quantity = 1;
        }
        $_SESSION['cart'][$id] = $quantity;
    }

}
