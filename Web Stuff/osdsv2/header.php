<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" type="text/css" rel="stylesheet">
<link type="text/css" href="css/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/jquery-blink.js"></script>
<script type="text/javascript" language="javascript">
 
$(document).ready(function()
{
	$('.blink').blink(); // default is 500ms blink interval.
        $('.blink').blink({delay:250}); // causes a 100ms blink interval.
});
 
</script>
<script type="text/javascript">

	$(function(){

		// Accordion
		$("#accordion").accordion({ header: "h3" });

		// Tabs
		$('#tabs').tabs();


		// Dialog
		// About character search			
		$('#dialog1').dialog({
			autoOpen: false,
			modal: true,
			height: 400,
			width: 600,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}, 
			}
		});
		
		// Dialog	
		// php info		
		$('#dialog2').dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			height: 400,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}, 
			}
		});
		
		// Dialog	
		// ban account		
		$('#dialog3').dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}, 
			}
		});
		
		// Dialog	
		// About ip search		
		$('#dialog4').dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}, 
			}
		});
		
		// Dialog	
		// info character		
		$('#dialog5').dialog({
			autoOpen: false,
			width: 600,
			modal: true,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}, 
			}
		});
		


		
		



				
		// Dialog Link
		// About character search
		$('#dialog_link1').click(function(){
			$('#dialog1').dialog('open');
			return false;
		});
		
		// Dialog Link
		// About account search
		$('#dialog_link2').click(function(){
			$('#dialog2').dialog('open');
			return false;
		});
		
		// Dialog Link
		// ban account
		$('#dialog_link3').click(function(){
			$('#dialog3').dialog('open');
			return false;
		});

		// Dialog Link
		// About ip search
		$('#dialog_link4').click(function(){
			$('#dialog4').dialog('open');
			return false;
		});
		
		// Dialog Link
		// info character
		$('#dialog_link5').click(function(){
			$('#dialog5').dialog('open');
			return false;
		});
		





		// Datepicker
		$('#datepicker').datepicker({
			inline: true
		});
		
		// Slider
		$('#slider').slider({
			range: true,
			values: [17, 67]
		});
		
		// Progressbar
		$("#progressbar").progressbar({
			value: 20 
		});
		
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
		);
		
	});
</script>
<script type="text/javascript">
$(document).ready(function(){	
	$("a").easyTooltip();
});
</script>
</head>
<body>
<div align="center">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#111111">
      <tr>
        <td class="logo" colspan="4" width="100%" height="121"><img src="css/images/logo.png" width="500" height="121" alt=""></td>
      </tr>
      	<tr>
        <td class="nav" colspan="2" width="80%" height="32">
        
        <?php
		
		if(isset($_SESSION['user_id'])){
		
		?>
        		<div style="float: right; padding-right: 5px;">Welcome back, <a href='?osds=user&page=account'><?php echo $_SESSION['user_id']; ?></a><a href='?osds=misc&amp;script=logout'>Log Out</a></li></b></div>
        <?php
        } else {
            echo "";
        }
       ?> 
                
    <ul id="jsddm">
        <li><a href="?osds=main">Home</a></li>


<?php

if(isset($_SESSION['dev'])){
echo "<li><a href='?osds=main'>DEV Menu</a></li>";
}

if(isset($_SESSION['gm'])){
echo "<li><a href='?osds=main'>GM Menu</a></li>";
}

if(isset($_SESSION['user_id'])){
echo "<li><a href='?osds=main'>User Menu</a></li>";
}

?>
        </ul> 
	</tr>
      <tr>
        <td class="main_content" colspan="2" width="100%"  valign="top"> 
        
