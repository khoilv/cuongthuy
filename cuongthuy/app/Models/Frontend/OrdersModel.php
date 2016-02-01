<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/10/21
 */

namespace App\Models\Frontend;

use App\Models\TableBase;

class OrdersModel extends TableBase {

    protected $table = 'orders';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }

    public function checkOrderCode($orderCode) {
        $options = array(
            'fields' => array('id'),
            'conditions' => array(
                'order_code' => $orderCode,
            )
        );
        return $this->find('all', $options);
    }
    
    /**
     * Get list order by Customer
     * @param int $customerId
     * @param array $limitArr
     * @return array
     */
    public function getOrderListByCustomer($customerId, $limitArr) {
        $options = array(
            'fields' => array('orders.id','order_code','order_date','order_status','SUM(unitPrice) as totalPrice'),
            'conditions' => array('customer_id' => $customerId),
            'joins' => array(
                    array(
                        'table' => 'orderdetail',
                        'type' => 'LEFT',
                        'conditions' => 'orders.id = orderdetail.order_id'
                    )
                ),
            'group' => array('orders.id'),
            'limit' => $limitArr
        );
        return $this->find('all', $options);
    }
    
    /**
     * Get count order of Customer
     * @param int $customerId
     * @return int
     */
    public function getCountOrderOfCustomer($customerId) {
        $option = array(
            'fields' => array('count(id) as count'),
            'conditions' => array('customer_id' => $customerId)
        );
        $data = $this->find('all', $option);
        return $data[0]['count'];
    }
}
