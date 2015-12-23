@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
<link rel="stylesheet" href="{!!Asset('public/css/admin/jquery.datetimepicker.css')!!}" type="text/css" />
@endsection
@section('javascript')
<script type="text/javascript" src="{!!Asset('public/js/ckeditor/ckeditor.js')!!}"></script>
<script type="text/javascript" src="{!!Asset('public/js/jquery.datetimepicker.min.js')!!}"></script>
<script type="text/javascript" src="{!!Asset('public/js/jquery.datetimepicker.full.js')!!}"></script>
<script>
    $(document).ready( function () {
        $('#button').click(function() {
            $('#maintenance_form').submit();
        });
        $('#start_date').datetimepicker();
        $('#end_date').datetimepicker();
    });
</script>
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/maintenance')!!}">Bảo trì hệ thống</a> &gt;</p>
<h2 id="page_midashi_07">Bảo trì hệ thống</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 big">Bạn có thể thiết lập bảo trì hệ thống tại đây. Việc cài đặt sẽ có hiệu lực ngay lập tức.</p>
    <p class="mb15 big">Chế độ này được có thể được thiết lập khi bạn muốn thay đổi code hệ thống, backup cơ sở dữ liệu, bảo trì server...</p>
    <p class="mb15 big">Chú ý: Khi chức năng này được thiết lập, mọi hoạt động của khách hàng như xem, mua sản phẩm sẽ bị dừng lại,
        chế độ dành cho người quản lý (trang admin) vẫn có thể sử dụng được</p>
    @if(Session::has('msg_error'))
    <p class="alert_red_error mb10">{!!Session::get('msg_error')!!}</p>
    {{ Session::forget('msg_error') }}
    @endif
    @if(Session::has('success'))
    <p class="alignC mt15 mb10 bold" style="font-size:1.6em;">{!!Session::get('success')!!}</p>
    {{ Session::forget('success') }}
    @endif
    {!! Form::open(['method' => 'POST','files' => true, 'id' => 'maintenance_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th width="19%"><span class="color_red">※</span>Ngày bắt đầu</th>
            <td width="80%">
               {!! Form::text('start_date', isset($start_date)? $start_date:'',['style' => 'width:200px', 'class' => 'text', 'id' => "start_date", "readonly"]) !!}
               @if ($errors->has('start_date'))<p class="error_comment">{!! $errors->first('start_date') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Ngày kết thúc</th>
            <td>
               {!! Form::text('end_date', isset($end_date)? $end_date:'',['style' => 'width:200px', 'class' => 'text', 'id' => "end_date", "readonly"]) !!}
               @if ($errors->has('end_date'))<p class="error_comment">{!! $errors->first('end_date') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Nội dung thông báo</th>
            <td>
                {!! Form::textarea('message', isset($message)? $message:'',['style' => 'width:550px;height:50px', 'class' => 'text']) !!}
                @if ($errors->has('message'))<p class="error_comment">{!! $errors->first('message') !!}</p>@endif
                <script>
                    CKEDITOR.replace( 'message' );
                </script>
            </td>
        </tr>
    </table>

    <div class="mt15">
        <p id="button">Cấu hình</p>
        <div class="clear"></div>
    </div>
    {!!Form::close()!!}
</div>
<!-- InstanceEndEditable -->
@endsection