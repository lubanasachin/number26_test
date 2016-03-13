$("#datepicker1").datepicker({
	numberOfMonths: 1,
	prevText: '<i class="fa fa-chevron-left"></i>',
	nextText: '<i class="fa fa-chevron-right"></i>',			
	showButtonPanel: false
});

$(function() {
	$.validator.methods.smartCaptcha = function(value, element, param) {
		return value == param;
	};					
	$( "#smart-form" ).validate({
		errorClass: "state-error",
		validClass: "state-success",
		errorElement: "em",
		rules: {
			firstname: {required: true},
			lastname: {required: true},					
			useremail: {required: true,email: true},
			nationality: {required: true},								
			avatar:  {required: true,extension:"jpg|png|gif|jpeg|doc|docx|pdf|xls|rar|zip"},
			address:  {required: true,minlength: 30},
			password:{required: true,minlength: 6,maxlength: 16},
			repeatPassword:{required: true,minlength: 6,maxlength: 16,equalTo: '#password'},
			verification:{required:true,smartCaptcha:19},
			terms:{required:true},
			datepicker1:{required:true}
		},
		messages:{
			firstname: {required: 'Enter first name'},
			lastname: {required: 'Enter last name'},					
			useremail: {required: 'Enter email address',email: 'Enter a VALID email address'},
			nationality: {required: 'Choose your nationality'},						
			avatar:  {required: 'Please browse your avatar image',extension: 'File format not supported'},
			address:  {required: 'Oops you forgot to add your address',minlength: 'Enter at least 30 characters or more'},
			password:{required: 'Please enter a password'},
			repeatPassword:{required: 'Please repeat the above password',equalTo: 'Password mismatch detected'},
			verification:{required: 'Please enter verification code',smartCaptcha: 'Oops - enter a correct verification code'},
			datepicker1:{required:'Please select birth date'}
		},
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.field').addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('.field').removeClass(errorClass).addClass(validClass);
		},
		errorPlacement: function(error, element) {
			if (element.is(":radio") || element.is(":checkbox")) element.closest('.option-group').after(error);
			else error.insertAfter(element.parent());
		}
	});	


   var toggle_button = $("<a>", {
                        id: "toggle-btn",
                        html : "Menu",
                        title: "Menu",
                        href : "#" }
                        );

    var nav_wrap = $('nav#nav-wrap')
    var nav = $("ul#nav");

    nav_wrap.find('a.mobile-btn').remove();
    nav_wrap.prepend(toggle_button);

    toggle_button.on("click", function(e) {
		e.preventDefault();
		nav.slideToggle("fast");
    });

    if (toggle_button.is(':visible')) {
    	nav.addClass('mobile');
    }

    $(window).resize(function(){
		if (toggle_button.is(':visible')) nav.addClass('mobile');
		else nav.removeClass('mobile');
    });

    $('ul#nav li a').on("click", function(){
    	if (nav.hasClass('mobile')) nav.fadeOut('fast');
    });

});


$(document).ready(function(){
    $.cookieBar({
        forceShow: true
    });
});