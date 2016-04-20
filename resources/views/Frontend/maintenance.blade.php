<?php
    use App\Http\Controllers\Frontend\BaseController;
    BaseController::$title = 'Bảo trì hệ thống';
?>
@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title2">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a>Bảo trì hệ thống</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap">
    <div class="notification_2">
        {!!$message!!}
    </div>
</div>
<!-- InstanceEndEditable -->

<div class="clear"></div>
@endsection