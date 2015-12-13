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
	
	public function getOrderDetailById ($id) {
		$options = array(
			'fields' => array('*'),
			'conditions' => array('id' => $id),
		);
        $result = $this->find('first', $options);
        
        return ($result);
	}
}