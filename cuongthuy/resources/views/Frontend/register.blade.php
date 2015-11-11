<div id="register" class="box_login">
    <div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="f_left">
            <h2 class="p_title">Đăng ký</h2>
            <table class="p_table clear">
                <tr>
                    <td>Họ tên(*)</td>
                    <td>
                        <input type="text" id="username">
                        <div class="error-message error_username">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_username"></p></div>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>
                        <input type="text" id="address">
                        <div class="error-message error_address">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_address"></p></div>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>
                        <input type="text" id="phone">
                        <div class="error-message error_phone">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_phone"></p></div>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>Email(*)</td>
                    <td>
                        <input type="text" id="email">
                        <div class="error-message error_email">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_email"></p></div>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>Mật khẩu(*)</td>
                    <td>
                        <input type="password" id="password">
                        <div class="error-message error_password">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_password"></p></div>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>Xác nhận lại mật khẩu(*)</td>
                    <td>
                        <input type="password" id="password_confirm">
                        <div class="error-message error_password_confirm">
                            <div class="arrow"></div>
                            <div class="message"><p id="error_password_confirm"></p></div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="clear"></div>
            <div>
                <button class="p_bn f_right" id="tbn_register">Đăng ký</button>
            </div>
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
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("[class*=error_]").css("display", "none");
        $("#tbn_register").click(function () {
            $("[class*=error_]").css("display", "none");
            var post = {
                username: $("#username").val(),
                address: $("#address").val(),
                email: $("#register #email").val(),
                password: $("#register #password").val(),
                password_confirm: $("#password_confirm").val(),
                phone: $("#phone").val()
            };
            $.ajax({
                url: 'register',
                type: 'post',
                dataType: 'json',
                data: post,
                success: function (result) {
                    if (result['error'] == true) {
                        if (result['error_msg'].email) {
                            $("#register .error_email").css("display", "initial");
                            $("#register #error_email").text(result['error_msg'].email);
                        }
                        if (result['error_msg'].password) {
                            $(".error_password").css("display", "initial");
                            $("#register #error_password").text(result['error_msg'].password);
                        }
                        if (result['error_msg'].password_confirm) {
                            $(".error_password_confirm").css("display", "initial");
                            $("#error_password_confirm").text(result['error_msg'].password_confirm);
                        }
                        if (result['error_msg'].username) {
                            $(".error_username").css("display", "initial");
                            $("#error_username").text(result['error_msg'].username);
                        }
                        if (result['error_msg'].phone) {
                            $(".error_phone").css("display", "initial");
                            $("#error_phone").text(result['error_msg'].phone);
                        }
                        if (result['error_msg'].address) {
                            $(".error_address").css("display", "initial");
                            $("#error_address").text(result['error_msg'].address);
                        }
                    } else {
                        var url = window.location.href;
                        top.location.href = url.replace("#register", '')
                    }
                }
            });
        });
    });
</script>