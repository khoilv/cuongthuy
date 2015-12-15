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
        $orderDetail = $this->oderDetailObj->getOrderDetailByOrderId($id);
        
        $arrProducts = array();
        
        foreach ($orderDetail as $value) {
            $arrProducts[$value['product_id']] = $this->productsObj->getProductbyID($value['product_id']);
        }
        
        $data = file_get_contents('public/data/city.dat');
        $arrCity = explode(",", $data);
//        $options['conditions'] = array('id' => array());
//        $arrProducts = $this->productsObj->getProductAdmin();
        
        //dd();
        //DB::table('products')->where('id', Input::get('product_id'))->get();

        return view('Admin.order.detail', compact('order', 'orderDetail', 'arrProducts', 'arrCity'));
    }
    
    private function makeSearchResult () {
        
    }
}

