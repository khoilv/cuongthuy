@extends('Admin.layout')
@section('content')
<h2 id="page_midashi_01">Danh mục quản lí</h2>

<div class="top_alert_area mr20">
    <h3 id="page_midashi_01">Tình trạng hàng hoá</h3>
    <p class="alert_red"><a href="{!!Asset('admin/product/search')!!}">Có tất cả {!!$countProduct!!} sản phẩm trong kho！<span class="floatR"><img src="{!!Asset('public/images/admin/alert_blue.png')!!}" /></span></a></p>
</div>

<!--▼ top_alert_area -->
<div class="top_alert_area">
    <h3 id="page_midashi_02">Tình trạng đơn hàng</h3>
    <p class="alert_red"><a href="{!!Asset('admin/order/search')!!}">Có {!!$countOrderToday!!} đơn hàng trong ngày<span class="floatR"><img src="{!!Asset('public/images/admin/alert_blue.png')!!}" /></span></a></p>
</div>
<!--▲ top_alert_area -->

<!--▼ top_alert_area -->
<div class="top_alert_area">
    <h3 id="page_midashi_04">Tình trạng người dùng</h3>
    <p class="alert_normal"><a href="{!!Asset('admin/customer/index')!!}">Tổng số thành viên：{!!$numberCustomer!!} người<span class="floatR"><img src="{!!Asset('public/images/admin/alert_blue.png')!!}" /></span></a></p>
</div>
<!--▲ top_alert_area -->

<div class="top_alert_area mr20">
    <h3 id="page_midashi_05">Tình trạng bán hàng</h3>
    <p class="alert_normal"><a>Số tiền bán hàng tháng này: {!!number_format ($curRevenue,0,",",".")!!}đ<span class="floatR"><img src="{!!Asset('public/images/admin/alert_blue.png')!!}" /></span></a></p>
    <p class="alert_normal"><a>Tổng số tiền bán hàng tháng trước：{!!number_format ($lastRevenue,0,",",".")!!}đ<span class="floatR"><img src="{!!Asset('public/images/admin/alert_blue.png')!!}" /></span></a></p>
</div>
@endsection