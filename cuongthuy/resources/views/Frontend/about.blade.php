<?php 
    use App\Http\Controllers\Frontend\BannerController; 
    use App\Http\Controllers\Frontend\BaseController;
    BaseController::$title = 'Giới thiệu';
?>
@extends('Frontend.layout')
@section('banner')
{!! BannerController::getBanner(); !!}
@endsection
@section('content')
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="#">Giới thiệu</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap about_page">
    <h3>Cường Thủy.vn</h3><br>
    <p style="line-height:20px;">
        myphamtienthoi.vn là sàn giao dịch thương mại điện tử uy tín, là cầu nối thương mại giữa nhà cung cấp với người mua và là nơi cung cấp các sản phẩm chính hãng, sản phẩm siêu sạch với giá cả tốt nhất có thể. 
    </p>
    <div class="avanta_list">
        <ul>
            <li class="f_left">
                <div class="avata f_left"></div>
                <span class="about_bg">"</span>
                <p>Mr. Cường</p>
            </li>
            <li class="f_right">
                <div class="avata f_left"></div>
                <span class="about_bg">"</span>
                <p>Ms. Lệ</p>
            </li>
        </ul>
    </div>
</div><!-- end wrap-->
<div class="clear"></div>
@endsection