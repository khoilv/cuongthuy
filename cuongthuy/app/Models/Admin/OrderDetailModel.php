<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/13
 */

namespace App\Models\Admin;

use App\Models\TableBase;

class OrderDetailModel extends TableBase {

    protected $table = 'orderdetail';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }

    public function getOrderDetailByOrderId($id) {
        $options = array(
            'fields' => array('*'),
            'conditions' => array('order_id' => $id),
        );
        $result = $this->find('all', $options);

        return ($result);
    }
    
}
