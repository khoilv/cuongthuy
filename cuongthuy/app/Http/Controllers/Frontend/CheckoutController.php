<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CartController;
use App\Forms\BillingForm;
use App\Forms\FormValidationException;
use Input;
use Session;
use Redirect;
use DB;

class CheckoutController extends Controller {
    
    protected $billingForm;
    
    public function __construct(BillingForm $billingForm) {
        $this->billingForm = $billingForm;
    }
    
    public function getIndex () {
        return $this->getBilling();
    }
    
    public function getBilling () {
        if (!CartController::getCart()) {
            return Redirect::to('cart');
        }
        if (Session::get('billing')) {
            $billing = Session::get('billing');
        } else if (Session::get('customer_email')) {
            $customerInfo = DB::table('customers')->where('customer_email', Session::get('customer_email'))->get();
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
            $data = Input::except('_token');
            try {
                // Validate
                $this->billingForm->validate($data);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            
            $data['billing'] = true;
            Session::put('billing', $data);
            return Redirect::to('checkout/shipping');
        } elseif (Input::has('reset')){
            Session::forget('billing');
            return view('Frontend.billing');
        }
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
