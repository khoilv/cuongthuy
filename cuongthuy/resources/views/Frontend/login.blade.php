<?php 
    $email = (Cache::has('email')? Cache::get('email'):'');
    $password = (Cache::has('password')? Cache::get('password'):'');
    $remember = (Cache::has('remember')? Cache::get('remember'):'');
?>
<div id="login" class="box_login">
    <div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="f_left">
            <h2 class="p_title">Đăng nhập</h2>
            <div class="error-message error_msg">
                <div class="message"><p id="error_msg"></p></div>
            </div>
            <table class="p_table clear">
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" id="email" value="<?php echo $email; ?>">
                        <div class="error-message error_email">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_email"></p></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Mật khẩu</td>
                    <td>
                        <input id="password" value="<?php echo $password; ?>" type="password">
                        <div class="error-message error_pass">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_pass"></p></div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="clear"></div>
            <input type="checkbox" name="remember" id="lg_remember" value="1" <?php if($remember){?> checked ="checked" <?php }?>> Ghi nhớ mật khẩu
            <div class="clear"></div>
            <button class="p_bn f_right" id="tbn_login" >Đăng nhập</button>
        </div>
        <div class="f_right">
            <h3 class="p_title2">Đăng nhập với tài khoản</h3><div class="clear"></div>
            <ul>
                <li>
                   <a href="/login/facebook"><span></span> <p>Đăng nhập với Facebook</p></a>
                </li>
                <li>
                    <a href="/login/google"><span></span> <p>Đăng nhập với Google+</p></a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
        <a class="p_bottom" >Bạn quên mật khẩu ?</a>
    </div>
</div>
<script type="text/javascript" language="javascript">
    $(function() {
       $("[class*=error_]").css("display", "none");
       $("#tbn_login").click(function() {
           $("[class*=error_]").css("display", "none");
            var post = {
                    email : $("#email").val(),
                    password : $("#password").val(),
                    lg_remember: $("#lg_remember:checked").val()
                };
            $.ajax({
                url : 'login',
                type : 'post',
                dataType: 'json',
                data : post,
                success : function (result){
                    if(result['error'] == true){
                        if(result['error_msg'].email){
                            $("#login .error_email").css("display", "initial");
                            $("#error_email").text(result['error_msg'].email);
                        }
                        if(result['error_msg'].password){
                            $(".error_pass").css("display", "initial");
                            $("#error_pass").text(result['error_msg'].password);
                        }
                        if(result['error_msg'].error_login){
                            $(".error_msg").css("display", "initial");
                            $("#error_msg").text(result['error_msg'].error_login);
                        }
                    } else {
                        var url = window.location.href;
                        top.location.href= url.replace("#login",'')
                    }
                }
            });
        });
        $("#logout").click(function() {
            $.ajax({
                    url : 'logout',
                    type : 'post',
                    success : function (){
                        top.location.href = '/'
                    }
            });
        });
        $(".p_bottom").click(function() {
             $("[class*=error_]").css("display", "none");
            var retVal = confirm("Bạn có muốn gửi mật khẩu vào địa chỉ email vừa nhập không?");
            var post = {
                email : $("#email").val()
            };
            if( retVal == true ){
                    $.ajax({
                    url : 'recover_pass',
                    type : 'post',
                    dataType: 'json',
                    data : post,
                    success : function (result){
                        if(result['error_email']){
                            $("#login .error_email").css("display", "initial");
                            $("#error_email").text(result['error_email']);
                        } else {
                            alert('Mật khảu của bạn đã được gửi vào mail.Vui lòng check mail của bạn!');
                        }
                    }
                });
            } else {
            }
        });
    });
</script>