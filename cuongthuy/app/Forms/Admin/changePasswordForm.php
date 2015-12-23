<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/23
 */
namespace App\Forms\Admin;
use App\Forms\BaseForm;

class changePasswordForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'old_password'       => ['required', 'max:64', 'regex:/\A[a-z\d|!?_-]+\z/i'],
            'new_password'       => ['required', 'max:64', 'min:8', 'regex:/\A[a-z\d|!?_-]+\z/i'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'old_password' => "Mật khẩu cũ",
            'new_password' => "Mật khẩu",
        );
    }
}
