<?php

namespace App\Forms\Admin;
use App\Forms\BaseForm;

class OrderForm extends BaseForm {
    /**
     * @return array
     */
    protected function rules(){
        $rules = [
            'product_code'              => ['required'],
            'order_customer_name'       => ['required'],
            'order_phone'               => [''],
            'order_email'               => ['required','integer','min:1','max:3'],
            'order_ship_address'        => ['required'],
            'order_ship_city'           => ['required'],
            'order_status'              => ['required','integer'],
            'payment_method'    => ['integer'],
            'order_note'           => ['required'],
            'quantity'          => ['required','numeric','min:0'],
        ];
        return $rules;
    }
    
    protected function setAttributeNames(){
        return array(
            'product_name'              => 'Tên sản phẩm',
            'product_code'              => 'Mã sản phẩm',
            'product_category'          => 'Loại sản phẩm',
            'product_image'             => 'Ảnh sản phẩm',
            'product_other_image_1'     => 'Ảnh sản phẩm',
            'product_other_image_2'     => 'Ảnh sản phẩm',
            'product_other_image_3'     => 'Ảnh sản phẩm',
            'product_other_image_4'     => 'Ảnh sản phẩm',
            'product_status'            => 'Trạng thái sản phẩm',
            'product_short_description' => 'Mô tả ngắn về sản phẩm',
            'product_description'       => 'Mô tả sản phẩm',
            'product_price'             => 'Giá sản phẩm',
            'product_discount_price'    => 'Giá khi đã giảm giá',
            'product_quantity'          => 'Số lượng',
            'product_display'           => 'Hiển thị sản phẩm',
            'product_sell_status'       => 'Trạng thái bán hàng',
        );
    }
}
