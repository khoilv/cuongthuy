<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\OrderModel;
use App\Forms\FormValidationException;
use App\Forms\Admin\OrderForm;
use Input;
use Redirect;

class OrderController extends Controller {
    
    private $model;
    
    public function __construct(OrderForm $orderForm) {
        $this->model = new OrderModel();
        $this->orderForm = $orderForm;
    }
    
    public function getIndex () {
        return view('Admin.order.index');
    }
    
    public function getSearch () {
        $option['order'] = ['id' => 'DESC'];
        list($count,$orders) = $this->model->getOrderList($option);
        $input = Input::get();
        
        var_dump($input);
        $option = [];
        if (!empty($input)) {
            if ($input['order_code']) {
                $option['arrWhereLike'][] = ['order_code' => $input['order_code']];
            }
            if ($input['order_customer_name']) {
                $option['arrWhereLike'][] = ['order_customer_name' => $input['order_customer_name']];
            }
            if ($input['order_status']) {
                $option['arrWhere'][] = ['order_status' => $input['order_status']];
            }
            if ($input['order_phone']) {
                $option['arrWhere'][] = ['order_phone' => $input['order_phone']];
            }
            if ($input['order_sort']) {
                var_dump("nhu cac");
                $option['order'] = ['id' => $input['order_sort']];
            }
            if ($input['order_date_start']) {
                $a = date_create($input['order_date_start']);
                $b = date_create($a);
                dd($b);
//                $option['arrWhereStart'] = ['order_date' => date_format(date_create($input['order_date_start']), "Y:m:d")];
            }
            if ($input['order_date_end']) {
//                $option['arrWhereEnd'] = ['order_date' => date_format(date_create($input['order_date_end']), "Y:m:d")];
            }
            $option['limit'] = 25;
            if (isset($input['page'])) {
                $option['offset'] = $option['limit']*$input['page'];
            }
            
            list($count,$orders) = $this->model->getOrderList($option);
        }
        
        return view('Admin.order.search', compact('orders', 'input'));
    }
}

