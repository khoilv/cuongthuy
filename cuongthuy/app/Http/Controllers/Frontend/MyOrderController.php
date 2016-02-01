<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2016/01/25
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\OrdersModel;
use App\Models\Frontend\CustomersModel;
use App\Lib\InitialDefine;
use Input;
use Session;
use Redirect;
class MyOrderController extends Controller {

    private $model;
    static $ORDER_MAX = 10;
    private $cusModel;

    public function __construct() {
        $this->model = new OrdersModel();
        $this->cusModel = new CustomersModel();
    }

    public function getIndex() {
        if (!Session::has('customer_email')) {
            return Redirect::action('Frontend\TopController@getIndex');
        }
        $customerInfo = $this->cusModel->getUserByEmail(Session::get('customer_email'));
        $customerId =  $customerInfo['id'];
        if (Input::has('page')) {
            $page = Input::get('page');
        } else {
            $page = 1;
        }
        $totalRecord = $this->model->getCountOrderOfCustomer($customerId);
        $maxRec = self::$ORDER_MAX;
        $offset = ($page - 1) * $maxRec;
        $lastPage = ceil($totalRecord / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
        $limitArr = array($offset, $maxRec);
        $arrOrderList = $this->model->getOrderListByCustomer($customerId,$limitArr);
        foreach ($arrOrderList as $key => $val) {
            $arrDate = explode(' ',$val['order_date']);
            $arrOrderList[$key]['order_date'] = $arrDate;
            $arrOrderList[$key]['order_status'] = InitialDefine::$arrayOderStatus[$val['order_status']];
        }
        BaseController::$title = 'My Order';
        return view('Frontend/my_account/my_order', [
            'arrOrderList' => $arrOrderList,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage,
        ]);
    }
}