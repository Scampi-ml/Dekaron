	<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			plugins : "safari,pagebreak,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,code,|,insertdate,inserttime,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,charmap,emotions,iespell,media,advhr",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			entity_encoding : "raw",
			convert_newlines_to_brs : true,
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
	
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	</script>

<?php 
if(isset($_GET['page'])){
	$admin = $_GET['page'];
}else{
	$admin = "";
}
if($_SESSION['id']){
	if($_SESSION['admin']){
		if($getdkcms == "admin"){
			if($admin == ""){
				echo "
				
				<form name='navigation' action='nav'>
    <select name='select1' onchange='location.href=navigation.select1.options[selectedIndex].value'>
            <option selected='selected'>Site Administration</option>
                <optgroup label='News Management'>
                    <option value='?dkcms=admin&page=mannews&action=add'>Add News</option>
                    <option value='?dkcms=admin&page=mannews&action=edit'>Edit News</option>
                    <option value='?dkcms=admin&page=mannews&action=del'>Delete News</option>
                </optgroup>
                <optgroup label='Event Management'>
                    <option value='?dkcms=admin&page=manevent&action=add'>Add Event</option>
                    <option value='?dkcms=admin&page=manevent&action=edit'>Edit Event</option>
                    <option value='?dkcms=admin&page=manevent&action=del'>Delete Event</option>
                </optgroup>
                 <optgroup label='Site Management'>
                    <option value='?dkcms=admin&page=settings'>Site Settings</option>
                    <option value='?dkcms=admin&page=styles'>Styles</option>
                    <option value='?dkcms=admin&page=download'>Downloads</option>
					<option value='?dkcms=admin&page=rules'>Rules</option>
                </optgroup>
                <optgroup label='Ticket Management'>
                    <option value='?dkcms=admin&page=ticket'>".unSolved(ticket)."</option>
                </optgroup>


    </select>
</form>
					 ";
			}elseif($admin == "download"){
				include('modules/admin/download.php');
				
			}elseif($admin == "rules"){
				include('modules/admin/rules.php');
				
			}elseif($admin == "gmlog"){
				include('modules/admin/gmlog.php');
				
			}elseif($admin == "logs"){
				include('modules/admin/logs.php');
				
			}elseif($admin == "manevent"){
				include('modules/admin/manage-event.php');
				
			}elseif($admin == "mannews"){
				include('modules/admin/manage-news.php');
								
			}elseif($admin == "settings"){
				include('modules/admin/settings.php');
								
			}elseif($admin == "styles"){
				include('modules/admin/styles.php');
								
			}elseif($admin == "pages"){
				include('modules/admin/pages.php');
				
			}elseif($admin == "ticket"){
				include('modules/admin/ticket.php');
								
			}
		}else{
			header("Location: ?dkcms=admin");
		}
	}else{
		include('modules/public/accessdenied.php');
	}
}else{
	include('modules/public/login.php');
}

?>