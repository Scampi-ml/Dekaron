var IMAGE_URL = 'images/';
jQuery.noConflict();
jQuery(function ($) {
    $('.box > h2').append('<img src="' + IMAGE_URL + 'icons/arrow_state_grey_expanded.png" class="toggle" />');
    $('img.toggle').click(function () {
        $(this).parent().next().slideToggle(200)
    });
    var fixHelper = function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width())
        });
        return ui
    };
    $('table.sortable tbody').sortable({
        handle: 'img.move',
        helper: fixHelper,
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true
    }).disableSelection();
    $('ul.sortable').sortable({
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true
    });
    var togel = false;
    $('#table1 .checkall').click(function () {
        $('#table1 :checkbox').attr('checked', !togel);
        togel = !togel
    });
    var togel2 = false;
    $('#table2 .checkall').click(function () {
        $('#table2 :checkbox').attr('checked', !togel2);
        togel2 = !togel2
    });
    $('table.detailtable tr.detail').hide();
    $('table.detailtable > tbody > tr:nth-child(4n-3)').addClass('odd');
    $('table.detailtable > tbody > tr:nth-child(4n-1)').removeClass('odd').addClass('even');
    $('a.detail-link').click(function () {
        $(this).parent().parent().next().fadeToggle();
        return false
    });
    $('ul.sf-menu').superfish({
        delay: 107,
        animation: false,
        dropShadows: false
    });
    $('.msg').click(function () {
        $(this).fadeTo('slow', 0);
        $(this).slideUp(341)
		
    });
    $('#wysiwyg').wysiwyg();
    $('#newscontent').wysiwyg();
    $('a[rel*=facebox]').facebox();
    $('#dob').datepicker({
        changeMonth: true,
        changeYear: true
    });
    $('#newsdate').datepicker();
    $('.accordion > h3:first-child').addClass('active');
    $('.accordion > div').hide();
    $('.accordion > h3:first-child').next().show();
    $('.accordion > h3').click(function () {
        if ($(this).hasClass('active')) {
            return false
        }
        $(this).parent().children('h3').removeClass('active');
        $(this).addClass('active');
        $(this).parent().children('div').slideUp(200);
        $(this).next().slideDown(200)
    });
    $('.tabcontent > div').hide();
    $('.tabcontent > div:first-child').show();
    $('.tabs > li:first-child').addClass('selected');
    $('.tabs > li a').click(function () {
        var tab_id = $(this).attr('href');
        $(tab_id).parent().children().hide();
        $(tab_id).fadeIn();
        $(this).parent().parent().children().removeClass('selected');
        $(this).parent().addClass('selected');
        return false
    });
    $('#myForm').validate();
    $('.uniform input[type="checkbox"], .uniform input[type="radio"], .uniform input[type="file"]').uniform();
    Cufon.replace('#site-title, h1, article h2, h3, h4, h5, h6')
});