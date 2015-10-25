<?php use App\Http\Controllers\Frontend\BannerController; ?>
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
    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3><br>
    <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br> It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. <br><br>
        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
    </p>
    <div class="avanta_list">
        <ul>
            <li class="f_left">
                <div class="avata f_left"></div>
                <span class="about_bg">"</span>
                <p>Lại Viết Cường</p>
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