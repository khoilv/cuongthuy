<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
class ProductModel extends TableBase {

    protected $table = 'products';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }

    /**
     * 
     * @return 
     */
    
    public function getProductList($whereArr, $limitArr,$joinsArr) {
        $options = array(
            'fields' => array('*'),
            'joins' => $joinsArr,
            'conditions' => $whereArr,
            'limit' => $limitArr
        );
        $options['conditions']['product_status'] = 1;
        $options['conditions']['product_display'] = 1;
        return $this->find('all', $options);
    }
    
    public function getProductNew($whereArr,$limitArr) {
        $options = array(
            'fields' => array('*'),
            'conditions' => $whereArr,
            'limit' => $limitArr
        );
        $options['conditions']['product_status'] = 1;
        $options['conditions']['product_display'] = 1;
        $options['conditions']['product_type'] = 1;
        return $this->find('all', $options);
    }
    
    public function getCountResult($arrWhere,$joinsArr)
    {
        $option = array(
            'fields' => array('count(products.id) as count'),
            'conditions' => $arrWhere,
            'joins' => $joinsArr,
        );
        $option['conditions']['product_status'] = 1;
        $option['conditions']['product_display'] = 1;
        $data =  $this->find('all', $option);
        return $data[0]['count'];
    }
}