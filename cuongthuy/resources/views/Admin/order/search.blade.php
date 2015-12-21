<?php use App\Lib\InitialDefine;
//namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller\Admin\OrderController;
?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<script type="text/javascript">
    $(document).ready(function() {
        $('#search_button').click(function() {
            $('#order_form').submit();
        });
    });
</script>
<p id="pankuzu"><a href="../top">TOP</a> &gt; <a href="index">Quản lí đơn hàng</a> &gt; Tìm kiếm đơn hàng</p>
<h2 id="page_midashi_02">Tìm kiếm đơn hàng</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    <p id="csv_button">Lưu file CSV</p>
    <div class="clear"></div>
    {!! Form::open(['method' => 'GET', 'url' => 'admin/order/search', 'id' => 'order_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Ngày đặt hàng</th>
            <td colspan="3">
                <label><input type="radio" name="sort" id="syoarea" value="ASC" >Thứ tự tăng dần</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="sort" id="syoarea" value="DESC" >Thứ tự giảm dần</label>&nbsp;&nbsp;&nbsp;
                <input type="text" name="order_date_start" class="text" style="width:100px;" />&nbsp;
                ～&nbsp;<input type="text" name="order_date_end" class="text" style="width:100px;" />&nbsp;
            </td>
        </tr>
        <tr class="menu">
            <th>Mã đơn hàng</th>
            <td><input type="text" name="order_code" class="text" style="width:180px;" /></td>
            <th>Trạng thái đơn hàng </th>
            <td>
                {!! Form::select('order_status', InitialDefine::$arrayOderStatus, isset($order['order_status'])? $order['order_status']:'') !!}
                @if ($errors->has('order_status'))<p style="color: red">{!! $errors->first('order_status') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Tên khách hàng</th>
            <td colspan="3">
                {!! Form::text('order_customer_name', isset($order['order_customer_name'])? $order['order_customer_name']:'',['style' => 'width:400px', 'class' => 'text']) !!}
                @if ($errors->has('order_customer_name'))<p style="color: red">{!! $errors->first('order_customer_name') !!}</p>@endif
            </td>
            
        </tr>
        <tr class="menu">
            <th>Điện thoại khách hàng</th>
            <td colspan="3">
                <!--<input type="text" name="order_phone" class="text" style="width:400px;" />-->
                {!! Form::text('order_phone', isset($order['order_phone'])? $order['order_phone']:'',['style' => 'width:400px', 'class' => 'text']) !!}
                @if ($errors->has('order_phone'))<p style="color: red">{!! $errors->first('order_phone') !!}</p>@endif
            </td>
        </tr>
    </table>
    <div class="mt15">
        <p id="search_button">Search</p>
        <!--<input type="submit" id="search_button" value="Search">-->
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
    <!--</form>-->
</div>

<div id="bg_blue" class="mt15">
    <p class="mb15" style="color:red">※ Click vào mã đơn hàng để xem chi tiết đơn hàng.</p>
    <?php /*
    @if (isset ($intItemCount) && $intItemCount)
        全{{ $intItemCount }}件中 {{ $offset+1 }}～
        @if (($intItemCount - $offset) < $limit)
            {{ $intItemCount }}
        @else
            {{ $offset + $limit }}
        @endif
        件
    @endif
    <br />
    @if (isset($pager))
        {{ $pager->appends(array(
                    'limit'                 => $limit,
                    'point_uid'             => $point_uid,
                    'item_master_id'        => $item_master_id, 
                    'item_status'           => $item_status,
                    'item_adlink_pid_select'=> $item_adlink_pid_select,
                    'item_adlink_pid'       => $item_adlink_pid,
                    ))->links() }}
    @endif */ ?>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th>STT</th>
                <th>Thời gian đặt hàng</th>
                <th>Mã đơn hàng</th>
                <th>Trạng thái đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
            <tr class="table_list bg_yellow">
                <td class="bold"><a href="{!!action('Admin\OrderDetailController@getIndex', array('order_id' => $order['id']))!!}">{!!$key+1!!}</a></td>
                <td><span class="lh12">{!!date("H:i:s d-m-Y", strtotime($order['order_date']))!!}</span></td>
                <td class="bold"><a href="{!!action('Admin\OrderDetailController@getIndex', array('order_id' => $order['id']))!!}">{!!$order['order_code']!!}</a></td>
                <td class="color_blue bold">{!!InitialDefine::selectValue($order['order_status'], InitialDefine::$arrayOderStatus)!!}</td>
                <td>{!!$order['order_customer_name']!!}</td>
                <td>{!!$order['order_phone']!!}</td>
            </tr>
            @endforeach
    </table><?php /*
    @if (isset($pager))
        {{ $pager->links() }}
    @endif--}} */ ?>
<!--    <div id="tab_area">
        <div id="page_tab">
            <a href="#" class="tab_off">&lt;&lt;</a>
            <a href="#" class="tab_off">&lt;</a>
            <a href="#" class="tab_off">100</a>
            <a href="#" class="tab_off">101</a>
            <a href="#" class="tab_off">102</a>
            <em>103</em>
            <a href="#" class="tab_off">104</a>
            <a href="#" class="tab_off">105</a>
            <a href="#" class="tab_off">106</a>
            <a href="#" class="tab_off">&gt;</a>
            <a href="#" class="tab_off">&gt;&gt;</a>
        </div>
        <p class="alignC mt10">（1550～1600）</p>
    </div>-->
</div>
@endsection