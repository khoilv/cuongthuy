<?php

namespace App\Forms;
use App\Forms\BaseForm;

class BillingForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'name'          => ['required', 'min:1','max:25'],
            'telephone'     => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/','min:9','max:11'],
            'email'         => ['email'],
            'ward'          => ['required', 'min:1', 'max:50'],
            'street'        => ['required', 'min:1'],
            'district'      => ['required', 'min:1', 'max:50'],
            'city'          => ['required', 'integer', 'min:1','max:63'],
            'note'          => ['min:1','max:1000'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'name'          => "Họ tên",
            'telephone'     => 'Số điện thoại',
            'street'        => 'Số nhà, Đường/phố',
            'email'         => 'Email',
            'ward'          => 'Phường/xã',
            'district'      => 'Quận/huyện',
            'city'          => 'Giá trị tỉnh/thành',
            'note'          => 'Ghi chú'
        );
    }

}
