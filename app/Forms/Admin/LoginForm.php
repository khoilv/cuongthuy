<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Forms\Admin;
use App\Forms\BaseForm;

class LoginForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'username' => ['required', 'max:16', 'min:2', 'regex:/\A[a-z\d|_-]+\z/i'],
            'password' => ['required', 'max:64', 'min:6', 'regex:/\A[a-z\d|!?_-]+\z/i'],
            'remember' => 'sometimes|numeric|min:1|max:1'
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'username' => "Tên đăng nhập",
            'password' => "Mật khẩu",
            'remember' => 'remember'
        );
    }
}
