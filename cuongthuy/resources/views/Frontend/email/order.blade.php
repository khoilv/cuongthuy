<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Xác nhận đặt hàng</title>
        <style>
            *{margin:0 auto;padding:0;}
            body{background-color:#121212;padding:10px;font-family:Arial, tahoma;font-size:15px; line-height:20px;}
            ul li{list-style:none;}
            a{text-decoration:none; color:#007ACC;}
            .wrapper{background-color:#fff; width:90%;padding-bottom:20px;}
            .f_left{float:left;}
            .f_right{float:right;}
            .clear{clear:both;}			
            .content1{
                background:url({!!Asset('public/images/bg.png')!!}) repeat-x bottom left;
            }
            .content1 img{padding:10px 0 20px 10px;}
            .content1 ul{padding-top:80px;}
            .content1 ul li{ float:right;}
            .content1 ul li a{padding:5px 20px;}
            .content2,.content3,.content4{width:80%;margin:20px auto;}
            footer{margin-top:10px;text-align:center;color:#DADADA;font-size:13px;}
            .bs1_bold{font-size:16px;font-weight:bold;padding:15px 0;}	
            .table1{width:100%; border:1px solid #38b54a }
            .table1,.table1 tr,.table1 td{border-collapse:collapse;padding:5px; text-align:center;}
            .table1 thead{background-color:#38b54a;color:#fff;font-weight:bold;}
            .table1 tbody tr:nth-child(even) {background-color: #f3fbf4;}				
            .table2{float:left;}
            .table2 tr > td:nth-child(1){width:40%;}
            .note{
                margin-top:20px;
                font-size:14px;
            }
            .red{color:#da2027;font-weight:bold;}
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="content1">
                <img src="{!!Asset('public/images/logo.png')!!}" class="f_left">
                <ul>
                    <li><a href="{!!action('Frontend\ContactController@getContact')!!}">Liên hệ</a> </li> 
                    <li><a href="{!!action('Frontend\TopController@getIndex')!!}">cuongthuy.vn</a> | </li>

                </ul>
                <div class="clear"></div>
            </div>
            <p class="content2">
                <span style="font-size:18px;font-weight:bold;">Xác nhận đặt hàng thành công !</span> <br><br>
                Chào {!!$billing['name']!!}<br>
                Bạn đã đặt hàng thành công trên Cuongthuy.vn. <br>
                @if($shipping['shipMethod'] == 1)
                    Chúng tôi sẽ gọi điện để xác nhận lại đơn hàng của quý khách,
                    và sẽ giao hàng cho quý khách trong thời gian từ 1-3 ngày làm việc.<br>
                @else
                    Chúng tôi trân trọng mời bạn đến cửa hàng mua các sản phẩm mà bạn đã đặt.
                @endif
                <br>
                Mã đơn hàng : <b>{!!$orderCode!!}</b><br>
                Tình trạng: <b>Đang xác nhận</b>
            </p>
            <div class="content3">
                <p class="bs1_bold">Chi tiết đơn hàng</p>
                <table  class="table1">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Mã sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Đơn giá</td>
                            <td>Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr>
                            <td>{!!$key+1!!}</td>
                            <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product['id']))!!}">{!!$product['product_code']!!}</a></td>
                            <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product['id']))!!}">{!!$product['product_name']!!}</a></td>
                            <td>{!!$productBuy[$product['id']]!!}</td>
                            <td>{!!number_format ($product['product_price'],0,",",".")!!} đ</td>
                            <td>{!!number_format ($product['product_price'] * $productBuy[$product['id']],0,",",".")!!} đ</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" style="color:#da2027; text-align:right; font-weight:bold;">Tổng tiền: {!!number_format($totalOrderPrice,0,",",".")!!} đ</td>
                        </tr>
                    </tbody>
                </table><div class="clear"></div>
                <p class="bs1_bold">Thông tin liên hệ</p>
                <table class="table2">
                    <tr>
                        <td style="width:200px;">Họ và tên :</td>
                        <td>{!!$billing['name']!!}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại :</td>
                        <td>{!!$billing['telephone']!!}</td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>{!!$billing['email']!!}</td>
                    </tr>
                    </table>
                    <div class="clear"></div>
                    <p class="bs1_bold">Địa chỉ nhận hàng</p>
                <table class="table2">
                    <tr>
                        <td style="width:200px;">Số nhà, Đường / phố :</td>
                        <td>{!!$billing['street']!!}</td>
                    </tr>
                    <tr>
                        <td>Phường / Xã :</td>
                        <td>{!!$billing['ward']!!}</td>
                    </tr>
                    <tr>
                        <td>Quận / Huyện :</td>
                        <td>{!!$billing['district']!!}</td>
                    </tr>
                    <tr>
                        <td>Tỉnh thành :</td>
                        <td>{!!$billing['city']!!}</td>
                    </tr>
                </table>
                    @if ($billing['note'])
                    <div class="clear"></div>
                    <p class="bs1_bold">Ghi chú của khách hàng</p>
                    <table class='table2'>
                        <tr>
                            <td style="width:200px;">Ghi chú về đơn hàng:</td>
                            <td>{!!$billing['note']!!}</td>
                        </tr>
                    </table>
                    @endif
                <div class="clear"></div>
                <p class="note">
                    Nếu quý khách cần hỗ trợ, vui lòng gọi <span class="red">(04) 73068386</span> hoặc gửi email đến: <a href="#">laihuycuong1812@gmail.com</a>
                    Cảm ơn Quý khách đã mua sắm trên cuongthuy.vn!
                </p>
            </div>

        </div><!-- end wrap-->
        <footer>
            <b>Copyright © 2015. Bản quyền thuộc Cuongthuy.vn</b><br>
            Địa chỉ : Số 31 Vương Thừa Vũ - Thanh Xuân - Hà Nội<br>
            Tell : 097 123 123 <br>
            Mail : laihuycuong1812@gmail.com<br>
        </footer>
    </body>

</html>
