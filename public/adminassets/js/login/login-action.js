(function($) {
    "use strict";

    $("body").on("click", "[data-ma-action]", function(e) {
        e.preventDefault();
        var $this = $(this),
            action = $(this).data("ma-action");
        switch (action) {
            case "nk-login-switch":
                var loginblock = $this.data("ma-block"),
                    loginParent = $this.closest(".nk-block");
                loginParent.removeClass("toggled"), setTimeout(function() {
                    $(loginblock).addClass("toggled")
                });
                break;
            case "login":
                processLogin();
                break;
            case "register":
                processRegistration();
                break;
            case "forgetpassword":
                processForgetpassword();
                break;
        }
    });

})(jQuery);

//Login
function processLogin() {
    var res = false;

    //Focus script
    $('input#email').activeFocus(error_class);
    $('input#password').activeFocus(error_class);

    res = $('input#email').notempty(error_class);
    res = res && $('input#email').ifemail(error_class);
    res = res && $('input#password').notempty(error_class);

    if (res) {
        var arg = $("form#loginfrm").serialize();
        $.ajax({
            url: host + 'admin/authorize',
            type: "POST",
            dataType: 'html',
            data: arg,
            timeout: 20000,
            cache: false,
            success: function(responce) {
                // console.log(responce);
                responce = JSON.parse(responce);
                popmessage(responce.status, responce.message);
                setTimeout('window.location.reload();', 2000);
                return false;
            }
        });
    }
}