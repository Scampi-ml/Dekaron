/*
 *  Document   : main.js
 *  Author     : pixelcave
 *  Description: Custom scripts and plugin initializations (available to all pages)
 *
 *  Feel free to remove the plugin initilizations from uiInit() if you would like to
 *  use them only in specific pages. Also, if you remove a js plugin you won't use, make
 *  sure to remove its initialization from uiInit().
 */

var webApp = function() {

    // Cache in variables some often used jquery objects
    var body    = $('body');
    var header  = $('header');

    /* Initialization UI Code */
    var uiInit = function () {
		
        // Set min-height to #page-content, so that footer is visible at the bottom if there is not enough content
        var pageContent = $('#page-content');

        pageContent.css('min-height', $(window).height() -
            (header.outerHeight() + $('#pre-page-content').outerHeight() + $('footer').outerHeight()) + 'px');

        $(window).resize(function() {
            pageContent.css('min-height', $(window).height() -
                (header.outerHeight() + $('#pre-page-content').outerHeight() + $('footer').outerHeight()) + 'px');
        });

        // Initialize Sticky Sidebar and position it correctly
        if ($('#page-sidebar').hasClass('sticky')) { stickySidebar('create'); }

        // Toggle Side content
        $('#toggle-side-content').click(function(){ body.toggleClass('hide-side-content'); });

        // Select/Deselect all checkboxes in tables
        $('thead input:checkbox').click(function() {
            var checkedStatus = $(this).prop('checked'), table = $(this).closest('table');
            $('tbody input:checkbox', table).each(function() { $(this).prop('checked', checkedStatus); });
        });

        // Initialize tabs
        $('[data-toggle="tabs"] a').click(function (e) { e.preventDefault(); $(this).tab('show'); });

        // Initialize Image Gallery/Popups
        $('[data-toggle="lightbox-gallery"]').magnificPopup({
            delegate: 'a.gallery-link',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                tPrev: 'Previous',
                tNext: 'Next',
                tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
            }
        });

        // Collapsible block
        $('[data-toggle="block-collapse"]').click(function(){
            if ( $(this).hasClass('active') ) {
                $(this).parents('.block').find('.block-content').slideDown(250);
                $(this).removeClass('active').html('<i class="fa fa-arrow-up"></i>');
            }
            else
            {
                $(this).parents('.block').find('.block-content').slideUp(250);
                $(this).addClass('active').html('<i class="fa fa-arrow-down"></i>');
            }
        });

        // Initialize Image Popup
        $('[data-toggle="lightbox-image"]').magnificPopup({ type: 'image' });

        // Initialize Tooltips
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({ container: 'body', animation: false });

        // Initialize Popovers
        $('[data-toggle="popover"]').popover({ container: 'body', animation: false });

        // Initialize Chosen
        $(".select-chosen").chosen();

        // Initialize elastic
        $('textarea.textarea-elastic').elastic();

        // Initialize wysihtml5
        $('textarea.textarea-editor').wysihtml5();

        // Initialize Colorpicker
        $('.input-colorpicker').colorpicker();

        // Initialize TimePicker
        $('.input-timepicker').timepicker();

        // Initialize DatePicker
        $('.input-datepicker').datepicker();
        $('.input-datepicker-close').datepicker().on('changeDate', function(e){ $(this).datepicker('hide'); });

        // Initialize DateRangePicker
        $('.input-daterangepicker').daterangepicker();

        // iCheck (Checkbox & Radio themed)
        $('.input-themed').iCheck({ checkboxClass: 'icheckbox_square-grey', radioClass: 'iradio_square-grey' });

        // Form Sliders
        $('.slider').slider();

        // Initialize Placeholder
        $('input, textarea').placeholder();
    };

    /* Sticky Sidebar functionality */
    var stickySidebar = function (mode) {
        // Cache some often used jquery objects
        var sideScrollableCon = $('#page-sidebar .slimScrollDiv');
        var sideScrollable    = $('.side-scrollable');

        // Default height for tablets and phones
        var innerHeight       = 380;

        // Modes
        if ((mode == 'create')) {
            // If there is a div with the class .side-scrollable initialize slimscroll
            if (sideScrollable.length) {
                // First, set the height of the sidebar
                innerHeight = stickySidebar('resize');

                // Initialize Slimscroll for the first time
                sideScrollable.slimScroll({ height: innerHeight, color: '#fff', size: '3px', touchScrollStep: 100 });

                // Resize sidebar height on windows scroll and resize
                $(window).scroll(stickyResize);
                $(window).resize(stickyResize);
            }

            // On window scroll set sidebar position
            $(window).scroll(stickyPosition);
        } else if (mode == 'resize') {
            // Calculate height
            if ($(window).width() > 979) {
                if (body.hasClass('header-fixed-top') || body.hasClass('header-fixed-bottom') || $(this).scrollTop() < 41) {
                    innerHeight = $(window).height() - 41;
                } else {
                    innerHeight = $(window).height();
                }
            }

            // Set height to the sidebar scroll containers
            if (sideScrollableCon)
                sideScrollableCon.css('height', innerHeight);

            sideScrollable.css('height', innerHeight);

            return innerHeight;
        } else if (mode == 'destroy') {
            // Remove Slimscroll by replacing .slimScrollDiv with .side-scrollable
            sideScrollable.parent().replaceWith(sideScrollable);

            // Remove inline styles from the new .side-scrollable div
            $('.side-scrollable').removeAttr('style');

            // Disable functions running on window scroll and resize
            $(window).off('scroll', stickyPosition);
            $(window).off('scroll', stickyResize);
            $(window).off('resize', stickyResize);
        }
    };

    // Helper functions for sticky sidebar functionality
    var stickyResize    = function() { stickySidebar('resize'); };
    var stickyPosition  = function() {
        if (!body.hasClass('header-fixed-bottom') && !body.hasClass('header-fixed-top')) {
            if ($(this).scrollTop() < 41) {
                $('#page-sidebar').css('top', '41px');
            } else if ($(this).scrollTop() > 41) {
                $('#page-sidebar').css('top', '0');
            }
        } else {
            if ($(window).width() > 979) {
                $('#page-sidebar').removeAttr('style');
            }
        }
    };

    /* Primary navigation functionality */
    var primaryNav = function () {
        // Animation Speed, change the values for different results
        var upSpeed         = 250;
        var downSpeed       = 300;

        // Get all primary and sub navigation links
        var menuLinks       = $('.menu-link');
        var submenuLinks    = $('.submenu-link');

        // Initialize number indicators on menu links
        menuLinks.each(function(n, e){
            $(e).append('<span>' + $(e).next('ul').find('a').not('.submenu-link').length + '</span>');
        });

        // Initialize number indicators on submenu links
        submenuLinks.each(function(n, e){
            $(e).append('<span>' + $(e).next('ul').children().length + '</span>');
        });

        // Primary Accordion functionality
        menuLinks.click(function(){
            var link = $(this);

            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed);
                }
                else {
                    $('.menu-link.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed);
                }
            }

            return false;
        });

        // Submenu Accordion functionality
        submenuLinks.click(function(){
            var link = $(this);

            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed);
                }
                else {
                    link.closest('ul').find('.submenu-link.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed);
                }
            }

            return false;
        });
    };

    /* Scroll to top link */
    var scrollToTop = function() {
        // Get link
        var link = $('#to-top');

        $(window).scroll(function(){
            // If the user scrolled a bit (150 pixels) show the link
            if ($(this).scrollTop() > 150) {
                link.fadeIn(100);
            } else {
                link.fadeOut(100);
            }
        });

        // On click get to top
        link.click(function(){
            $('html, body').animate({ scrollTop: 0 }, 150);
            return false;
        });
    };

    /* Datatables Bootstrap integration */
    var dtIntegration = function() {
        $.extend(true, $.fn.dataTable.defaults, {
            "sDom": "<'row'<'col-sm-6 col-xs-5'l><'col-sm-6 col-xs-7'f>r>t<'row'<'col-sm-5 hidden-xs'i><'col-sm-7 col-xs-12 clearfix'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sSearch": "<div class=\"input-group\">_INPUT_<span class=\"input-group-addon\"><i class=\"fa fa-search\"></i></span></div>",
                "sInfo": "<strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            }
        });
        $.extend($.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline",
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });
    };

    return {
        init: function () {
            uiInit(); // Initialize UI Code
            primaryNav(); // Primary Navigation functionality
            scrollToTop(); // Scroll to top functionality
            dtIntegration(); // Datatables Bootstrap integration
        }
    };
}();

/* Initialize WebApp when page loads */
$(function(){ webApp.init(); });