<?php 
if($_SESSION['id']){
	session_destroy();
	include('modules/public/main.php');
	echo "<meta http-equiv=refresh content=\"0; url=?dkcms=main\">";
	}
?>