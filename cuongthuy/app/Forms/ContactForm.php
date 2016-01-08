<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Forms;
use App\Forms\BaseForm;

class ContactForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'contact_email' => ['required', 'email'],
            'contact_content' => ['required', 'max:3000'],
            'contact_name' => ['required','max:255'],
            'contact_phone' => ['regex:/^([0-9\s\-\+\(\)]*)$/','min:9','max:11'],
            'contact_address' => ['max:500'],
        ];
        return $rules;
    }
    
     protected function setAttributeNames(){
        return array(
            'contact_email' => "Email",
            'contact_content' => "Nội dung",
            'contact_name' => 'Họ tên',
            'contact_phone' => 'Điện thoại',
            'contact_addresst' => 'Địa chỉ'
        );
    }
}
