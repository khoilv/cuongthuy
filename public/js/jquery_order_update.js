//$(".product_quantity").change(function() {
//    var my = $(this).closest('tr');
//    if ($(this).val() < 1000) {
//        var post = {
//            quantity: $(this).val(),
//            product_id: $(".product_id", my).val()
//        };
//        $.ajax({
//            url: 'order/update',
//            type: 'post',
//            dataType: 'json',
//            data: post,
//            beforeSend: function() {
//                $('#img_ajax').addClass('loading');
//            },
//            success: function(result) {
//                $('.line_price', my).html(formatNumber(result['linePrice']) + ' đ');
//                $('.total_price').html('Tổng tiền : ' + formatNumber (result['totalPrice']) + ' đ');
//                if (result['totalCart']) {
//                    $(".button_cart").html("Giỏ hàng (" + result['totalCart'] + ")");
//                } else {
//                    $(".button_cart").html("Giỏ hàng");
//                }
//                $('#img_ajax').removeClass('loading');
//            }
//        });
//    }
//});

$(".delete_product").click(function() {
    console.log('chanvl');
//    var my = $(this).closest('tr');
//    var post = {
//        id : $(".hidden", my).val()
//    };
//
//    $.ajax({
//        url: 'order_detail/deleteOrder',
//        type: 'post',
//        dataType: 'json',
//        data: post,
////        beforeSend: function() {
////            $('#img_ajax').addClass('loading');
////        },
//        success: function(result) {
//            console.log(result);
////            $('.total_price').html('Tổng tiền : ' + formatNumber (result['totalPrice']) + ' đ');
////            my.remove();
////            if (result['totalCart']) {
////                $(".button_cart").html("Giỏ hàng (" + result['totalCart'] + ")");
////            } else {
////                $(".button_cart").html("Giỏ hàng");
////            }
////            $.each($('.serial'), function(i) {
////                $(this).text(i + 1);
////            });
////            $('#img_ajax').removeClass('loading');
//        }
//    });
});
function formatNumber(number) {
    number = number.toFixed() + '';
    x = number.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}