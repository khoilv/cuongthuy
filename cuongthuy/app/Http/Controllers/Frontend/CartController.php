<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use DB;
use Input;
use Request;
use Session;

class CartController extends Controller {

    public function getIndex() {
        $cart = Session::get('cart');
        $item = array_keys($cart);
        $products = DB::table('products')->whereIn('product_id', $item)->get();

        return view('Frontend.cart', compact('products', 'cart'));
    }

    public function updateCart() {
        if(Request::ajax()) {
            $cart = Session::get('cart');
            $data = Input::all();
            
            $result['linePrice'] = $data['quantity'] * $data['product_price'];
            $result['totalPrice'] = $data['total_price'] + 
                    ($data['quantity'] - $cart[$data['product_id']])* $data['product_price'] ;
            //update session cart
            $cart[$data['product_id']] = $data['quantity'];
            Session::put('cart', $cart);
            $result['totalCart'] = self::getCart();
            return (json_encode($result));
        }
    }
    
    public function deleteCart() {
        if(Request::ajax()) {
            $cart = Session::get('cart');
            $data = Input::all();
            
            $result['totalPrice'] = $data['total_price'] - $data['quantity'] * $data['product_price'] ;
            
            //update session cart
            unset ($cart[$data['product_id']]);
            Session::put('cart', $cart);
            $result['totalCart'] = self::getCart();
            return (json_encode($result));
        }
    }
    
    public function addCart() {
        $cart = Session::get('cart');
        $data = Input::all();
        if (isset($cart[$data['product_id']])) {
            $cart[$data['product_id']] += 1;
        } else {
            $cart[$data['product_id']] = 1;
        }
        $total = array_sum($cart);
        Session::put('cart', $cart);
        
        return ($total);
    }
    
    public static function getCart() {
        $cart = Session::get('cart');
        if ($cart) {
            $totalCart = array_sum($cart);
            return "($totalCart)";
        }
    }

}
