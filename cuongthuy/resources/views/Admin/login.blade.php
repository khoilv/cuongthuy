<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cương thuy</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="content-script-type" content="text/javascript" />
        <link rel="stylesheet" href="{!!Asset('public/css/admin/login.css')!!}" type="text/css" />
        <link rel="stylesheet" href="{!!Asset('public/css/admin/style.css')!!}" type="text/css" />
    </head>
    <body>
        <!--▼ header -->
        <div id="header">
            <div id="header_area">
                <div class="floatR alignR mt10">
                </div>
            </div>
        </div>
        <!--▲ header -->
        <!--▼ login_content_ -->
        <div id="login_content">
            <p class="alignC mb10"><img src="{!!Asset('public/images/admin/logo.png')!!}" /></p>
            @if ($errors->has('msg_error'))
            <p class="alert_red_error mb10">{!! $errors->first('msg_error') !!}</p>
            @endif
            {!! Form::open(['method' => 'POST','files' => true, 'id' => 'form']) !!}
            <div class="ma_auto">
                <p class="alignL ml85">Tên đăng nhập</p>
                <p class="alignC ml10">{!! Form::text('username', isset($username)? $username:'',['style' => 'width:300px; height:35px', 'class' => 'text','placeholder' => 'username' ]) !!}</p>
                @if ($errors->has('username'))<p class ="alignL ml85 error_comment">{!! $errors->first('username') !!}</p> @endif
                <p class="alignL mt20 ml85">Mật khẩu</p>
                <p class="alignC ml10">{!! Form::password('password',['style' => 'width:300px; height:35px', 'class' => 'text' ,'placeholder' => 'password']) !!}</p>
                @if ($errors->has('password'))<p class =" alignL ml85 error_comment">{!! $errors->first('password') !!}</p> @endif
                <p class="mt20"><label>{!! Form::checkbox('remember', '')!!} Ghi nhớ tài khoản</label></p>
                <input type="submit" name="login" value="Đăng nhập" class="ml75" id="login_button"/>
            </div>
            {!!Form::close()!!}
        </div>
        <!--▼ footer -->
        <div id="footer">
            <div id="footer_area">
                <p id="copyright">&copy; 2015 - Trang quản trị CuongThuy.vn</p>
            </div>
        </div>
        <!--▲ footer -->
    </div>
    <!--▲ login_content_ -->
</body>
</html>