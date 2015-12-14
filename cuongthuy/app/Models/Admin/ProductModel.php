<?php
namespace App\Models\Admin;
use App\Models\TableBase;
class ProductModel extends TableBase {

    protected $table = 'products';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }
    
    public function getProductById($id){
        $options = array(
            'fields' => array('*'),
            'conditions' => array('id' => $id)
        );
        return $this->find('first', $options);
    }

    /**
     * Get list product by input params
     * @param array $whereArr
     * @param array $limitArr
     * @param array $joinsArr
     * @return array
     */

    public function getProductList($whereArr, $limitArr) {
        $options = array(
            'fields' => array('id,product_code,product_name,product_category,product_price,product_status,product_quantity'),
            'conditions' => $whereArr,
            'limit' => $limitArr
        );
        return $this->find('all', $options);
    }

    /**
     * Get count product  by input params
     * @param array $whereArr
     * @param array $joinsArr
     * @return int
     */
    public function getCountResult($arrWhere){
        $option = array(
            'fields' => array('count(products.id) as count'),
            'conditions' => $arrWhere,
        );
        $data =  $this->find('all', $option);
        return $data[0]['count'];
    }
}