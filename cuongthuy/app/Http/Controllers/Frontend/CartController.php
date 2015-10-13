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
        $products = array();
        if ($cart) {
            $item = array_keys($cart);
            $products = DB::table('products')->whereIn('id', $item)->get();
        }
        
        return view('Frontend.cart', compact('products', 'cart'));
    }

    public function updateCart() {
        if(Request::ajax()) {
            $cart = Session::get('cart');
            $data = Input::all();
            
            //update line price
            $productPrice = DB::table('products')->where('id', $data['product_id'])->pluck('product_price');
            $result['linePrice'] = $data['quantity']*$productPrice;
            
            //update session cart
            $cart[$data['product_id']] = $data['quantity'];
            Session::put('cart', $cart);
            
            //get total price and total number product in cart
            $result['totalPrice'] = self::getTotalPriceCart();
            $result['totalCart'] = self::getCart();
            return (json_encode($result));
        }
    }
    
    public function deleteCart() {
        if(Request::ajax()) {
            $cart = Session::get('cart');
            $data = Input::all();
            
            //update session cart
            unset ($cart[$data['product_id']]);
            Session::put('cart', $cart);
            
            //get total price and total number product in cart
            $result['totalPrice'] = self::getTotalPriceCart();
            $result['totalCart'] = self::getCart();
            return (json_encode($result));
        }
    }
    
    public function addCart() {
        if(Request::ajax()) {
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
    }
    
    public static function getTotalPriceCart () {
        $cart = Session::get('cart');
        $totalPrice = 0;
        if ($cart) {
            $item = array_keys($cart);
            $products = DB::table('products')->whereIn('id', $item)->get();
            
            foreach ($products as $product) {
                $totalPrice += $product->product_price*$cart[$product->id];
            }
        }
        return ($totalPrice);
    }
    
    public static function getCart() {
        $cart = Session::get('cart');
        if ($cart) {
            $totalCart = array_sum($cart);
            return "($totalCart)";
        }
    }

}
