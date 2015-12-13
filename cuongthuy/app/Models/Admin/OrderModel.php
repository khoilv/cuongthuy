<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/13
 */
namespace App\Models\Admin;
use App\Models\TableBase;
class OrderModel extends TableBase {

    protected $table = 'orders';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }
    
    public function getOrders ($type, $options = array()) {
        $orders = $this->find($type, $options);
        return $orders;
    }
	
	public function getOrderById ($id) {
		$options = array(
			'fields' => array('*'),
			'conditions' => array('id' => $id),
		);
        $result = $this->find('first', $options);
        
        return ($result);
	}
}