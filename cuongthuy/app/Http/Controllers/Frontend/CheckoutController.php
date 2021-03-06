<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/10/9
 */

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

class CheckoutController extends Controller {

    protected $billingForm;

    public function __construct(BillingForm $billingForm) {
        $this->billingForm = $billingForm;
    }

    public function getIndex() {
        return $this->getBilling();
    }

    public function getBilling() {
        if (!CartController::getCart()) {
            return Redirect::to('cart');
        }
        if (Session::get('billing')) {
            $billing = Session::get('billing');
        } else if (Session::get('customer_email')) {
            $customerInfo = DB::table('customers')->where('customer_email', Session::get('customer_email'))->get();
            $billing = array(
                'name' => $customerInfo[0]->customer_name,
                'telephone' => $customerInfo[0]->customer_phone,
                'email' => $customerInfo[0]->customer_email,
                'city' => $customerInfo[0]->customer_city,
            );
        }
        BaseController::$title = 'Thanh toán - Nhập thông tin';

        return view('Frontend.checkout.billing', compact('billing'));
    }

    public function postBilling() {
        if (Input::has('submit')) {
            $data = Input::except('_token');
            try {
                $this->billingForm->validate($data);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            Session::put('billing', $data);
            return Redirect::to('checkout/shipping');
        } elseif (Input::has('reset')) {
            Session::forget('billing');
            return view('Frontend.checkout.billing');
        }
    }

    public function getShipping() {
        $billing = Session::get('billing');
        $shipping = Session::get('shipping');
        if (isset($billing['submit']) && $billing['submit'] && !empty(Session::get('cart'))) {
            BaseController::$title = 'Thanh toán - Chọn hình thức nhận hàng';
            return view('Frontend.checkout.shipping', compact('shipping'));
        } else {
            return Redirect::to('checkout/billing');
        }
    }

    public function postShipping() {
        if (Input::has('submit')) {
            $data = Input::except('_token');
            Session::put('shipping', $data);
        }
        return Redirect::to('checkout/confirm');
    }

    public function getConfirm() {
        $shipping = Session::get('shipping');
        if (isset($shipping['submit']) && $shipping['submit'] && !empty(Session::get('cart'))) {
            $billing = Session::get('billing');
            $cart = Session::get('cart');
            $products = DB::table('products')->whereIn('id', array_keys($cart))->get();
            BaseController::$title = 'Thanh toán - Xác nhận';
            return view('Frontend.checkout.confirm', compact('billing', 'products', 'cart'));
        } else {
            return Redirect::to('checkout/shipping');
        }
    }

    public function postConfirm() {
        Session::put('buy', Session::get('cart'));
        $checkOutObject = new CheckoutModel;
        $result = $checkOutObject->InsertOrder();
        $shipping = Session::get('shipping');

        if ($result) {
            //Clear session
            Session::forget('billing');
            Session::forget('shipping');
            Session::forget('cart');
            Session::forget('buy');

            BaseController::$title = 'Thanh toán - Đặt hàng thành công';
            return view('Frontend.checkout.success_order', compact('shipping'));
        }
    }

}
