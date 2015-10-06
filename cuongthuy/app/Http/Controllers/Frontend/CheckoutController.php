<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Input;
use Session;

class CheckoutController extends Controller {
    
    public function getIndex () {
        return $this->getBilling();
    }
    
    public function getBilling () {
        return view('Frontend.billing');
    }
    
    public function postBilling () {
        if (Input::has('submit')) {
//            $billing = Session::get('billing');
            $data = Input::all();
            var_dump($data);
            Session::put('billing', $data);
        }
        return $this->getShipping();
    }
    
    public function getShipping () {
        return view('Frontend.shipping');
    }
}
