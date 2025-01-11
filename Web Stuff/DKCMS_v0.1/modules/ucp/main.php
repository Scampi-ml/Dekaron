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
	$ucp = $_GET['page'];
}else{
	$ucp = "";
}
if($siteactive == 0) {
	if(isset($_SESSION['id'])){
		if($getdkcms == "ucp"){
			if($ucp == ""){
				echo "
						<table border='0' width='100%'>
							<tr>
								<td width='100%'>
									<table border='0' width='100%'>
										<tr>
											<td width='100%' a>
												<fieldset class='inner'>
													<legend >
														<b>User Tools</b>
													</legend>
													<a href='?dkcms=ucp&amp;page=accset'>Account Settings</a><br />
													<a href='?dkcms=ucp&amp;page=ticket'>Log a Ticket</a><br />
													<br />
												</fieldset>
											</td>
									</table>
								</td>
							</tr>
						</table>";
			}elseif($ucp == "accset"){
				include('modules/ucp/account.php');
			}elseif($ucp == "ticket"){
				include('modules/ucp/ticket.php');
			}
		}else{
			header("Location: ?dkcms=ucp");
		}
	}else{
		include('modules/public/login.php');
	}
} else {
echo $offlinemessage;
}
?>