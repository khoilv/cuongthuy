<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Redirect;

class MaintenanceController extends Controller {

    public function index() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $message = '';
        $tmpArr = array("<br>" => "\n");
        if (file_exists("public/data/maintenance.dat")) {
            list($start_date, $end_date, $message) = file("public/data/maintenance.dat", FILE_IGNORE_NEW_LINES);
        }

        if (strtotime($start_date) <= strtotime('now') && strtotime($end_date) >= strtotime('now')) {
            $message = strtr($message, $tmpArr);
            return view('Frontend/maintenance', [
                'message' => $message
            ]);
        } else {
            return Redirect::action('Frontend\TopController@getIndex');
        }
    }

}
