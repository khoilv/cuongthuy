<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/13
 */

namespace App\Models\Admin;

use App\Models\TableBase;
use App\Models\Admin\ProductModel;
use DB;

class OrderDetailModel extends TableBase {

    protected $table = 'orderdetail';
    private $productModel;

    public function __construct() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        parent::__construct();
        $this->setTableName($this->table);
        $this->productModel = new ProductModel();
    }

    public function getOrderDetailByOrderId($id) {
        $options = array(
            'fields' => array('*'),
            'conditions' => array('order_id' => $id),
        );
        $result = $this->find('all', $options);

        return ($result);
    }

    public function deleteOrderDetail($id) {
        DB::table($this->table)->where('id', $id)->delete();
    }

    public function getOrderDetailByArrayId($arrId) {
        $revenue = 0;
        foreach ($arrId as $id) {
            $result = $this->getOrderDetailByOrderId($id);
            foreach ($result as $value) {
                $revenue += $value['unitPrice'] * $value['quantity'];
            }
        }

        return $revenue;
    }

    public function getOrderProductDetail($arrOrderId) {
        $arrProduct = $arrProduct2 = [];
        $productNum = 0;
        foreach ($arrOrderId as $orderId) {
            $arrOrDetail = $this->getOrderDetailByOrderId($orderId);
            foreach ($arrOrDetail as $value) {
                $productNum += $value['quantity'];
                if (isset($arrProduct[$value['product_id']])) {
                    if (isset($arrProduct[$value['product_id']][$value['unitPrice']])) {
                        $arrProduct[$value['product_id']][$value['unitPrice']]['quantity'] += $value['quantity'];
                    } else {
                        $arrProduct[$value['product_id']][$value['unitPrice']]['quantity'] = $value['quantity'];
                    }
                } else {
                    $arrProduct[$value['product_id']][$value['unitPrice']]['quantity'] = $value['quantity'];
                }
            }
        }
        foreach ($arrProduct as $key => $value) {
            $arrProduct2[$key] = $this->productModel->getProductById($key);
        }
        return [$arrProduct, $productNum, $arrProduct2];
    }

}
