<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Input;
use Session;
use Redirect;
use DB;

class CheckoutController extends Controller {
    
    public function getIndex () {
        return $this->getBilling();
    }
    
    public function getBilling () {
        if (Session::get('billing')) {
            $billing = Session::get('billing');
        } else if (Session::get('customer_email')) {
            $emailSession = Session::get('customer_email');
            $customerInfo = DB::table('customers')->where('customer_email', $emailSession)->get();
            var_dump($customerInfo);
//            echo $customerInfo[0]->customer_phone;
            $billing = array(
                'name'          => $customerInfo[0]->customer_name,
                'telephone'     => $customerInfo[0]->customer_phone,
                'email'         => $customerInfo[0]->customer_email,
                'city'          => $customerInfo[0]->customer_city
            );
        }
        return view('Frontend.billing', compact('billing'));
    }
    
    public function postBilling () {
        if (Input::has('submit')) {
            $data = Input::all();
            $data['billing'] = true;
            Session::put('billing', $data);
        } elseif (Input::has('reset')){
//            Session::put('billing', null);
            Session::forget('billing');
            return view('Frontend.billing');
        }
        return Redirect::to('checkout/shipping');
    }
    
    public function getShipping () {
        $billing = Session::get('billing');
        if ($billing['billing']) {
            return view('Frontend.shipping'); 
        } else {
            return Redirect::to('checkout/billing');
        }
    }
    
    public function postShipping () {
        return Redirect::to('checkout/confirm');
    }
    
    public function getConfirm () {
        return view('Frontend.confirm');
    }
}
