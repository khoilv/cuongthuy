<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductModel;
use App\Models\Admin\OrderModel;
use App\Models\Admin\OrderDetailModel;
use App\Models\Admin\CustomerModel;

class TopController extends Controller {
    
    private $productModel;
    
    private $orderModel;
    
    private $customerModel;
    
    private $orderDetailModel;
    
    public function __construct() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
        $this->customerModel = new CustomerModel();
        $this->orderDetailModel = new OrderDetailModel();
    }
    
    public function getIndex() {
        //Number of product
        $countProduct = $this->productModel->getCountResult([]);
        
        //Number of order today
        $today = date("Y:m:d");
        $tomorow = date("Y:m:d", time()+86400);
        $countOrderToday = $this->orderModel->getCountOrderToday($today, $tomorow);
        
        //Revenue in this month
        $arrId = $this->orderModel->getArrOrderId(date('Y:n').':01', date('Y:n').date('t'));
        $curRevenue = $this->orderDetailModel->getOrderDetailByArrayId($arrId);
        
        //Revenue in last month
        $arrId = $this->orderModel->getArrOrderId(date("Y-n-j", strtotime("first day of previous month")), date("Y-n-j", strtotime("last day of previous month")));
        $lastRevenue = $this->orderDetailModel->getOrderDetailByArrayId($arrId);
        
        //Number of customer
        $numberCustomer = $this->customerModel->countNumberCustomer();
        
        return view('Admin/index', compact('countProduct', 'countOrderToday', 'curRevenue', 'lastRevenue', 'numberCustomer'));
    }

}
