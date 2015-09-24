<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\CategoryModel;
use App\Models\Frontend\ProductModel;
class TopController extends Controller {
     public static function getIndex(){
         $categoryCls = new CategoryModel();
         $productCls = new ProductModel();
         $arrParentList = $categoryCls->getParentList();
         $arrChirdList = $categoryCls->getChildList();
         foreach ($arrParentList as $key => $val){
            $whereArr = array(
                'OR' => array('categories.id' => $key,'categories.category_parent' => $key)
            );
            $joinsArr = array(
                array(
                'table'=> 'categories',
                'type' => 'INNER',
                'conditions' => 'products.product_category = categories.id'
                )
            );
            $limitArr = array(10);
            $arrProductList[$key] = $productCls->getProductList($whereArr, $limitArr, $joinsArr);
         }
         $arrProductNew = $productCls->getProductNew(array(), array(10));
         return view('Frontend.index',[
             'arrParentList' => $arrParentList,
             'arrChirdList'  => $arrChirdList,
             'arrProductList' => $arrProductList,
             'arrProductNew' => $arrProductNew
         ]);
     }
}