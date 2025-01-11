<?php 

if(isset($_GET['script'])){
	$script = $_GET['script'];
}else{
	$script = "";
}
if($getosds == "misc"){
	if($script == ""){
		header("Location: ?osds=main");
	}elseif($script == "redir"){
		include('misc/redir.php');
	}elseif($script == "logout"){
		include('misc/logout.php');
	}else{
		header("Location: ?osds=main");
	}
}
?>