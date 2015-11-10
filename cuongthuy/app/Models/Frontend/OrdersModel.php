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
    
    public function checkOrderCode($orderCode){
        $options = array(
            'fields' => array('id'),
            'conditions' => array(
                'order_code' => $orderCode,
            )
        );
        return $this->find('all', $options);
    }
}