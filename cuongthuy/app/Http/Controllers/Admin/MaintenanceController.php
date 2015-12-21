<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Forms\Admin\MaintenanceForm;
use App\Forms\FormValidationException;
use Request;
use Redirect;

class MaintenanceController extends Controller
{

    private $form;

    public function __construct(MaintenanceForm $Form)
    {
        $this->form = $Form;
    }

    public function index()
    {
        if (file_exists("public/data/maintenance.dat")) {
            list($start_date, $end_date, $message) = file("public/data/maintenance.dat", FILE_IGNORE_NEW_LINES);
        }
        if (Request::isMethod('post')) {
            $data = Request::except('_token');
            try {
                // Validate
                $this->form->validate($data);
            } catch (FormValidationException $e) {
                Session::flash('msg_error', 'Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới');
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            //save in ini file
            $fp = fopen("public/data/maintenance.dat", "w+");
            fwrite($fp, $data['start_date'] . "\n" . $data['end_date'] . "\n" . $data['message']);
        }
        return view('Admin/maintenance',[
            'end_date' => $end_date,
            'start_date' => $start_date,
            'message' => $message
        ]);
    }

}