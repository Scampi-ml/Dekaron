<?php 

if(isset($_GET['script'])){
	$script = $_GET['script'];
}else{
	$script = "";
}
if($getdkcms == "misc"){
	if($script == ""){
		header("Location: ?dkcms=main");
	}elseif($script == "redir"){
		include('modules/misc/redir.php');
	}elseif($script == "logout"){
		include('modules/misc/logout.php');
	}else{
		header("Location: ?dkcms=main");
	}
}
?>