<?php
    use App\Http\Controllers\Frontend\BaseController;
    BaseController::$title = 'Trang yêu cầu không được tìm thấy';
?>
@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title2">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a>404</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap 404_page ">
    <div class="notification_2">
        <p>
            <span>Chúng tôi không tìm thấy đường dẫn này!</span>
        </p>
        <a href="{!!action('Frontend\TopController@getIndex')!!}" class="btn_cm">Trở lại trang chủ</a>
    </div>
</div>
<!-- InstanceEndEditable -->

<div class="clear"></div>
@endsection