<?php use App\Lib\InitialDefine;
?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<link rel="stylesheet" href="{!!Asset('public/css/jquery.datetimepicker.css')!!}" type="text/css" />
<script src="{!!Asset('public/js/jquery.datetimepicker.full.min.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#search_button').click(function() {
            $('#cmd').attr({value: "search"});
            $('#static_form').submit();
        });
        $('.default_datetimepicker').datetimepicker({
            format:'d/m/Y',
            formatDate:'d.m.Y',
            timepicker:false,
            timepickerScrollbar:false
        });
    });
</script>
<p id="pankuzu"><a href="../top">TOP</a> &gt; <a href="index">Thống kê tình hình kinh doanh</a></p>
<h2 id="page_midashi_02">Thống kê tình hình kinh doanh</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL color_red">
        ※ Nhập ngày tháng để xem các thông số<br />
    </p>
    {!! Form::open(['method' => 'POST', 'url' => 'admin/static/index', 'id' => 'static_form', 'name' => 'form1']) !!}
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Xem theo ngày</th>
            <td>
                    Từ ngày <input type="text" name="start_date" value="{!!isset($input['start_date'])? $input['start_date']:''!!}" class="default_datetimepicker" readonly style='width:100px;'/> 
                    Đến ngày <input type="text" name="end_date" class="default_datetimepicker" value="{!!isset($input['end_date'])? $input['end_date']:''!!}" readonly style='width:100px;'/>
                    <a href="#" onClick="f=document.form1;f['start_date'].value='';f['end_date'].value='';">Xóa ngày tháng</a>
            </td>
        </tr>
    </table>
    <div class="mt15">
        <input id="cmd" type="hidden" name="cmd" value=""/>
        <p id="search_button">Tìm kiếm</p>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
</div>

<div id="bg_blue" class="mt15">
    <p class="mb15" style="color:red">※ Thống kê:</p>
    <table boder="0" class="table_static">
        <thead>
           <tr class="menu">
                <th>Doanh thu:</th>
                <th>Số lượng đơn hàng đã xử lý: </th>
                <th>Số lượng sản phẩm đã bán:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!!$revenue!!} đ</td>
                <td>{!!$countOrder!!}</td>
                <td>{!!$countProduct!!}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
           <tr class="menu">
            <th>Tên sản phẩm</th>
            <th>Số lượng đã bán</th>
            <th>Đơn giá (thời điểm mua hàng)</th>
            <th>Đơn giá (hiện tại)</th>
            <th>Thành tiền</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $value)
            <?php $count = 0 ?>
                @foreach ($value as $key1 => $value1) 
                <tr>
                    <?php $count++ ;?>
                        @if ($count == 1)
                        <td rowspan="{!!count($value)!!}"><a href="{!!Asset('admin/product/detail/'. $key)!!}">{!!@isset ($product2[$key]['product_name']) ? $product2[$key]['product_name'] : '<--Sản phẩm bị xóa hoặc không có giá-->'!!}</a></td>
                        @endif
                        <td>{!!$value1['quantity']!!}</td>
                        <td>{!!$key1!!}</td>
                        @if ($count == 1)
                        <td rowspan="{!!count($value)!!}" >{!!@isset ($product2[$key]['product_price']) ? $product2[$key]['product_price'] : '<--Sản phẩm bị xóa hoặc không có giá-->'!!}</td>
                        @endif
                        <td>{!!$value1['quantity']*$key1!!}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <?php /*
    <div id="tab_area">
        <div id="page_tab">
            <?php if ($lastPage > 1){
                if($lastPage <= 5) {
                   $begin = 1; 
                   $end = $lastPage;
                } else {
                    if($currentPage < 5 ){
                       $begin = 1;
                       $end = 5;
                    } elseif ($currentPage > $lastPage-5) {
                       $begin = $lastPage - 4; 
                       $end = $lastPage;
                    } else {
                       $begin = $currentPage-2; 
                       $end = $currentPage +2;
                    }
                } ?>
              @include('Admin.static.list_page')
          <?php } ?>
        </div>
        @if ($lastPage > 1)
        <p class="alignC mt10">（{!! $maxRec * ($currentPage -1)  !!}～{!! $maxRec * $currentPage  !!}）</p>
        @endif
    </div>
    */ ?>
</div>
@endsection