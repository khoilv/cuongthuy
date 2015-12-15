<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\OrderModel;

class OrderController extends Controller {
    
    private $model;
    
    public function __construct() {
        $this->model = new OrderModel();
    }
    
    public function getIndex () {
        return view('Admin.order.index');
    }
    
    public function getSearch () {
        $options['order'] = array('id DESC');
        $orders = $this->model->getOrders('all', $options);
        
        return view('Admin.order.search', compact('orders'));
    }
    
    public function postSearch () {
        return view('Admin.order.search');
    }
}

