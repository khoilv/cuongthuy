<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/01/18
 */

namespace App\Models\Frontend;

use DB;

class MyOrderDetailModel {

    private $table1 = 'orders';
    private $table2 = 'orderdetail';

    public function __construct() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function getOrderById($id) {
        $table = DB::table($this->table1)
                ->select('*')
                ->where('id', $id)
                ->first();
        return (array) $table;
    }

    public function getOrderDetail($order_id) {
        $table = DB::table($this->table2)
                ->select('*')
                ->where('order_id', $order_id)
                ->get();
        return $table;
    }

    public function getOrderByCustomer($customerId) {
        $table = DB::table($this->table1)
                ->select('id')
                ->where('customer_id', $customerId)
                ->get();
        return $table;
    }

}
