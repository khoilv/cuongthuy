<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CartController;
use App\Forms\BillingForm;
use App\Forms\FormValidationException;
use App\Models\Frontend\CheckoutModel;
use Input;
use Session;
use Redirect;
use DB;
use Mail;

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
                'city'          => $customerInfo[0]->customer_city,
                'customer_id'   => $customerInfo[0]->id
            );
        }
        $data = file_get_contents('public/data/city.dat');
        $arrCity = explode(",", $data);
        
        return view('Frontend.checkout.billing', compact('billing', 'arrCity'));
    }
    
    public function postBilling () {
        if (Input::has('submit')) {
            $data = Input::except('_token');
            try {
                $this->billingForm->validate($data);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            
            Session::put('billing', $data);
            return Redirect::to('checkout/shipping');
        } elseif (Input::has('reset')){
            Session::forget('billing');
            return view('Frontend.checkout.billing');
        }
    }
    
    public function getShipping () {
        $billing = Session::get('billing');
        $shipping = Session::get('shipping');
        if (isset($billing['submit']) && $billing['submit'] && !empty(Session::get('cart'))) {
            return view('Frontend.checkout.shipping', compact('shipping')); 
        } else {
            return Redirect::to('checkout/billing');
        }
    }
    
    public function postShipping () {
        if (Input::has('submit')) {
            $data = Input::except('_token');
            Session::put('shipping', $data);
        }
        return Redirect::to('checkout/confirm');
    }
    
    public function getConfirm () {
        $shipping = Session::get('shipping');
        if (isset($shipping['submit']) && $shipping['submit'] && !empty(Session::get('cart'))) {
            $billing = Session::get('billing');
            $cart = Session::get('cart');
            $products = DB::table('products')->whereIn('id', array_keys($cart))->get();
            return view('Frontend.checkout.confirm', compact('billing', 'products', 'cart'));
        } else {
            return Redirect::to('checkout/shipping');
        }
    }
    
    public function postConfirm () {
        $checkOutObject = new CheckoutModel;
        $result = $checkOutObject->InsertOrder();
        
        //Clear session
        if ($result) {
            Mail::send('Frontend.email.order',
//                'pass'      => $user['customer_password'], 
//                'user_name' => $user['customer_name']],
                compact('result'),
                
                function($message) {
                    $message->from('noreply@cuongthuy.vn', $name = 'cuongthuy.vn');
                    $message->to(Session::get('billing')['email'])->subject('Tiếp nhận đơn hàng');
                }
            );
            
            Session::forget('billing');
            Session::forget('shipping');
            Session::forget('cart');
            
            echo "Đặt hàng thành công. "
            . "Cảm ơn bạn đã mua hàng ở cuongthuy.vn";
        }
    }
    
}
