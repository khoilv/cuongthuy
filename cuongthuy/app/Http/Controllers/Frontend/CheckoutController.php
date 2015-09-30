<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller {
    
    public function getIndex () {
        return $this->getDelivery();
    }
    
    public function getDelivery () {
        return view('Frontend.delivery');
    }
}
