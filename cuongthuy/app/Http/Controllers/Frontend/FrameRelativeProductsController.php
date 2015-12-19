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
use Input;
use App\Models\Frontend\ProductModel;

class FrameRelativeProductsController extends Controller
{

    public static function getDetailRelativeProducts($categoryId, $productId)
    {
        $productCls = new ProductModel();
        $whereArr = array(
            'product_category' => $categoryId,
            'id NOT IN' => $productId
        );
        $limitArr = array(0, 10);
        $joinsArr = array();
        $relativeProducts = $productCls->getProductList($whereArr, $limitArr, $joinsArr);
        if (count($relativeProducts) < 10) {
            $productAdding = 10 - count($relativeProducts);
            $parrentCategory = DB::table('categories')->where('id', $categoryId)->pluck('category_parent');
            if ($parrentCategory) {
                $whereArr['product_category'] = $parrentCategory;
                $limitArr = array(0, $productAdding);
                $relativeProducts2 = $productCls->getProductList($whereArr, $limitArr, $joinsArr);
                if ($relativeProducts2) {
                    $relativeProducts = $relativeProducts + $relativeProducts2;
                }
            }
        }
        return view('Frontend.relative_products', compact('relativeProducts'));
    }

    public static function getCartRelativeProducts()
    {
        $arrCart = Session::get('cart');
        $relativeProducts = array();
        if (!empty($arrCart)) {
            $arrProductId = array_keys($arrCart);
            $productCls = new ProductModel();
            $arrProducts = $productCls->getProductList(array('products.id' => $arrProductId), array(), array());
            $arrCategoryId = array();
            foreach ($arrProducts as $key => $val) {
                $arrCategoryId[] = $val['product_category'];
            }
            $whereArr = array(
                'product_category' => $arrCategoryId,
                'id NOT IN' => implode(',', $arrProductId)
            );
            $limitArr = array(0, 10);
            $relativeProducts = $productCls->getProductList($whereArr, $limitArr, array());
            if (count($relativeProducts) < 10) {
                $productAdding = 10 - count($relativeProducts);
                $parrentCategory = DB::table('categories')->whereIn('id', $arrCategoryId)->lists('category_parent');
                if ($parrentCategory) {
                    $whereArr['product_category'] = $parrentCategory;
                    $limitArr = array(0, $productAdding);
                    $relativeProducts2 = $productCls->getProductList($whereArr, $limitArr, array());
                    if ($relativeProducts2) {
                        $relativeProducts = $relativeProducts + $relativeProducts2;
                    }
                }
            }
        }
        if (!empty($relativeProducts)){
            return view('Frontend.relative_products', compact('relativeProducts'));
        }
    }

}
