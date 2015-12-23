<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Forms\Admin;
use App\Forms\BaseForm;

class BannerForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'banner_status' => ['required','integer','min:1','max:2'],
            'banner_image_path' => ['image'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'banner_status' => "Trạng thái",
            'banner_image_path' => "Ảnh banner",
        );
    }
}
