<?php

namespace App\Forms\Admin;
use App\Forms\BaseForm;

class OrderDetailForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'order_customer_name'       => ['required'],
            'order_phone'               => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/','min:9','max:11'],
            'order_email'               => ['email'],
            'order_ship_address'        => ['required'],
            'order_ship_city'           => ['required', 'integer', 'min:1','max:63'],
            'order_status'              => ['required', 'integer', 'min:1','max:4'],
            'payment_method'            => ['required', 'integer', 'min:1','max:2'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'order_customer_name'       => 'Tên khách hàng',
            'order_phone'               => 'Số điện thoại',
            'order_email'               => 'Email',
            'order_ship_address'        => 'Địa chỉ',
            'order_ship_city'           => 'Tỉnh/Thành',
            'order_status'              => 'Trạng thái đơn hàng',
            'payment_method'            => 'Phương thức nhận hàng',
        );
    }
}
