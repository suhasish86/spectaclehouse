$(function() {

    //Focus script
    $('input#billing_name').activeFocus(error_class);
    $('input#billing_email').activeFocus(error_class);
    $('input#billing_phone').activeFocus(error_class);
    $('textarea#billing_address').activeFocus(error_class);
    $('input#billing_pin').activeFocus(error_class);

    $('input#shipping_name').activeFocus(error_class);
    $('input#shipping_email').activeFocus(error_class);
    $('input#shipping_phone').activeFocus(error_class);
    $('textarea#shipping_address').activeFocus(error_class);
    $('input#shipping_pin').activeFocus(error_class);

    $('a#billing_continue').click(function() {

        res = $('input#billing_name').notempty(error_class);
        res = res && $('input#billing_email').notempty(error_class);
        res = res && $('input#billing_email').ifemail(error_class);
        res = res && $('input#billing_phone').notempty(error_class);
        res = res && $('textarea#billing_address').notempty(error_class);
        res = res && $('input#billing_pin').notempty(error_class);

        if (res) $('h4#shipping_tab').click();
    });

    $('input[name="same_as_billing"]').click(function() {
        if ($(this).is(":checked")) {
            $('input#shipping_name').val($('input#billing_name').val());
            $('input#shipping_email').val($('input#billing_email').val());
            $('input#shipping_phone').val($('input#billing_phone').val());
            $('textarea#shipping_address').val($('textarea#billing_address').val());
            $('input#shipping_pin').val($('input#billing_pin').val());
        }
    });

    $('a#shipping_continue').click(function() {
        res = $('input#shipping_name').notempty(error_class);
        res = res && $('input#shipping_email').notempty(error_class);
        res = res && $('input#shipping_email').ifemail(error_class);
        res = res && $('input#shipping_phone').notempty(error_class);
        res = res && $('textarea#shipping_address').notempty(error_class);
        res = res && $('input#shipping_pin').notempty(error_class);

        if (res) $('h4#payment_tab').click();
    });


    //Razorpay

    var payprocess = function() {
        var options = {
            "key": $('a#place_order').attr('data-rz-key'),
            "amount": $('a#place_order').attr('data-rz-amount'),
            "currency": $('a#place_order').attr('data-rz-currency'),
            "name": $('input#billing_name').val(),
            "description": "Spectacle House",
            "image": $('a#place_order').attr('data-logo'),
            "order_id": $('a#place_order').attr('data-order-id'),
            "handler": function(response) {

                $('input#rzp_paymentid').val(response.razorpay_payment_id);
                $('input#rzp_orderid').val(response.razorpay_order_id);
                $('input#rzp_signature').val(response.razorpay_signature);
                var arg = $('form#checkout_frm').serialize();
                arg += '&rzp_paymentid=' + response.razorpay_payment_id + '&rzp_orderid=' + response.razorpay_order_id + '&rzp_signature=' + response.razorpay_signature + '&receipt_id=' + $('a#place_order').attr('data-receipt-id');
                console.log(arg);

                //Target & Redirect Url
                var target = host + 'place_order';
                var redirect = host + 'thank_you';

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
                            setTimeout('window.location.href="' + redirect + '/' + responce.order_no + '";', 2000);
                        } else {
                            swal({
                                text: responce.message,
                                icon: responce.status,
                            });
                        }

                        return false;
                    }
                });
            },
            "prefill": {
                "name": $('input#billing_name').val(),
                "email": $('input#billing_email').val(),
                "contact": $('input#billing_phone').val()
            },
            "notes": {
                "address": $('input#billing_address').val()
            },
            "theme": {
                "color": "#F37254"
            }
        };


        var rzp1 = new Razorpay(options);
        rzp1.open();
    }



    $('a#place_order').click(function() {
        payprocess();
    });
});