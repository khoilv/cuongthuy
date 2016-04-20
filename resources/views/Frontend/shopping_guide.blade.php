<?php
    use App\Http\Controllers\Frontend\BaseController;
    BaseController::$title = 'Hướng dẫn mua hàng';
?>
@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="wrap suport" style="line-height:25px;">
    <h1 style="text-align:center;padding:20px 0;">Hướng dẫn mua hàng</h1>
	<h2 style="text-decoration:underline;color:#029fd3;">Cách 1 : Mua sản phẩm trên website</h2>
    <h3>Bước 1:　Chọn sản phẩm</h3>
    <p>Quý khách click vào mua hàng từ trang chủ / trang Thông tin sản phẩm hoặc trang Giở hàng</p>
    <img src="{!!Asset('public/images/img16.jpg')!!}">
    <h3>Bước 2:　Nhập thông tin liên hệ và địa chỉ nhận hàng</h3>
    <img src="{!!Asset('public/images/img17.jpg')!!}">
    <h3>Bước 3:　Chọn hình thức nhận hàng</h3>
    <p>Quý khách Chọn 1 trong 2 hình thức nhận hàng<br> - Giao hàng tận nhà <br> - Đến trực tiếp cửa hàng</p>  
    <img src="{!!Asset('public/images/img18.jpg')!!}">
    <h3>Bước 4:　Xác nhận đơn hàng</h3>
    <img src="{!!Asset('public/images/img19.jpg')!!}">
	
	<h2 style="text-decoration:underline;color:#029fd3;">Cách 2 : Mua sản phẩm tại cửa hàng</h2><br>
	<p>Bạn có thể đến trực tiếp tại cửa hàng để xem và chọn lựa sản phẩm
		<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Địa chỉ :</b> Số 31 - Vương Thừa Vũ - Quận.Thanh Xuân - Hà Nội.
		<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Thời gian mở cửa :</b> 24h tất cả các ngày trong tuần.
		<br><br>
		<div class="map2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8005398974337!2d105.82023421407582!3d21.00063109411576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac85c54a62f1%3A0x12d0d05337be4b5d!2zMzEgVsawxqFuZyBUaOG7q2EgVsWpLCBLaMawxqFuZyBUaMaw4bujbmcsIFRoYW5oIFh1w6JuLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1445021066100" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div>
	</p>
</div><!-- end wrap-->
<style>
    .suport h3{padding:35px 0 5px 0;}
    .suport img{width:70%;margin:20px auto; display:block;}
</style>
<!-- InstanceEndEditable -->

<div class="clear"></div>
@endsection