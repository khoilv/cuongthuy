@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="#">Xác nhận</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap confimation_order">
    <div class="notification_2">
        <p>Quý khách đã đặt hàng thành công. 
            @if ($shipping['shipMethod'] == 1)
                Thời gian giao hàng dự kiến từ 1-3 ngày làm việc.<br> 
            @else
                Trân trọng mời bạn đến cửa hàng mua sản phẩm.<br> 
            @endif
            <span>Cảm ơn quý khách đã mua hàng tại Cường Thủy.vn !</span>
        </p>
        <a href="{!!action('Frontend\TopController@getIndex')!!}" class="btn_cm">Trở lại trang chủ</a>
    </div>

</div><!-- end wrapp-->
@endsection
