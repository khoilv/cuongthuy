<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Xác nhận đăng ký tài khoản</title>
        <style>
			*{margin:0 auto;padding:0;}
        	body{background-color:#121212;padding:10px;font-family:Arial, tahoma;font-size:15px; line-height:20px;}
			ul li{list-style:none;}
			a{text-decoration:none; color:#007ACC;}
			.wrapper{background-color:#fff; width:90%;padding-bottom:20px;}
			.f_left{float:left;}
			.f_right{float:right;}
			.clear{clear:both;}			
			.content1{
				background:url({!!Asset('public/images/bg.png')!!}) repeat-x bottom left;
			}
			.content1 img{padding:10px 0 20px 10px;}
			.content1 ul{padding-top:80px;}
			.content1 ul li{ float:right;}
			.content1 ul li a{padding:5px 20px;}
			.content2{width:80%;margin:20px auto;}
			footer{margin-top:10px;text-align:center;color:#DADADA;font-size:13px;}
        </style>
    </head>
    
    <body>
    	<div class="wrapper">
        	<div class="content1">
            	<img src="{!!Asset('public/images/logo.png')!!}" class="f_left">
                <ul>
                	<li><a href="#">Liên hệ</a> </li> 
                	<li><a href="#">myphamtienthoi.vn</a> | </li>
                	                   
                </ul>
                <div class="clear"></div>
            </div>
            <p class="content2">
				Kính chào Quý khách ! <br><br>
                Quý khách đã đăng ký tài khoản trên myphamtienthoi.vn<br>
                &nbsp;&nbsp; - Họ và tên : {!!$customer_name!!}<br>
                &nbsp;&nbsp; - Điện thoại: {!!$customer_phone!!}<br>
                &nbsp;&nbsp; - Email: {!!$customer_email!!}<br>
                &nbsp;&nbsp; - Mật khẩu: {!!$customer_password!!}<br>
                <br><br><br>
                <span style="font-style:italic;">Cường thủy rất hận hạnh được phục vụ quý khách !</span>
            </p>
        </div><!-- end wrap-->
        <footer>
        	<b>Copyright © 2016. Bản quyền thuộc myphamtienthoi.vn</b><br>
            Địa chỉ : Số 31 Vương Thừa Vũ - Thanh Xuân - Hà Nội<br>
            Tell : 097 123 123 <br>
            Mail : laihuycuong1812@gmail.com<br>
        </footer>
    </body>
    
</html>