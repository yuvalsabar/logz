var $ = jQuery.noConflict();

$(document).ready(function () {
    a11yMenu(); 				// Accessibility for main menu
    marketoFormsInit(); 		// Marketo Forms
});

$(window).load(function () {
    fade_in_init(); // Fade-in init
});

$(window).scroll(function () {
    stickyClass();
});

function stickyClass() {
	if ($(window).scrollTop() > 0) {
        $('body').addClass('sticky');
    } else {
        $('body').removeClass('sticky');
    }
}

function is_home() {
    if ($("body").hasClass("home")) {
        return true;
    } else {
        return false;
    }
}

function is_mobile(width) {
    if (!width) {
        width = 992;
    }

    if ($(window).width() < width) {
        return true;
    } else {
        return false;
    }
}

function fade_in_init() {
    $(".fade-in").css("opacity", 1);
}

function a11yMenu() {
    $("#main-navigation ul li.menu-item-has-children a").on(
        "focusin",
        function (e) {
            e.preventDefault();
            var this_el = $(this);
            this_el.parent().addClass("hover");
        }
    );

    $("body").on(
        "focusout",
        "#main-navigation ul li.menu-item-has-children.hover ul li:last-child a",
        function (e) {
            e.preventDefault();
            var this_el = $(this);
            this_el.parent().parent().parent().removeClass("hover");
        }
    );
}

function marketoFormsInit() {
    if (siteObject.demo_form_id) {
        MktoForms2.loadForm(
            "//app-lon04.marketo.com",
            "457-WKE-316",
            siteObject.demo_form_id
        );

        MktoForms2.whenReady(function (form) {
            form.onSuccess(function (values, followUpUrl) {
                $form = $(form.getFormElem());
				$popup = $form.parents('.popup-form');
				$form.hide();
				$popup.find('.popup-demo-form__footer').hide();
				$popup.find('.form-sent').show();

                return false;
            });
        });
    }
}
