<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Input;
use Session;
use Redirect;

class CheckoutController extends Controller {
    
    public function getIndex () {
        return $this->getBilling();
    }
    
    public function getBilling () {
        $billSession = Session::get('billing');
        if ($billSession) {
            $billing = $billSession;
        } else if (Session::get('user_name')) {
            $billSession = Session::get('user_name');
//            $billing = Session::get('user_name');
            $billing = $billSession;
        }
        return view('Frontend.billing', compact('billing'));
    }
    
    public function postBilling () {
        if (Input::has('submit')) {
//            $billing = Session::get('billing');
            $data = Input::all();
            var_dump($data);
            Session::put('billing', $data);
        }
        return Redirect::to('checkout/shipping');
//        return $this->getShipping();
    }
    
    public function getShipping () {
        return view('Frontend.shipping');
    }
}
