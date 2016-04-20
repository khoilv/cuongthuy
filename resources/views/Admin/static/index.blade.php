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
        
        jQuery.datetimepicker.setLocale('vi');
        $('.default_datetimepicker').datetimepicker({
            format:'d/m/Y',
            formatDate:'d.m.Y',
            timepicker:false,
            timepickerScrollbar:false
        });
        $('#csv_button').click(function() {
            $('#cmd').attr({value: "csv_download"});
            $('#static_form').submit();
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
    <p id="csv_button">Lưu file CSV</p>
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
        <tr class="menu">
            <th>Số sản phẩm hiển thị</th>
            <td>
                {!! Form::select('limit', InitialDefine::$arrLimit, isset($input['limit'])? $input['limit']:'') !!}
                @if ($errors->has('limit'))<p style="color: red">{!! $errors->first('limit') !!}</p>@endif
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
    <p class="mb15" style="color:red">※ Thống kê
    @if(!empty($input['start_date']))
        từ ngày {!!$input['start_date']!!}
    @endif
    @if(!empty($input['end_date']))
        đến ngày {!!$input['end_date']!!}
    @endif
    :</p>
    <table boder="0" class="table_static">
        <thead>
           <tr class="menu">
                <th>Doanh thu:</th>
                <th>Số đơn hàng đã xử lý:</th>
                <th>Số sản phẩm đã bán:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!!number_format ($revenue,0,",",".")!!} đ</td>
                <td>{!!$countOrder!!}</td>
                <td>{!!$countProduct!!}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
           <tr class="menu">
            <th align="center">Tên sản phẩm</th>
            <th align="center">Mã sản phẩm</th>
            <th align="center">Đơn giá (thời điểm mua hàng)</th>
            <th align="center">Số lượng đã bán</th>
            <th align="center">Đơn giá (hiện tại)</th>
            <th align="center">Thành tiền</th>
        </tr>
        </thead>
        <tbody>
            @if (!empty($products))
                @foreach ($products as $key => $value)
                <?php $count = 0 ?>
                    @foreach ($value as $key1 => $value1) 
                    <tr>
                        <?php $count++ ;?>
                            @if ($count == 1)
                            <td rowspan="{!!count($value)!!}" align="center" class="bold">
                                @if(isset ($product2[$key]['product_name']))
                                <a href="{!!Asset('admin/product/detail/'. $key)!!}">
                                    {!!$product2[$key]['product_name']!!}
                                </a>
                                @else
                                    <--Sản phẩm bị xóa hoặc không có tên-->
                                @endif
                            </td>
                            <td rowspan="{!!count($value)!!}" align="center">
                                @if(isset ($product2[$key]['product_code']))
                                <a href="{!!Asset('admin/product/detail/'. $key)!!}">
                                    {!!$product2[$key]['product_code']!!}
                                </a>
                                @else
                                    <--Sản phẩm bị xóa hoặc không có code-->
                                @endif
                            </td>
                            @endif
                            <td align="center">{!!number_format ($key1,0,",",".")!!}</td>
                            <td align="center">{!!$value1['quantity']!!}</td>
                            @if ($count == 1)
                            <td rowspan="{!!count($value)!!}" align="center">{!!@isset ($product2[$key]['product_price']) ? number_format ($product2[$key]['product_price'],0,",","."): '<--Sản phẩm bị xóa hoặc không có giá-->'!!}</td>
                            @endif
                            <td align="center">{!!number_format ($value1['quantity']*$key1,0,",",".")!!}</td>
                    </tr>
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <p class='alignC'>Không có sản phẩm nào được bán trong giai đoạn này</p>
                    </td>
                <tr>
            @endif
        </tbody>
    </table>
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
</div>
@endsection