<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/21
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\StaticModel;
use Input;
use DateTime;

class StaticController extends Controller {

    private $model;
    private $revenue;
    private $countOrder;
    private $products;
    private $countProduct;
    private $products2;

    public function __construct() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->model = new StaticModel();
    }

    public function index() {

        $input = Input::except('_token');

        $page = 1;
        $option = [];

        if (Input::has('start_date')) {
            $option['start_date'] = date_format(DateTime::createFromFormat('d/m/Y', $input['start_date']), "Y:m:d");
        }
        if (Input::has('end_date')) {
            $option['end_date'] = date_format(DateTime::createFromFormat('d/m/Y', $input['end_date']), "Y:m:d");
        }
        $input['limit'] = isset($input['limit']) ? $input['limit'] : 25;
        $option['limit'] = $maxRec = $input['limit'];

        $option['offset'] = 0;
        if (Input::has('page')) {
            $page = $input['page'];
            $option['offset'] = $option['limit'] * ($input['page'] - 1);
        }

        list($this->revenue, $this->countOrder) = $this->model->getStatic($option);
        list($this->products, $this->countProduct, $this->products2) = $this->model->getProductList($option);
        if (Input::has('cmd') && Input::get('cmd') == 'csv_download') {
            $this->downloadCsv();
        }

        $products = array_slice($this->products, $option['offset'], $option['limit'], true );
        $products2 = array_slice($this->products2, $option['offset'], $option['limit'], true );

        $lastPage = ceil(count($this->products) / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
//var_dump($products);
//        dd($this->products);
        return view('Admin.static.index', [
            'input'         => $input,
            'products'      => $products,
            'revenue'       => $this->revenue,
            'countOrder'    => $this->countOrder,
            'countProduct'  => $this->countProduct,
            'product2'      => $products2,
            'lastPage'      => $lastPage,
            'currentPage'   => $currentPage,
            'previousPage'  => $previousPage,
            'nextPage'      => $nextPage,
            'maxRec'        => $maxRec,
            'offset'        => isset($option['offset']) ? $option['offset'] : 0
        ]);
    }

    private function downloadCsv() {
        $strCSV = '';
        $strCSV .= "Doanh thu\tSố đơn hàng đã xử lý\tSố sản phẩm đã bán\n";
        $strCSV .= $this->revenue . "\t" . $this->countOrder . "\t" . $this->countProduct . "\n\n";
        $strCSV .= "Tên sản phẩm\tMã sản phẩm\tĐơn giá (thời điểm mua hàng)\tSố lượng đã bán\tĐơn giá (hiện tại)\tThành tiền\n";
        foreach ($this->products as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $strCSV .= isset($this->products2[$key]['product_name']) ? $this->products2[$key]['product_name'] . "\t" : "<--Sản phẩm bị xóa hoặc không có tên-->\t";
                $strCSV .= isset($this->products2[$key]['product_code']) ? $this->products2[$key]['product_code'] . "\t" : "<--Sản phẩm bị xóa hoặc không có mã-->\t";
                $strCSV .= $key1 . "\t";
                $strCSV .= $value1['quantity'] . "\t";
                $strCSV .= isset($this->products2[$key]['product_price']) ? $this->products2[$key]['product_price'] . "\t" : "<--Sản phẩm bị xóa hoặc không có giá-->\t";
                $strCSV .= $value1['quantity'] * $key1 . "\t\n";
            }
        }

        $this->makeCsv($strCSV);
        exit;
    }

    private function makeCsv($strCSV) {
        $strCSV = mb_convert_encoding($strCSV, 'UTF-16LE', "UTF-8");
        $filename = 'static_data_' . date('d_m_Y') . '.csv';
        $strFileName = mb_convert_encoding($filename, "UTF-8");
        $intLen = strlen($strCSV);
        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-Disposition: attachment; filename={$strFileName}");
        header("Content-Type: text/csv; charset=UTF-8");
        header("Content-Type: application/download; name={$strFileName}");
        header("Content-Length: {$intLen}");
        echo chr(255) . chr(254) . $strCSV;
    }

}
