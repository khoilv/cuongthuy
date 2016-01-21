<?php

namespace App\Models\Admin;

use App\Models\Admin\OrderModel;
use App\Models\Admin\OrderDetailModel;

class StaticModel {

    private $orderModel;
    private $orderDetailModel;
    private $arrId;
    
    public function __construct() {
        $this->orderModel = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
    }

    public function getStatic($option) {
        $startDate = isset($option['start_date']) ? $option['start_date'] : '';
        $endDate = isset($option['end_date']) ? $option['end_date'] : '';
        $this->arrId = $this->orderModel->getArrOrderId($startDate, $endDate);
        $revenue = $this->orderDetailModel->getOrderDetailByArrayId($this->arrId);
        return [$revenue, count($this->arrId)];
    }

    public function getProductList($option) {
        var_dump($this->arrId);
        return $this->orderDetailModel->getOrderProductDetail($this->arrId);
//        $this->arrId
//        $startDate = isset($option['start_date']) ? $option['start_date'] : '';
//        $endDate = isset($option['end_date']) ? $option['end_date'] : '';
//        $arrId = $this->orderModel->getArrOrderId($startDate, $endDate);
    }
    
//    public function countProductList($option) {
//        
//    }

}
