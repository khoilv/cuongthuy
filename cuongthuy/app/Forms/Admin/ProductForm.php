<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/12/05
 */
namespace App\Forms\Admin;
use App\Forms\BaseForm;

class ProductForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'product_name' => ['required'],
            'product_code' => ['required'],
            'product_category' => ['required','integer'],
            'product_image' => ['image'],
            'product_other_image_1' => ['image'],
            'product_other_image_2' => ['image'],
            'product_other_image_3' => ['image'],
            'product_other_image_4' => ['image'],
            'product_status' => ['required','integer','min:1','max:3'],
            'product_short_description' => ['required'],
            'product_description' => ['required'],
            'product_price' => ['required','integer'],
            'product_discount_price' => ['integer'],
            'product_quantity' => ['required','numeric','min:0'],
            'product_display' => ['required'],
            'product_sell_status' => ['required','array'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'product_name' => 'Tên sản phẩm',
            'product_code' => 'Mã sản phẩm',
            'product_category' => 'Loại sản phẩm',
            'product_image' => 'Ảnh sản phẩm',
            'product_other_image_1' => 'Ảnh sản phẩm',
            'product_other_image_2' => 'Ảnh sản phẩm',
            'product_other_image_3' => 'Ảnh sản phẩm',
            'product_other_image_4' => 'Ảnh sản phẩm',
            'product_status' => 'Trạng thái sản phẩm',
            'product_short_description' => 'Mô tả ngắn về sản phẩm',
            'product_description' => 'Mô tả sản phẩm',
            'product_price' => 'Giá sản phẩm',
            'product_discount_price' => 'Giá khi đã giảm giá',
            'product_quantity' => 'Số lượng',
            'product_display' => 'Hiển thị sản phẩm',
            'product_sell_status' => 'Trạng thái bán hàng',
        );
    }
}
