<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class OrderController extends Controller {
    
    public function getIndex () {
        return view('Admin.order.index');
    }
    
    public function getSearch () {
        return view('Admin.order.search');
    }
    
    public function postSearch () {
        return view('Admin.order.search');
    }
    
    public function getDetail () {
        return view('Admin.order.search');
    }
}

