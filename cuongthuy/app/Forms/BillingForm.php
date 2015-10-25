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
            'email'         => ['required', 'email'],
            'houseNumber'   => ['required'],
            'street'        => ['required', 'min:1','max:25'],
            'district'      => ['required', 'min:1','max:25']
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'name'          => "Họ tên",
            'address'       => 'Địa chỉ',
            'telephone'     => 'Số điện thoại',
            'street'        => 'Đường phố',
            'email'         => 'Email',
            'houseNumber'   => 'Số nhà',
            'district'      => 'Quận huyện'
        );
    }

}
