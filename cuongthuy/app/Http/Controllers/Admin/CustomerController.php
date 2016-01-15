<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/06
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\CustomerModel;
use Input;

class CustomerController extends Controller {
    
    private $model;
    private static $CUSTOMER_MAX = 25;
    
    public function __construct() {
        $this->model = new CustomerModel();
    }
    
    public function index () {
        $input = Input::except('_token');
        
        $page = 1;
        $option = [];
        
        if (Input::has('customer_name')) {
            $option['arrWhereLike'][] = ['customer_name' => $input['customer_name']];
        }
        if (Input::has('customer_phone')) {
            $option['arrWhere'][] = ['customer_phone' => $input['customer_phone']];
        }
        if (Input::has('customer_email')) {
            $option['arrWhere'][] = ['customer_email' => $input['customer_email']];
        }
        if (Input::has('customer_code')) {
            $option['arrWhere'][] = ['customer_code' => $input['customer_code']];
        }
        $option['limit'] = $maxRec = self::$CUSTOMER_MAX;
        if (Input::has('page')) {
            $page = $input['page'];
            $option['offset'] = $option['limit']*($input['page'] - 1);
        }

        $customers = $this->model->getCustomerList($option);
        $count = $this->model->getCountCustomerList($option);
        
        $lastPage = ceil($count / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
        return view('Admin.customer.index', [
                    'customers'      => $customers,
                    'input'         => $input,
                    'lastPage'      => $lastPage,
                    'currentPage'   => $currentPage,
                    'previousPage'  => $previousPage,
                    'nextPage'      => $nextPage,
                    'maxRec'        => $maxRec,
                    'offset'        => isset($option['offset'])?$option['offset']:0
                ]);
         
        
    }
    
}
