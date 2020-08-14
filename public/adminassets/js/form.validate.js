// Validation functions 

Array.prototype.unique = function () {
	return this.filter(function (value, index, self) {
		return self.indexOf(value) === index;
	});
}

//Check not empty
$.fn.notempty = function (error_class) {
	var field = $(this);
	if (field.val() == "") {
		field.addClass(error_class);
		field.moveToPos();
		return false;
	}
	else {
		field.removeClass(error_class);
		return true;
	}
};

//Check not 0
$.fn.notZero = function (error_class) {
	var field = $(this);
	if (field.val() == "0") {
		field.addClass(error_class);
		field.moveToPos();
		return false;
	}
	else {
		field.removeClass(error_class);
		return true;
	}
};

//Compare two fields
$.fn.compare = function (compare, error_class) {
	var field = $(this);
	var compare = $('#' + compare);
	if (field.val() != compare.val()) {
		compare.addClass(error_class);
		compare.moveToPos();
		return false;
	}
	else {
		compare.removeClass(error_class);
		return true;
	}
};


$.fn.notemptyRadio = function (radioName, error_class) {
	var field = $(this);
	if ($('input[name=' + radioName + ']:checked').length) {
		field.parent().removeClass(error_class);
		return true;
	}
	else {
		field.parent().addClass(error_class);
		field.moveToPos();
		return false;
	}
	return true;
}


$.fn.notemptyCheckboxGroup = function (checkboxName, error_class) {
	var chk = 0;
	$.each($('input[name="selevent[]"]'), function (elem) {
		if (elem.attr('checked')) chk++;
	});
	return chk;
}

//Check valid phone
$.fn.ifphone = function (error_class) {
	/*var phone_regex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
	var field = $(this);
	if(!phone_regex.test(field.val()))
	{
		field.addClass(error_class);
		field.moveToPos();
		return false;
	}
	else
	{
		field.removeClass(error_class);
		return true;
	}*/
	return true;
};

//Check valid email
$.fn.ifemail = function (error_class) {
	var email_regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
	var field = $(this);
	if (!email_regex.test(field.val())) {
		field.addClass(error_class);
		field.moveToPos();
		return false;
	}
	else {
		field.removeClass(error_class);
		return true;
	}
};


//Append Loader
$.fn.appendLoader = function () {
	var elem = $(this);
	var loader = $('<span></span>').addClass('ajax-loader').html('<img scr="' + SITE_PATH + 'support/img/ajax-loader.gif" >');
	elem.after(loader);
};

//Append Loader
$.fn.removeLoader = function () {
	var elem = $(this);
	elem.next().remove("span");
};

//Move to error element
$.fn.moveToPos = function () {
	$('html,body').animate({ scrollTop: $(this).offset().top - 300 }, 'slow');
	$(this).focus();
};

//Element click, keyup
$.fn.activeFocus = function (error_class) {
	var elem = $(this);
	elem.click(function () {
		if (elem.val() != '') elem.removeClass(error_class);
	});
	elem.keyup(function () {
		if (elem.val() != '') elem.removeClass(error_class);
	});
};


//Toggle modal
$.fn.toggleModal = function () {
	var elem = $(this);
	if (elem.is(":visible")) {
		elem.modal('hide');
	}
	else {
		elem.modal('show');
	}
};

