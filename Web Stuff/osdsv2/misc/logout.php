<?php 
if($_SESSION['user_id']){
	session_destroy();
	include('public/main.php');
	echo "<meta http-equiv=refresh content=\"0; url=?osds=main\">";
	}
?>