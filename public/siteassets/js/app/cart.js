$(function() {


    $('a#add_cart').click(function(e) {
        //Focus script
        $('input#product_quantity').activeFocus(error_class);

        e.preventDefault();
        res = $('input#product_quantity').notempty(error_class);

        //Target & Redirect Url
        var target = host + 'add_cart'
        var redirect = host + 'shopping_cart';

        if (res) {
            var arg = $("form#add_to_cart_frm").serialize();
            console.log(arg);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: target,
                type: "POST",
                dataType: 'html',
                data: arg,
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    console.log(responce);
                    // responce = JSON.parse(responce);
                    // popmessage(responce.status, responce.message);
                    // setTimeout('window.location.href="' + redirect + '";', 2000);
                    // return false;
                }
            });
        }
    });


});