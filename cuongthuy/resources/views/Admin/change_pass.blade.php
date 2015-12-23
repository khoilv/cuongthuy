@extends('Admin.layout')
@section('content')

<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
<script>
    $(document).ready( function () {
        $('#button').click(function() {
            $('#password_form').submit();
        });
    });
</script>
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a>&gt;Quản lí chat</p>
<h2 id="page_midashi_07">Thay đổi mật khẩu cho quản trị viên</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 big">Nhập mật khẩu cũ và mật khẩu mới, sau đó nhấn vào "lưu" để thay đổi mật khẩu.</p>

    @if(Session::has('msg_error'))
    <p class="alert_red_error mb10">{!!Session::get('msg_error')!!}</p>
    {{ Session::forget('msg_error') }}
    @endif
    @if(Session::has('success'))
    <p class="alignC mt15 mb10 bold" style="font-size:1.6em;">{!!Session::get('success')!!}</p>
    {{ Session::forget('success') }}
    @endif
    {!! Form::open(['method' => 'POST', 'id' => 'password_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th width="25%"><span class="color_red">※</span>Mật khẩu cũ</th>
            <td width="74%">
               {!! Form::password('old_password',['style' => 'width:200px', 'class' => 'text']) !!}
                @if ($errors->has('old_password'))<p class =" alignL ml85 error_comment">{!! $errors->first('old_password') !!}</p> @endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Mật khẩu mới</th>
            <td>
               {!! Form::password('new_password',['style' => 'width:200px', 'class' => 'text']) !!}
                @if ($errors->has('new_password'))<p class =" alignL ml85 error_comment">{!! $errors->first('new_password') !!}</p> @endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Nhập lại mật khẩu mới</th>
            <td>
               {!! Form::password('new_password_again',['style' => 'width:200px', 'class' => 'text']) !!}
                @if ($errors->has('new_password_again'))<p class =" alignL ml85 error_comment">{!! $errors->first('new_password_again') !!}</p> @endif
            </td>
        </tr>
    </table>

    <div class="mt15">
        <p id="button">Lưu</p>
        <div class="clear"></div>
    </div>
    {!!Form::close()!!}
</div>

@endsection

