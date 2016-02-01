<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/18
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\MyOrderDetailModel;
use App\Models\Frontend\ProductModel;
use Input;
use DB;
use Session;

class MyOrderDetailController extends Controller {

    private $model;
    private $proModel;

    public function __construct() {
        $this->model = new MyOrderDetailModel();
        $this->proModel = new ProductModel();
    }

    public function getIndex() {
        if (Input::has('order_id')) {
            $customerInfo = DB::table('customers')
                    ->select('id')
                    ->where('customer_email', Session::get('customer_email'))
                    ->first();
            $arrOrderCus = $this->model->getOrderByCustomer($customerInfo['id']);
            if (!empty($arrOrderCus)) {
                $check = false;
                $id = Input::get('order_id');
                foreach ($arrOrderCus as $value) {
                    if ($id == $value['id']) {
                        $check = true;
                    }
                }
                if ($check) {
                    $orderDetail = $this->model->getOrderDetail($id);
                    foreach ($orderDetail as $key => $value) {
                        $orderDetail[$key]['detail'] = $this->proModel->getProductById($value['product_id']);
                    }
                    
                    BaseController::$title = 'Chi tiết đơn hàng';
                    return view('Frontend.my_order_detail', compact('orderDetail', 'id'));
                }
            }
        }
        abort(404);
    }

}
