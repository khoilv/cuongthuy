<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Forms\Admin\MaintenanceForm;
use App\Forms\FormValidationException;
use Request;
use Redirect;
use Session;

class MaintenanceController extends Controller {

    private $form;

    public function __construct(MaintenanceForm $Form) {
        $this->form = $Form;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function index() {
        $start_date = '';
        $end_date = '';
        $message = '';
        $tmpArr = array("<br>" => "\n");
        if (file_exists("public/data/maintenance.dat")) {
            list($start_date, $end_date, $message) = file("public/data/maintenance.dat", FILE_IGNORE_NEW_LINES);
        }
        $message = strtr($message, $tmpArr);
        if (Request::isMethod('post')) {
            $data = Request::except('_token');
            try {
                $this->form->validate($data);
            } catch (FormValidationException $e) {
                Session::flash('msg_error', 'Đã xảy ra lỗi. Vui lòng kiểm tra các mục bên dưới');
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            if (strtotime($data['start_date']) > strtotime($data['end_date'])) {
                Session::flash('msg_error', 'Ngày bắt đầu không được nhỏ hơn ngày kết thúc. Vui lòng nhập lại.');
                return Redirect::back()->withInput();
            }
            //save in ini file
            $tmpArr = array("\r\n" => "<br>", "\n" => "<br>");
            $data['message'] = stripslashes(strtr($data['message'], $tmpArr));
            $fp = fopen("public/data/maintenance.dat", "w+");
            fwrite($fp, $data['start_date'] . "\n" . $data['end_date'] . "\n" . $data['message']);
            return redirect('admin/maintenance');
        }
        return view('Admin/maintenance', [
            'end_date'      => $end_date,
            'start_date'    => $start_date,
            'message'       => $message
        ]);
    }

}
