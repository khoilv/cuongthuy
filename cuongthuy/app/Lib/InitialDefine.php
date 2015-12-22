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
    
    public static $arrCity = array (
        1 => 'Hà Nội',
        2 => 'TP HCM',
        3 => 'Hải Phòng',
        4 => 'Đà Nẵng',
        5 => 'Cần Thơ',
        6 => 'An Giang',
        7 => 'Bà Rịa - Vũng Tàu',
        8 => 'Bắc Giang',
        9 => 'Bắc Kạn',
        10 => 'Bạc Liêu',
        11 => 'Bắc Ninh',
        12 => 'Bến Tre',
        13 => 'Bình Định',
        14 => 'Bình Dương',
        15 => 'Bình Phước',
        16 => 'Bình Thuận',
        17 => 'Cà Mau',
        18 => 'Cao Bằng',
        19 => 'Đắk Lắk',
        20 => 'Đắk Nông',
        21 => 'Điện Biên',
        22 => 'Đồng Nai',
        23 => 'Đồng Tháp',
        24 => 'Gia Lai',
        25 => 'Hà Giang',
        26 => 'Hà Nam',
        27 => 'Hà Tĩnh',
        28 => 'Hải Dương',
        29 => 'Hậu Giang',
        30 => 'Hòa Bình',
        31 => 'Hưng Yên',
        32 => 'Khánh Hòa',
        33 => 'Kiên Giang',
        34 => 'Kon Tum',
        35 => 'Lai Châu',
        36 => 'Lâm Đồng',
        37 => 'Lạng Sơn',
        38 => 'Lào Cai',
        39 => 'Long An',
        40 => 'Nam Định',
        41 => 'Nghệ An',
        42 => 'Ninh Bình',
        43 => 'Ninh Thuận',
        44 => 'Phú Thọ',
        45 => 'Quảng Bình',
        46 => 'Quảng Nam',
        47 => 'Quảng Ngãi',
        48 => 'Quảng Ninh',
        49 => 'Quảng Trị',
        50 => 'Sóc Trăng',
        51 => 'Sơn La',
        52 => 'Tây Ninh',
        53 => 'Thái Bình',
        54 => 'Thái Nguyên',
        55 => 'Thanh Hóa',
        56 => 'Thừa Thiên Huế',
        57 => 'Tiền Giang',
        58 => 'Trà Vinh',
        59 => 'Tuyên Quang',
        60 => 'Vĩnh Long',
        61 => 'Vĩnh Phúc',
        62 => 'Yên Bái',
        63 => 'Phú Yên'
    );
    
    public static function selectValue($key, $arrayValue) {
        if (isset ($arrayValue[$key]) && $arrayValue[$key] != null) {
            return $arrayValue[$key];
        }
    }

}
