<footer>
    <div class="wrap">
        <div class="f_left">
            <img src="{!!Asset('public/images/logo-2.png')!!}" alt="cuongthuy.vn">
            <div>
                <h2>BẢN QUYỀN THUỘC cuongthuy.vn</h2>
                <p>Địa chỉ : Số 31 Vương Thừa Vũ - Thanh Xuân - Hà Nội<br>Tell : 0966771102 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0439992325 <br>Mail : laihuycuong1812@gmail.com </p>
            </div>
        </div>
        <p class="f_right"><div class="fb-page" data-href="https://www.facebook.com/cuahangcuongthuy" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cuahangcuongthuy"><a href="https://www.facebook.com/cuahangcuongthuy">Mỹ Phẩm Cường Thủy</a></blockquote></div></div></p>
        <div class="clear"></div>
    </div>
</footer>
@section('javascript')
<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
@yield('javascript')