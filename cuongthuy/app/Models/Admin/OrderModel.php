<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/13
 */

namespace App\Models\Admin;

use App\Models\TableBase;
use DB;

class OrderModel extends TableBase {

    protected $table = 'orders';

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->setTableName($this->table);
    }

    public function getOrders($type, $options = array()) {
        $orders = $this->find($type, $options);
        return $orders;
    }

    public function getOrderById($id) {
        $options = array(
            'fields' => array('*'),
            'conditions' => array('id' => $id),
        );
        $result = $this->find('first', $options);

        return ($result);
    }
    
    
    public function getOrderList ($option) {
        $table = $this->makeParam($option);
        
        if (!empty ($option['offset'])) {
            $table->skip($option['offset']);
        }
        if (!empty ($option['limit'])) {
            $table->take($option['limit']);
        }
        $result = $table->get();
        return $result;
    }
    
    public function getAllOrderList ($option) {
        $table = $this->makeParam($option);
        $result = $table->get();
        return $result;
    }
    
    public function getCountOrderList ($option) {
        $table = $this->makeParam($option);
        $count = $table->count();
        return $count;
    }
    
    private function makeParam ($option) {
        $table = DB::table($this->table);
        $table->select('*');
        if (!empty($option['arrWhere']) && is_array($option['arrWhere'])) {
            foreach($option['arrWhere'] as $key => $value) {
                $table->where(array_keys($value)[0],array_values($value)[0]) ;
            }
        }
        if (!empty($option['arrWhereLike']) && is_array($option['arrWhereLike'])) {
            foreach($option['arrWhereLike'] as $key => $value) {
                $table->where(array_keys($value)[0],'like' ,'%'.array_values($value)[0].'%') ;
            }
        }
        if (!empty($option['arrWhereStart']) && is_array($option['arrWhereStart'])) {
            $table->where(array_keys($option['arrWhereStart'])[0], '>' , array_values($option['arrWhereStart'])[0]);
        }
        if (!empty($option['arrWhereEnd']) && is_array($option['arrWhereEnd'])) {
            $table->where(array_keys($option['arrWhereEnd'])[0], '<' , array_values($option['arrWhereEnd'])[0]);
        }
        if (!empty($option['order']) && is_array($option['order'])) {
            $table->orderBy(array_keys($option['order'])[0], array_values($option['order'])[0]);
        }
        return $table;
    }
    
    public function getCountOrderToday($today, $tomorow){
        $table = DB::table($this->table);
        $table->select('*');
        $table->where('order_date', '>', "$today 00:00:00");
        $table->where('order_date', '<', "$tomorow 00:00:00");
        $count = $table->count();
        return $count;
    }
    
    public function getArrOrderId ($firstDay, $lastDay) {
        $table = DB::table($this->table);
        $table->select('id');
        if ($firstDay) {
            $table->where('order_date', '>=', "$firstDay 00:00:00");
        }
        if ($lastDay) {
            $table->where('order_date', '<=', "$lastDay 23:59:59");
        }
        $table->where('order_status', 3);
        $result = $table->get();
        $return = [];
        foreach ($result as $value) {
            $return[] = $value['id'];
        }
        return $return;
    }
}
