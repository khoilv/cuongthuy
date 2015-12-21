<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Forms\Admin;
use App\Forms\BaseForm;

class MaintenanceForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'start_date' => "Ngày bắt đầu",
            'end_date' => "Ngày kết thúc",
        );
    }
}
