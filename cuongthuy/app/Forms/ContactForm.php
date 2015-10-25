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
            'contact_content' => ['required'],
            'contact_name' => ['required','max:255'],
        ];
        return $rules;
    }
    
     protected function setAttributeNames(){
        return array(
            'contact_email' => "Email",
            'contact_content' => "Nội dung",
            'contact_name' => 'Họ tên'
        );
    }
}
