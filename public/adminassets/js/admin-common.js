(function($) {
    "use strict";

    /*--------------------------
    	auto-size Active Class
    ---------------------------- */
    $(".auto-size")[0] && autosize($(".auto-size"));
    /*----------------------------
    	jQuery tooltip
    ------------------------------ */
    $('[data-toggle="tooltip"]').tooltip();

    /*----------------------------
    jQuery MeanMenu
    ------------------------------ */
    jQuery('nav#dropdown').meanmenu();

    /*----------------------------
	jQuery Wave
	------------------------------ */
    Waves.attach(".btn:not(.btn-icon):not(.btn-float)"), Waves.attach(".btn-icon, .btn-float", ["waves-circle", "waves-float"]), Waves.init();

    /*----------------------------
	jQuery iCheck
	------------------------------ */
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    /*----------------------------
	jQuery Chosen
	------------------------------ */
    $(".chosen")[0] && $(".chosen").chosen({
        width: "100%",
        allow_single_deselect: !0
    });

    $(".nk-int-st")[0] && ($("body").on("focus", ".nk-int-st .form-control", function() {
        $(this).closest(".nk-int-st").addClass("nk-toggled")
    }), $("body").on("blur", ".form-control", function() {
        var p = $(this).closest(".form-group, .input-group"),
            i = p.find(".form-control").val();
        p.hasClass("fg-float") ? 0 == i.length && $(this).closest(".nk-int-st").removeClass("nk-toggled") : $(this).closest(".nk-int-st").removeClass("nk-toggled")
    })), $(".fg-float")[0] && $(".fg-float .form-control").each(function() {
        var i = $(this).val();
        0 == !i.length && $(this).closest(".nk-int-st").addClass("nk-toggled")
    });

})(jQuery);