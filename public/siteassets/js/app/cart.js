$(function() {


    if ($('input#item_quantity').length) {
        $('input#item_quantity').keyup(function() {
            var itemid = $(this).attr('data-itemid');
            var item_quantity = $(this).val();

            //Target & Redirect Url
            var target = host + 'update_cart';
            var redirect = host + 'cart';

            if (parseInt(item_quantity) > 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: target,
                    type: "POST",
                    dataType: 'html',
                    data: {
                        itemid: itemid,
                        item_quantity: item_quantity
                    },
                    timeout: 20000,
                    cache: false,
                    success: function(responce) {
                        console.log(responce);
                        responce = JSON.parse(responce);
                        if (responce.status == 'success') {
                            swal({
                                text: responce.message,
                                icon: responce.status,
                            });
                            setTimeout('window.location.href="' + redirect + '";', 2000);
                        } else {
                            swal({
                                text: responce.message,
                                icon: responce.status,
                            });
                        }

                        return false;
                    }
                });
            }
        });
    }

    if ($('button#clear_cart').length) {
        $('button#clear_cart').click(function() {

            //Target & Redirect Url
            var target = host + 'clear_cart';
            var redirect = host + 'cart';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: target,
                type: "POST",
                dataType: 'html',
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    console.log(responce);
                    responce = JSON.parse(responce);
                    if (responce.status == 'success') {
                        swal({
                            text: responce.message,
                            icon: responce.status,
                        });
                        setTimeout('window.location.href="' + redirect + '";', 2000);
                    } else {
                        swal({
                            text: responce.message,
                            icon: responce.status,
                        });
                    }

                    return false;
                }
            });
        });
    }

    if ($('a[id^="remove_cart-"]').length) {
        $('a[id^="remove_cart-"]').click(function() {

            //Target & Redirect Url
            var target = host + 'remove_cart_item';
            var redirect = host + 'cart';

            var itemid = $(this).attr('id').replace('remove_cart-', '');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: target,
                type: "POST",
                dataType: 'html',
                data: {
                    itemid: itemid
                },
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    console.log(responce);
                    responce = JSON.parse(responce);
                    if (responce.status == 'success') {
                        swal({
                            text: responce.message,
                            icon: responce.status,
                        });
                        setTimeout('window.location.href="' + redirect + '";', 2000);
                    } else {
                        swal({
                            text: responce.message,
                            icon: responce.status,
                        });
                    }

                    return false;
                }
            });
        });
    }

    if ($('a#add_cart').length) {
        $('a#add_cart').click(function(e) {
            //Focus script
            $('input#product_quantity').activeFocus(error_class);

            e.preventDefault();
            res = $('input#product_quantity').notempty(error_class);

            //Target & Redirect Url
            var target = host + 'add_cart';
            var redirect = host + 'cart';

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
                        responce = JSON.parse(responce);
                        if (responce.status == 'success') {
                            swal({
                                text: responce.message,
                                icon: responce.status,
                            });
                            setTimeout('window.location.href="' + redirect + '";', 2000);
                        } else {
                            swal({
                                text: responce.message,
                                icon: responce.status,
                            });
                        }

                        return false;
                    }
                });
            }
        });
    }



});