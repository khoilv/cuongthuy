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
            $('#contact_form').submit();
        });
        
        $('#csv_button').click(function() {
            $('#cmd').attr({value: "csv_download"});
            $('#contact_form').submit();
        });
        
        $('.default_datetimepicker').datetimepicker({
            format:'d/m/Y',
            formatDate:'d.m.Y',
            timepicker:false,
            timepickerScrollbar:false
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
    </table>
    <div class="mt15">
        <input id="cmd" type="hidden" name="cmd" value=""/>
        <p id="search_button">Tìm kiếm</p>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
</div>

<div id="bg_blue" class="mt15">
    <p class="mb15" style="color:red">※ Click vào mã khách hàng để xem thông tin chi tiết khách hàng.</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th width='5%'>STT</th>
                <th width='20%'>Họ và tên</th>
                <th width='15%'>Email</th>
                <th width='10%'>Điện thoại</th>
                <th width='13%'>Mã khách hàng</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($customers))
            @foreach ($customers as $key => $customer)
            <tr class="table_list bg_yellow">
                <td class="bold">{{--<a href="{!!action('Admin\ContactDetailController@getIndex', array('contact_id' => $contact->id))!!}">--}}{!!$offset+$key+1!!}{{--</a>--}}</td>
                <td>{{--<a href="{!!action('Admin\ContactDetailController@getIndex', array('contact_id' => $contact['id']))!!}">--}}{!!$contact->contact_name!!}{{--</a>--}}</td>
                <td class="color_blue bold">{!!$contact->contact_email!!}</td>
                <td class="bold">{!!$contact->contact_phone!!}</td>
                <td>{!!date("d-m-Y", strtotime($contact->contact_datetime))!!}</td>
                <td><p class="lh12 alignC"><a href="{!!action('Admin\ContactDetailController@getIndex', array('contact_id' => $contact->id))!!}">
                        </a>
                    </p></td>
            </tr>
            @endforeach
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
              @include('Admin.contact.list_page')
          <?php } ?>
        </div>
        @if ($lastPage > 1)
        <p class="alignC mt10">（{!! $maxRec * ($currentPage -1)  !!}～{!! $maxRec * $currentPage  !!}）</p>
        @endif
    </div>
</div>
@endsection