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
use App\Lib\InitialDefine;
use Input;
use Redirect;
use DateTime;

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
        $orders = $this->model->getOrderList($option);
        $count = $this->model->getCountOrderList($option);
        return view('Admin.order.search', compact('orders', 'input', 'count'));
    }
    
    public function postSearch () {
        $input = Input::except('_token');
        
        var_dump($input);
        $option = [];
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
            $option['order'] = ['id' => $input['order_sort']];
        }
        if ($input['order_date_start']) {
            $option['arrWhereStart'] = ['order_date' => date_format(DateTime::createFromFormat('d/m/Y', $input['order_date_start']), "Y:m:d")];
        }
        if ($input['order_date_end']) {
            $option['arrWhereEnd'] = ['order_date' => date_format(DateTime::createFromFormat('d/m/Y', $input['order_date_end']), "Y:m:d")];
        }
        $option['limit'] = 25;
        if (isset($input['page'])) {
            $option['offset'] = $option['limit']*$input['page'];
        }

        $orders = $this->model->getOrderList($option);
        $count = $this->model->getCountOrderList($option);
        var_dump($count);
        
        if (Input::has('cmd') && Input::get('cmd') == 'csv_download') {
            $csvOrders = $this->model->getAllOrderList($option);
//            dd($csvOrders);
            $strCSV = '';
            $strCSV .= "Id\tMã đơn hàng\tThời gian đặt hàng\tSố điện thoại\tTên khách hàng\tTrạng thái đơn hàng";
            $strCSV .= "\n";
            foreach ($csvOrders as $line) {
                unset ($line['customer_id']);
                unset ($line['order_email']);
                unset ($line['order_ship_city']);
                unset ($line['order_ship_address']);
                unset ($line['order_note']);
                unset ($line['payment_method']);
                unset ($line['date_time_last_modify']);
                $line['order_status'] = InitialDefine::$arrayOderStatus[$line['order_status']];
//                dd($line['order_status']);
                $strCSV .= implode("\t", $line);
                $strCSV.= "\r\n";
            }
            $strCSV = mb_convert_encoding($strCSV, 'UTF-16LE', "UTF-8");
            $filename = 'order_data_' . date('YmdHis') . '.csv';
            $strFileName = mb_convert_encoding($filename, "UTF-8");
            $intLen = strlen($strCSV);
            header("Cache-Control: public");
            header("Pragma: public");
            header("Content-Disposition: attachment; filename={$strFileName}");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Type: application/download; name={$strFileName}");
            header("Content-Length: {$intLen}");
            echo chr(255) . chr(254) . $strCSV;
            exit;
        }
        
        return view('Admin.order.search', compact('orders', 'input'));
    }
}

