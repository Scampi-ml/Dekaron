<?php 

if(isset($_GET['page'])){
	$user = $_GET['page'];
}else{
	$user = "";
}
	if(isset($_SESSION['user_id'])){
		if($getosds == "user"){
			if($user == ""){
			
			
				}elseif($user == "account"){
				include('user/account.php');
			}
		}else{
			header("Location: ?odsd=user");
		}
	}else{
		echo "No access!";
	}

?>