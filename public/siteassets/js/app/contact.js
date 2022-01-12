$(function() {

    //Focus script
    $('input#contact_name').activeFocus(error_class);
    $('input#contact_email').activeFocus(error_class);
    $('input#contact_phone').activeFocus(error_class);
    $('textarea#contact_message').activeFocus(error_class);

    $('form#contact-frm').submit(function(e) {
        e.preventDefault();

        res = $('input#contact_name').notempty(error_class);
        res = res && $('input#contact_email').notempty(error_class);
        res = res && $('input#contact_email').ifemail(error_class);
        res = res && $('input#contact_phone').notempty(error_class);
        res = res && $('textarea#contact_message').notempty(error_class);

        if (res) {
            var arg = $('form#contact-frm').serialize();
            console.log(arg);

            //Target & Redirect Url
            var target = host + 'contact';

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
                        setTimeout('window.location.reload();', 2000);
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

});