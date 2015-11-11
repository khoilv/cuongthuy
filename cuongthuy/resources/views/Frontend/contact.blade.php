@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title2">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="#">Liên hệ</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap contact_page">
    <h3>Chào mừng Quý khách hàng đến với CuongThuy.vn</h3><br>
    <p>
        cuongthuy.vn là sàn giao dịch thương mại điện tử uy tín, là cầu nối thương mại giữa nhà cung cấp với người mua và là nơi cung cấp các sản phẩm chính hãng, sản phẩm siêu sạch với giá cả tốt nhất có thể.
        <br> <br>
        Để liên hệ hợp tác với Cường Thủy, xin Quý khách vui lòng gọi quản lý 0987 49 59 57 hoặc để lại thông tin và nội dung đề nghị hợp tác theo mẫu bên dưới. Chúng tôi sẽ liên hệ với Quý khách trong thời gian sớm nhất. <br>
    </p>
    <div>
        @if(Session::has('success'))
        <br><b>{!!Session::get('success') !!}</b>
        @endif
        {!!  Form::open(array('action'=>['Frontend\ContactController@getContact'], 'method' => 'post','files'=>true)) !!}
        <table>
            <tr>
                <td>Họ và tên (*)</td>
                <td>
                    {!! Form::text('contact_name','',['class' => 'input box1']) !!}
                    @if ($errors->has('contact_name'))
                    <div class="error-message">
                        <div class="arrow"></div>
                        <div class="message"><p>{!! $errors->first('contact_name') !!}</p></div>
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Điện thoại</td>
                <td><input type="text" class="input box1" ></td>
            </tr>
            <tr>
                <td>Email (*)</td>
                <td>
                    {!! Form::text('contact_email','',['class' => 'input box1']) !!}
                    @if ($errors->has('contact_email'))
                    <div class="error-message">
                        <div class="arrow"></div>
                        <div class="message"><p>{!! $errors->first('contact_email') !!}</p></div>
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" class="input box1" ></td>
            </tr>
            <tr>
                <td>Nội dung (*)</td>
                <td>
                    {!! Form::textarea('contact_content','',['class' => 'box1']) !!}
                    @if ($errors->has('contact_content'))
                    <div class="error-message">
                        <div class="arrow"></div>
                        <div class="message"><p>{!! $errors->first('contact_content') !!}</p></div>
                    </div>
                    @endif
                </td>
            </tr>
        </table>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8005398974337!2d105.82023421407582!3d21.00063109411576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac85c54a62f1%3A0x12d0d05337be4b5d!2zMzEgVsawxqFuZyBUaOG7q2EgVsWpLCBLaMawxqFuZyBUaMaw4bujbmcsIFRoYW5oIFh1w6JuLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1445021066100" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="clear"></div>
        <ul class="btn_cm">
            <li><button type="submit">Gửi</button></li>
            <li><button type="reset">Xóa</button></li>
        </ul>
        {!! Form::close()!!}
    </div>
</div><!-- end wrap-->
<!-- InstanceEndEditable -->

<div class="clear"></div>
@endsection