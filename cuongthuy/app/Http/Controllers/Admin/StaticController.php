<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/212
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\StaticModel;
use Input;
use DateTime;

class StaticController extends Controller {
    
    private $model;
    private static $PRODUCT_MAX = 25;
    
    public function __construct() {
        $this->model = new StaticModel();
    }
    
    public function index () {
        
        $input = Input::except('_token');

        $page = 1;
        $option = [];
        
        if (Input::has('start_date')) {
            $option['start_date'] = date_format(DateTime::createFromFormat('d/m/Y', $input['start_date']), "Y:m:d");
        }
        if (Input::has('end_date')) {
            $option['end_date'] = date_format(DateTime::createFromFormat('d/m/Y', $input['end_date']), "Y:m:d");
        }
        $option['limit'] = $maxRec = self::$PRODUCT_MAX;
        if (Input::has('page')) {
            $page = $input['page'];
            $option['offset'] = $option['limit']*($input['page'] - 1);
        }
        
        list($revenue, $countOrder) = $this->model->getStatic($option);
        list($products, $countProduct, $products2) = $this->model->getProductList($option);
//        dd($products);
//        $count = $this->model->countProductList($option);
        
        
        /*
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
         */
        return view('Admin.static.index',[
            'input'         => $input,
            'products'      => $products,
            'revenue'       => $revenue,
            'countOrder'    => $countOrder,
            'countProduct'  => $countProduct,
            'product2'      => $products2,
        ]);
        
    }
    
}
