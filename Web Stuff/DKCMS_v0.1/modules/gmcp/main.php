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
		$gmcp = $_GET['page'];
}else{
	$gmcp = "";
}
	if($_SESSION['id']){
		if($_SESSION['gm']){
			if($getdkcms == "gmcp"){
				if($gmcp == ""){
					echo "<fieldset><legend><b>GameMaster Control Panel</b></legend>";
					echo "<table border='0' width='100%'>";
						echo "<tr>";
							echo "<td width='100%'>";
								echo "<table border='0' width='100%'>";
								echo "<tr>";
									echo "<td width='100%' valign='top'>";
										echo "<a href='?dkcms=gmcp&amp;page=manblog&amp;action=add'>Add Blog</a><br />";
										echo "<a href='?dkcms=gmcp&amp;page=manblog&amp;action=edit'>Edit Blog</a><br />";
										echo "<a href='?dkcms=gmcp&amp;page=manblog&amp;action=del'>Delete Blog</a><br />";
										echo "<a href='?dkcms=gmcp&amp;page=ticket'>".unSolved("ticket")."<br/>";
									echo "</td>";
								echo "</tr>";
								echo "</table>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";
					echo "</fieldset>";
				}elseif($gmcp == "manblog"){
					include('modules/gmcp/manage-blog.php');
				}elseif($gmcp == "ticket"){
					include('modules/gmcp/ticket.php');
				}
			}else{
				header("Location: ?dkcms=gmcp");
			}
		}else{
			include('modules/public/accessdenied.php');
		}
	}else{
		include('modules/public/login.php');
	}

?>