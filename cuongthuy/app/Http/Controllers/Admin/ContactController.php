<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/06
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
//use App\Lib\InitialDefine;
//use Input;
//use DateTime;

class ContactController extends Controller {
    
    private $model;
    private static $CONTACT_MAX = 25;
    
    public function __construct() {
        //$this->model = new ContactModel();
    }
    
    public function index () {/*
        $input = Input::except('_token');
        
        $page = 1;
        $option = [];
        $option['order'] = ['id' => 'DESC'];
        
        if (Input::has('order_code')) {
            $option['arrWhereLike'][] = ['order_code' => $input['order_code']];
        }
        if (Input::has('order_customer_name')) {
            $option['arrWhereLike'][] = ['order_customer_name' => $input['order_customer_name']];
        }
        if (Input::has('order_status')) {
            $option['arrWhere'][] = ['order_status' => $input['order_status']];
        }
        if (Input::has('order_phone')) {
            $option['arrWhere'][] = ['order_phone' => $input['order_phone']];
        }
        if (Input::has('order_sort')) {
            $option['order'] = ['id' => $input['order_sort']];
        }
        if (Input::has('order_date_start')) {
            $option['arrWhereStart'] = ['order_date' => date_format(DateTime::createFromFormat('d/m/Y', $input['order_date_start']), "Y:m:d")];
        }
        if (Input::has('order_date_end')) {
            $option['arrWhereEnd'] = ['order_date' => date_format(DateTime::createFromFormat('d/m/Y', $input['order_date_end']), "Y:m:d")];
        }
        $option['limit'] = $maxRec = self::$ORDER_MAX;
        if (Input::has('page')) {
            $page = $input['page'];
            $option['offset'] = $option['limit']*($input['page'] - 1);
        }

        $orders = $this->model->getOrderList($option);
        $count = $this->model->getCountOrderList($option);
        
        $lastPage = ceil($count / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
        
        return view('Admin.order.search', [
                    'orders'        => $orders,
                    'input'         => $input,
                    'lastPage'      => $lastPage,
                    'currentPage'   => $currentPage,
                    'previousPage'  => $previousPage,
                    'nextPage'      => $nextPage,
                    'maxRec'        => $maxRec,
                    'offset'        => isset($option['offset'])?$option['offset']:0
                ]);
        */
        return view('Admin.contact.index');
    }
    
}
