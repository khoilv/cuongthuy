<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Input;
use Session;
use Redirect;
use DB;

class FrameRelativeProductsController extends Controller {
    
    public static function getProducts ($category) {
        $relativeProducts = DB::table('products')->where('product_category', $category)->take(10)->get();
        return view('Frontend.relative_products', compact('relativeProducts'));
    }
    
}
