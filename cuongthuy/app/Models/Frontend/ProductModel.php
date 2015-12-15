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
     * Get list product by input params
     * @param array $whereArr
     * @param array $limitArr
     * @param array $joinsArr
     * @return array
     */

    public function getProductList($whereArr, $limitArr,$joinsArr) {
        $options = array(
            'fields' => array('products.id, product_name,product_image,product_price,product_discount_price,product_category, product_status,product_sell_status'),
            'joins' => $joinsArr,
            'conditions' => $whereArr,
            'limit' => $limitArr
        );
        $options['conditions']['product_display'] = 1;
        return $this->find('all', $options);
    }

    /**
     * Get list product new by input params
     * @param array $whereArr
     * @param array $limitArr
     * @return array
     */
    public function getProductNew($whereArr,$limitArr) {
        $options = array(
            'fields' => array('*'),
            'conditions' => $whereArr,
            'limit' => $limitArr
        );
        $options['conditions']['product_display'] = 1;
        $options['conditions']['product_sell_status LIKE'] = '%1%';
        return $this->find('all', $options);
    }

    /**
     * Get count product  by input params
     * @param array $whereArr
     * @param array $joinsArr
     * @return int
     */
    public function getCountResult($arrWhere,$joinsArr){
        $option = array(
            'fields' => array('count(products.id) as count'),
            'conditions' => $arrWhere,
            'joins' => $joinsArr,
        );
        $option['conditions']['product_display'] = 1;
        $data =  $this->find('all', $option);
        return $data[0]['count'];
    }
}



