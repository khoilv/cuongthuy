<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */

namespace App\Lib;

class InitialDefine {

    public static $arrayOderStatus = array(
        1 => 'Đang chờ',
        2 => 'Đang xử lý',
        3 => 'Đã xử lý xong',
        4 => 'Đơn hàng bị hủy'
    );

    public static $arrayPaymentMethod = array (
        1 => 'Giao hàng tận nhà và thanh toán',
        2 => 'Đến cửa hàng mua rồi thanh toán'
    );

    public static $arrProductStatus = array(
        1 => 'Sản phẩm đang bán',
        2 => 'Sản phẩm sắp có hàng',
        3 => 'Sản phẩm hết hàng'
    );

    public static $arrProductSellStatus = array(
        1 => 'Sản phẩm mới',
        2 => 'Sản phẩm bán chạy',
        3 => 'Sản phẩm nổi bật'
    );

    public static function selectValue($key, $arrayValue) {
        if ($arrayValue[$key] != null) {
            return $arrayValue[$key];
        }
    }

}
