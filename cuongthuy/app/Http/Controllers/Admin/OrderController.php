<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\OrderModel;
use App\Models\Admin\OrderDetailModel;
use App\Models\Frontend\ProductModel;

class OrderController extends Controller {
    
    private $model;
    
    private $oderDetailObj;
    
    private $productsObj;
    
    public function __construct() {
        $this->model = new OrderModel();
        $this->oderDetailObj = new OrderDetailModel();
        $this->productsObj = new ProductModel();
    }
    
    public function getIndex () {
        return view('Admin.order.index');
    }
    
    public function getSearch () {
        $options['order'] = array('id DESC');
        $orders = $this->model->getOrders('all', $options);
        
        return view('Admin.order.search', compact('orders'));
    }
    
//    public function postSearch () {
//        return view('Admin.order.search');
//    }
    
    public function getDetail ($id) {

        if (empty ($id)) {
            abort(404);
        }
        
        $order = $this->model->getOrderById($id);
        $orderDetail = $this->oderDetailObj->getOrderDetailById($id);
        $arrProducts = $this->productsObj->getProductList();
        
        //dd();
        //DB::table('products')->where('id', Input::get('product_id'))->get();
        
        

        return view('Admin.order.detail', compact('order', 'orderDetail'));
//        abort(404);
//        return view('Admin.order.search');
    }
    
    private function makeSearchResult () {
        
    }
}

