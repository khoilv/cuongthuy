<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/10/25
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;
use DB;

class FrameRelativeProductsController extends Controller {
    
    public static function getDetailRelativeProducts ($category) {
//        $relativeProducts = DB::table('products')->where('product_category', $category)->take(10)->get();
        
        $productCls = new ProductModel();
        $whereArr = array();
        $whereArr = array('categories.id' => $categoryId);
        $joinsArr = array();
        $limitArr = array(0, 10);
        $arrProductList  = $productCls->getProductList($whereArr, $limitArr, $joinsArr);
        var_dump($relativeProducts);
//        if(count($relativeProducts) < 10) {
//            var_dump("test1");
//            $productAdding = 10 - count($relativeProducts);
//            $parrentCategory = DB::table('categories')->where('id', $category)->pluck('category_parent');
//            var_dump($category);
//            var_dump($parrentCategory);
//            if($parrentCategory) {
//                var_dump('test');
//                $relativeProducts2 = DB::table('products')->where('product_category', $category)->take($productAdding)->get();
//                var_dump($relativeProducts2);
//            }
////            $relativeProducts = array_merge($relativeProducts, $parrentCategory);
//        }
//        var_dump($relativeProducts);
        return view('Frontend.relative_products', compact('relativeProducts'));
    }
    
    public static function getCartRelativeProducts () {
        $arrCart = Session::get('cart');
        
        
        var_dump(Session::get('cart'));
        
        return view('Frontend.relative_products');
        //return view('Frontend.relative_products', compact('relativeProducts'));
    }
}
