<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
class MaintenanceController extends Controller
{

    public function index()
    {
        $message = '';
        $tmpArr = array("<br>" => "\n");
        if (file_exists("public/data/maintenance.dat")) {
            list($start_date, $end_date, $message) = file("public/data/maintenance.dat", FILE_IGNORE_NEW_LINES);
        }
        $message = strtr($message, $tmpArr);
        return view('Frontend/maintenance',[
            'message' => $message
        ]);
    }
}