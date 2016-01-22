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
            $('#customer_form').submit();
        });
    });
</script>
<p id="pankuzu"><a href="../top">TOP</a> &gt; <a href="index">Danh sách khách hàng</a></p>
<h2 id="page_midashi_02">Danh sách khách hàng</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL color_red">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    {!! Form::open(['method' => 'POST', 'url' => 'admin/customer/index', 'id' => 'customer_form', 'name' => 'form1']) !!}
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Họ tên</th>
            <td colspan="3">
                {!! Form::text('customer_name', isset($input['customer_name'])? $input['customer_name']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('customer_name'))<p style="color: red">{!! $errors->first('customer_name') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Điện thoại</th>
            <td colspan="3">
                {!! Form::text('customer_phone', isset($input['customer_phone'])? $input['customer_phone']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('customer_phone'))<p style="color: red">{!! $errors->first('customer_phone') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Email</th>
            <td colspan="3">
                {!! Form::text('customer_email', isset($input['customer_email'])? $input['customer_email']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('customer_email'))<p style="color: red">{!! $errors->first('customer_email') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Mã khách hàng</th>
            <td colspan="3">
                {!! Form::text('customer_code', isset($input['customer_code'])? $input['customer_code']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('customer_code'))<p style="color: red">{!! $errors->first('customer_code') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Số khách hàng hiển thị</th>
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
    <p class="mb15" style="color:red">※ Click vào mã khách hàng để xem các đơn hàng của khách hàng này.</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th width='5%'>STT</th>
                <th width='20%'>Họ và tên</th>
                <th width='15%'>Email</th>
                <th width='15%'>Điện thoại</th>
                <th width='20%'>Mã khách hàng</th>
                <th width='25%'>Địa chỉ</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($customers) && (count($customers) > 0))
            @foreach ($customers as $key => $customer)
            <tr class="table_list bg_yellow">
                <td class="bold">{!!$offset+$key+1!!}</td>
                <td><p class="alignC">{!!$customer['customer_name']!!}</p></td>
                <td class="color_blue bold"><p class="alignC">{!!$customer['customer_email']!!}</p></td>
                <td class="bold">{!!$customer['customer_phone']!!}</td>
                <td><a href="{!!action('Admin\OrderController@search', array('customer_id' => $customer['id']))!!}">{!!$customer['customer_code']!!}<a></td>
                <td><p class="lh12 alignC">
                    @if (isset($customer['customer_city']))
                        {!!$customer['customer_address']!!}, {!!$customer['customer_city']!!}
                    @else
                         {!!$customer['customer_address']!!}
                    @endif
                    </p></td>
            </tr>
            @endforeach
            @else
            <tr class="table_list bg_yellow">
                <td colspan="6"><p class='alignC'>Không có khách hàng nào thỏa mãn<p></td>
            </tr>
            @endif
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
              @include('Admin.customer.list_page')
          <?php } ?>
        </div>
        @if ($lastPage > 1)
        <p class="alignC mt10">（{!! $maxRec * ($currentPage -1)  !!}～{!! $maxRec * $currentPage  !!}）</p>
        @endif
    </div>
</div>
@endsection