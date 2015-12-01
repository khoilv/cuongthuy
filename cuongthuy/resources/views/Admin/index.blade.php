@extends('Admin.layout')
@section('content')
<h2 id="page_midashi_01">Danh mục quản lí</h2>

<div class="top_alert_area mr20">
    <h3 id="page_midashi_01">Tình trạng hàng hoá</h3>
    <p class="alert_red"><a href="product/search.html">Có tất cả 100 sản phẩm trong kho！<span class="floatR"><img src="img/alert_blue.png" /></span></a></p>
</div>

<!--▼ top_alert_area -->
<div class="top_alert_area">
    <h3 id="page_midashi_02">Tình trạng đơn hàng</h3>
    <p class="alert_red"><a href="order/search.html">Có 10 đơn hàng trong ngày<span class="floatR"><img src="img/alert_blue.png" /></span></a></p>
</div>
<!--▲ top_alert_area -->

<!--▼ top_alert_area -->
<div class="top_alert_area">
    <h3 id="page_midashi_04">Tình trạng người dùng</h3>
    <p class="alert_normal"><a href="user/search.html">Tổng số thành viên trong tháng：52 người<span class="floatR"><img src="img/alert_blue.png" /></span></a></p>
    <p class="alert_normal"><a href="user/search.html">Tổng số thành viên：259 người<span class="floatR"><img src="img/alert_blue.png" /></span></a></p>
</div>
<!--▲ top_alert_area -->

<div class="top_alert_area mr20">
    <h3 id="page_midashi_05">Tình trạng bán hàng</h3>
    <p class="alert_normal"><a href="sale/search.html">Số tiền bán hàng tháng này: 5.060.000đ<span class="floatR"><img src="img/alert_blue.png" /></span></a></p>
    <p class="alert_normal"><a href="sale/search.html">Tổng số tiền bán hàng tháng trước：1.034.560đ<span class="floatR"><img src="img/alert_blue.png" /></span></a></p>
</div>
@endsection