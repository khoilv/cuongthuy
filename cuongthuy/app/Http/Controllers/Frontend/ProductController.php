<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\ProductModel;
use App\Models\Frontend\CategoryModel;
use Input;
class ProductController extends Controller {
     private static $PRODUCT_MAX = 3;

     public static function getIndex(){
         $productCls = new ProductModel();
         $categoryCls = new CategoryModel();
         $whereArr = array();
         $joinsArr = array();
         $categoryId = '';
         if (Input::has('category_id')){
            $categoryId = Input::get('category_id');
            if ($categoryId > 0) {
                $whereArr['OR']= array('categories.id' => $categoryId,'categories.category_parent' => $categoryId);
                $joinsArr = array(
                    array(
                    'table'=> 'categories',
                    'type' => 'INNER',
                    'conditions' => 'products.product_category = categories.id'
                    )
                );
            } else {
                $whereArr['product_sell_status LIKE'] = "%1%";
            }
         }
         $searchKey = '';
         $searchValue = '';
         if(Input::has('search_key')) {
             $searchKey = Input::get('search_key');
             if($searchKey == 'newer') {
                 $whereArr['product_sell_status LIKE'] = "%1%";
             } else if ($searchKey == 'hot'){
                 $whereArr['product_sell_status LIKE'] = "%3%";
             } else if ($searchKey == 'sell') {
                 $whereArr['product_sell_status LIKE'] = "%2%";
             } else {
                if(Input::has('search_value')) {
                    $searchValue = Input::get('search_value');
                    $whereArr[$searchKey . ' LIKE'] = "%".$searchValue."%";
                }
             }
         }
         if (Input::has('page')) {
            $page = Input::get('page');
         } else {
             $page = 1;
         }
         $totalRecord = $productCls->getCountResult($whereArr,$joinsArr);
         $maxRec = self::$PRODUCT_MAX;
         $offset = ($page - 1) * $maxRec;
         $lastPage = ceil($totalRecord / $maxRec);
         $currentPage = $page;
         $previousPage = $page > 1 ? $page - 1 : 1;
         $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
         $limitArr = array($offset, $maxRec);
           // $orderArray = array('created_at DESC');
         $arrProductList  = $productCls->getProductList($whereArr, $limitArr, $joinsArr);
         // get category name
         $categoryName = $categoryCls->getCategoryNamebyId($categoryId);
         return view('Frontend.list',[
             'arrProductList' => $arrProductList,
             'currentPage'    => $currentPage,
             'lastPage'       => $lastPage,
             'previousPage'   => $previousPage,
             'nextPage'       => $nextPage,
             'categoryId'     => $categoryId,
             'categoryName'   => $categoryName,
             'search_key'     => $searchKey,
             'search_value'   => $searchValue
         ]);
     }
}