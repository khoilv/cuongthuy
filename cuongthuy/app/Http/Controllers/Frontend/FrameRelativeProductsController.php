<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Input;
use Session;
use Redirect;
use DB;

class FrameRelativeProductsController extends Controller {
    
    public static function getProducts ($category) {
        var_dump($category);
        //$user = DB::table('products')->where('name', 'John')->first();
        return view('Frontend.RelativeProducts');
    }
    
}
