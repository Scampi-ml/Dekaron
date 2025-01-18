var IMAGE_URL = 'images/';
jQuery.noConflict();
jQuery(function ($) {
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
    $('#wysiwyg').wysiwyg();
    $('#newscontent').wysiwyg();
    $('#dob').datepicker({
        changeMonth: true,
        changeYear: true
    });
    $('#newsdate').datepicker();
    $('#myForm').validate();
    $('.uniform input[type="checkbox"], .uniform input[type="radio"], .uniform input[type="file"]').uniform();
	
	$(function() {
	
	  var options = {
		  autoOpen: false,
		  width: 600,
		  modal: true
		};
	
	  $([1, 2, 3]).each(function() {
		var num = this;
		var dlg = $('#dialoginfo' + num)

		  .dialog(options);
		$('#dialoglink' + num).click(function() {
		  dlg.dialog("open");
		  return false;
		});
	  });
	
	}); 


	  //1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20

	$("select[value]").each(function(){
		$(this).val(this.getAttribute("value"));
	});
	

	
});


