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
        $count = $table->count();
        
        if (!empty ($option['offset'])) {
            $table->skip($option['offset']);
        }
        if (!empty ($option['limit'])) {
            $table->take($option['limit']);
        }
        if (!empty($option['order']) && is_array($option['order'])) {
            $table->orderBy(array_keys($option['order'])[0], array_values($option['order'])[0]);
        }
        var_dump($table->toSql());
        $result = $table->get();
        return [$count, $result];
    }
    
    /**
     * Get count orders by input params
     * @param array $whereArr
     * @param array $joinsArr
     * @return int
     */
    public function getCountResult($arrWhere){
        $option = array(
            'fields' => array('count(id) as count'),
            'conditions' => $arrWhere,
        );
        $data =  $this->find('all', $option);
        return $data[0]['count'];
    }
}
