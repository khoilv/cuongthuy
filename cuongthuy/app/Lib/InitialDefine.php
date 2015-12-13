<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/07
 */
namespace App\Lib;

class InitialDefine {
    
    public static $arrayOderStatus = array (
        1 => 'Đang chờ',
        2 => 'Đang xử lý',
        3 => 'Đã xử lý xong',
        4 => 'Đơn hàng bị hủy'
    );
    
    public static function selectValue ($key, $arrayValue) {
        if ($arrayValue[$key] != null) {
            return $arrayValue[$key];
        }
    }
}
