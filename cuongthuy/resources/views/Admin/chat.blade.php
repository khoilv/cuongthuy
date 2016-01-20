@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#search_button').click(function() {
            $('#cmd').attr({value: "search"});
            $('#chat_form').submit();
        });
    });
</script>-->
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;Quản lí chat</p>
<h2 id="page_midashi_02">Quản lí chat</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div class="content_list_area">
    <p class="bold"><a href="">&diams;Chat với khách hàng</a></p>
    <p class="gaiyo">Bạn có thể chat, hỗ trợ, giải đáp cho khách hàng những thắc mắc về hóa đơn, sản phẩm...<br /></p>
    <p class="gaiyo">Truy cập vào link sau và đăng nhập</p>
    <a href="https://dashboard.tawk.to/login" target="_blank">https://dashboard.tawk.to/login</a>
    <p class="gaiyo">Tên đăng nhập: myphamcuongthuy@gmail.com</p>
    <p class="gaiyo">Mật khẩu: cuong03042008</p>
    <p class="gaiyo">Các tin nhắn offline sẽ được gửi vào email myphamcuongthuy@gmail.com khi bạn không thể online hỗ trợ khách hàng</p>
    <p class="gaiyo bold">Download bản hướng dẫn sử dụng ở dưới đây</p>
</div>
{!! Form::open(['method' => 'POST', 'url' => 'admin/chat/index', 'id' => 'chat_form', 'name' => 'form1']) !!}
<div align="center">
    <input type="hidden" name="file" value="{!!isset($file) ? $file : ''!!}" />
    <input type="hidden" name ="strFilePath" value="{!!$strFilePath!!}"/>
    <div class="mt15">
        <input type="submit" class="btn" name="download" value="Download" />
    <div class="clear"></div>
    </div>
</div>
{!! Form::close() !!}
@endsection
