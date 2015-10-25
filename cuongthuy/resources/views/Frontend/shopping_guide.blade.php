@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="wrap suport">
    <h1 style="text-align:center;padding:20px 0;">Hướng dẫn mua hàng</h1>
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
</div><!-- end wrap-->
<style>
    .suport h3{padding:35px 0 5px 0;}
    .suport img{width:70%;margin:20px auto; display:block;}
</style>
<!-- InstanceEndEditable -->

<div class="clear"></div>
@endsection