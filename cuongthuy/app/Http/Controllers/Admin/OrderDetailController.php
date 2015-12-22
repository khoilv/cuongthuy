<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\OrderModel;
use App\Models\Admin\OrderDetailModel;
use App\Models\Admin\ProductModel;
use App\Forms\FormValidationException;
use App\Forms\Admin\OrderDetailForm;
use Input;
use Session;
use Redirect;

class OrderDetailController extends Controller {
    
    private $orderId;
    
    private $order;
    
    private $model;
    
    private $oderDetailObj;
    
    private $orderDetail;
    
    private $productsObj;
    
    private $result;
    
    private $orderDetailForm;
    
    public function __construct(OrderDetailForm $orderDetailForm) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->model = new OrderModel();
        $this->oderDetailObj = new OrderDetailModel();
        $this->productsObj = new ProductModel();
        $this->orderDetailForm = $orderDetailForm;
    }
    
    public function getIndex () {
        $this->init();
        $this->result = $this->makeResult();
        
        return view('Admin.order.detail', $this->result);
    }
    
    public function postIndex () {
        $this->init();
        $input = Input::except('_token');
        
        try {
            $this->orderDetailForm->validate($input);
        } catch (FormValidationException $e) {
            dd($e->getErrors());
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
        
        if (!empty($this->orderDetail)) {
            foreach ($this->orderDetail as $value) {
                $arrUpdate = [
                    'quantity'    =>  $input['quantity'][$value['product_id']],
                ];

                $this->oderDetailObj->update($arrUpdate, array('id' => $value['id']));
            }
        }
        
        unset($input['order_id']);
        unset($input['quantity']);
        $input['customer_id'] = $this->order['customer_id'];
        $input['date_time_last_modify'] = date("Y-m-d H:i:s");
        if ($this->model->update($input, array('id' => $this->orderId))) {
            Session::flash('success', 'Cập nhật đơn hàng thành công!');
        }
        $this->result = $this->makeResult();
        return view('Admin.order.detail', $this->result);
    }
    
    private function makeResult () {
        
        $orderDetail = $this->getOrderDetail();
        $arrProducts = array();
        
        if (!empty($orderDetail)) {
            foreach ($orderDetail as $value) {
                $arrProducts[$value['product_id']] = $this->productsObj->getProductById($value['product_id']);
            }
        }
        return [
            'order'         => $this->getOrder(),
            'orderDetail'   => $this->getOrderDetail(),
            'arrProducts'   => $arrProducts
        ];
    }
    
    private function getOrder () {
        return $this->model->getOrderById($this->orderId);
    }
    
    private function getOrderDetail () {
        return $this->oderDetailObj->getOrderDetailByOrderId($this->orderId);
    }
    
    private function init () {
        $this->orderId = Input::get('order_id');
        if (empty ($this->orderId)) {
            abort(404);
        }
        
        $this->order = $this->getOrder();
        $this->orderDetail = $this->getOrderDetail();
    }
    
    public function postDeleteOrder () {
        $data = Input::all();
        $this->oderDetailObj->deleteOrderDetail($data['id']);
        
        $input['date_time_last_modify'] = date("Y-m-d H:i:s");
        $this->model->update($input, array('id' => $data['order_id']));
        
        return 1;
    }
    
}