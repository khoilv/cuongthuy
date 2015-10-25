<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Forms;
use App\Forms\BaseForm;

class RegisterForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'username' => ['required', 'min:1','max:25'],
            'password' => ['required', 'max:20', 'min:6', 'regex:/\A[a-z\d|!?_-]+\z/i'],
            'password_confirm' => ['required','same:password'],
            'address' => ['max:255'],
            'phone' => ['regex:/^([0-9\s\-\+\(\)]*)$/','min:9','max:11'],
            'email' => ['required','email']
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'username' => "Họ tên",
            'password' => 'Mật khẩu',
            'password_confirm' => "Mật khẩu",
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'email' => 'Email'
        );
    }

}
