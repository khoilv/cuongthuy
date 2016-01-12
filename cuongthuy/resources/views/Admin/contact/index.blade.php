<?php use App\Lib\InitialDefine;
use App\Http\Controllers\Controller\Admin\OrderController;
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
<p id="pankuzu"><a href="../top">TOP</a> &gt; <a href="index">Danh sách liên hệ</a></p>
<h2 id="page_midashi_02">Danh sách liên hệ</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL color_red">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    {!! Form::open(['method' => 'POST', 'url' => 'admin/contact/index', 'id' => 'contact_form', 'name' => 'form1']) !!}
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Ngày gửi liên hệ</th>
            <td colspan="3">
                <label><input type="radio" name="contact_sort" value="ASC" @if (isset($input['contact_sort']) && $input['contact_sort'] == "ASC") checked @endif>
                    Thứ tự tăng dần
                </label>
                <label><input type="radio" name="contact_sort" value="DESC" @if (!isset($input['contact_sort']) || (isset($input['contact_sort']) && $input['contact_sort'] == "DESC")) checked @endif>
                    Thứ tự giảm dần
                </label>
                    <input type="text" name="contact_date_start" value="{!!isset($input['contact_date_start'])? $input['contact_date_start']:''!!}" class="default_datetimepicker" readonly style='width:100px;'/> 
                    ~ <input type="text" name="contact_date_end" class="default_datetimepicker" value="{!!isset($input['contact_date_end'])? $input['contact_date_end']:''!!}" readonly style='width:100px;'/>
                    <a href="#" onClick="f=document.form1;f['contact_date_start'].value='';f['contact_date_end'].value='';">Xóa ngày tháng</a>
            </td>
        </tr>
        <tr class="menu">
            <th>Họ tên</th>
            <td colspan="3">
                {!! Form::text('contact_name', isset($input['contact_name'])? $input['contact_name']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('contact_name'))<p style="color: red">{!! $errors->first('contact_name') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Điện thoại</th>
            <td colspan="3">
                {!! Form::text('contact_phone', isset($input['contact_phone'])? $input['contact_phone']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('contact_phone'))<p style="color: red">{!! $errors->first('contact_phone') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Email</th>
            <td colspan="3">
                {!! Form::text('contact_email', isset($input['contact_email'])? $input['contact_email']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('contact_email'))<p style="color: red">{!! $errors->first('contact_email') !!}</p>@endif
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
    <p class="mb15" style="color:red">※ Click vào mã đơn hàng để xem chi tiết đơn hàng.</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th width='5%'>STT</th>
                <th width='20%'>Họ và tên</th>
                <th width='15%'>Email</th>
                <th width='10%'>Điện thoại</th>
                <th width='13%'>Ngày gửi</th>
                <th width='27%'>Nội dung</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($contacts))
            @foreach ($contacts as $key => $contact)
            <tr class="table_list bg_yellow">
                <td class="bold">{{--<a href="{!!action('Admin\ContactDetailController@getIndex', array('contact_id' => $contact->id))!!}">--}}{!!$offset+$key+1!!}{{--</a>--}}</td>
                <td>{{--<a href="{!!action('Admin\ContactDetailController@getIndex', array('contact_id' => $contact['id']))!!}">--}}{!!$contact->contact_name!!}{{--</a>--}}</td>
                <td class="color_blue bold">{!!$contact->contact_email!!}</td>
                <td class="bold">{!!$contact->contact_phone!!}</td>
                <td>{!!date("d-m-Y", strtotime($contact->contact_datetime))!!}</td>
                <td><p class="lh12 alignC"><a href="{!!action('Admin\ContactDetailController@getIndex', array('contact_id' => $contact->id))!!}">
                        @if(strlen($contact->contact_content) < 100)
                            {!!$contact->contact_content!!}
                        @else
                            {!!substr($contact->contact_content,0,100)!!}...
                        @endif
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