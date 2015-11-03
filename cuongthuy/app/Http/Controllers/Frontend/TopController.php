<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\CategoryModel;
use App\Models\Frontend\ProductModel;
use App\Models\Frontend\CustomersModel;
use Session;
use Mail;
class TopController extends Controller {

    private static $PRODUCT_MAX = 10;

    public static function getIndex(){
        $categoryCls = new CategoryModel();
        $productCls = new ProductModel();
        $customersModel = new CustomersModel();
        // check if user login later register
        if (Session::has('register_flag')) {
             $data = $customersModel->getUserByEmail(Session::get('customer_email'));
             Mail::send('Frontend.email.register',$data, function($message) use ($data)
             {
                $message->to($data['customer_email'],$data['customer_name'])->subject('Cường thuỷ - Xác nhận đăng kí!');
             });
             Session::forget('register_flag');
        }
        $arrParentList = $categoryCls->getParentList();
        $arrChirdList = $categoryCls->getChildList();
        foreach ($arrParentList as $key => $val) {
            $whereArr = array(
                'OR' => array('categories.id' => $key, 'categories.category_parent' => $key)
            );
            $joinsArr = array(
                array(
                    'table' => 'categories',
                    'type' => 'INNER',
                    'conditions' => 'products.product_category = categories.id'
                )
            );
            $limitArr = array(self::$PRODUCT_MAX);
            $arrProductList[$key] = $productCls->getProductList($whereArr, $limitArr, $joinsArr);
        }
        $arrProductNew = $productCls->getProductNew(array(), array(self::$PRODUCT_MAX));
        return view('Frontend.index', [
            'arrParentList' => $arrParentList,
            'arrChirdList' => $arrChirdList,
            'arrProductList' => $arrProductList,
            'arrProductNew' => $arrProductNew
        ]);
    }

}