@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('javascript')
<script>
    $(document).ready( function () {
        $('#button').click(function() {
            $('#banner_form').submit();
        });
    });
</script>
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/banner/index')!!}">Quản lí banner</a></p>
<h2 id="page_midashi_07">@if(isset($banner['id'])) Cập nhật banner @else Đăng kí banner @endif</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 big">Các mục có dấu ※ là mục bắt buộc phải nhập</p>
    @if(Session::has('msg_error'))
    <p class="alert_red_error mb10">{!!Session::get('msg_error')!!}</p>
    {{ Session::forget('msg_error') }}
    @endif
    @if(Session::has('success'))
    <p class="alignC mt15 mb10 bold" style="font-size:1.6em;">{!!Session::get('success')!!}</p>
    {{ Session::forget('success') }}
    @endif
    {!! Form::open(['method' => 'POST','files' => true, 'id' => 'banner_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th><span class="color_red">※</span>Trạng thái</th>
            <td>
               {!! Form::select('banner_status',
                    $arrBannerStatus,
                    isset($banner['banner_status'])? $banner['banner_status']:'1'
                   ) !!}
               @if ($errors->has('banner_status'))<p class="error_comment">{!! $errors->first('banner_status') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Ảnh banner</th>
            <td>
                {!! Form::file('banner_image_path') !!}
                @if ($errors->has('banner_image_path'))<p class="error_comment">{!! $errors->first('banner_image_path') !!}</p>@endif
                <p><img src="@if(isset($banner['banner_image_path'])) {!!Asset('public/images/upload/banner/'. $banner['banner_image_path'])!!} @endif" width="500px" height="134px"/></p>
            </td>
        </tr>
    </table>

    <div class="mt15">
        @if(isset($banner['id']))
            <p id="button">Cập nhật</p>
        @else
            <p id="button">Đăng kí</p>
        @endif
        <div class="clear"></div>
    </div>
    {!!Form::close()!!}
</div>
<!-- InstanceEndEditable -->
@endsection