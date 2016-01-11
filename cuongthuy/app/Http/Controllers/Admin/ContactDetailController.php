<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/11
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ContactDetailModel;
use Input;

class ContactDetailController extends Controller {

    public function __construct() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->model = new ContactDetailModel();
    }

    public function getIndex() {
        $input = Input::except('_token');
        $orderDetail = $this->model->getOrderDetailById($input['contact_id']);
        return view('Admin.contact.detail', $orderDetail);
    }

}
