<?php 
if(isset($_GET['page'])){
	$dev = $_GET['page'];
}else{
	$dev = "";
}
if($_SESSION['user_id']){
	if($_SESSION['dev']){
		if($getosds == "dev"){
			if($dev == ""){
			echo '
				';  
			}elseif($dev == "search"){
				include('dev/search.php');
			}elseif($dev == "ecoins"){
				include('dev/ecoins.php');
			}elseif($dev == "search2"){
				include('dev/search2.php');
			}elseif($dev == "semail"){
				include('dev/semail.php');
			}elseif($dev == "ban_acc"){
				include('dev/ban_acc.php');
			}elseif($dev == "echaracter"){
				include('dev/echaracter.php');
			}elseif($dev == "character2"){
				include('dev/character2.php');
			}elseif($dev == "saccount"){
				include('dev/saccount.php');
			}elseif($dev == "eaccount"){
				include('dev/eaccount.php');

			}
		}else{
			header("Location: ?osds=admin");
		}
	}else{
	echo "No access!";
	}
}else{
	echo "No access!";
}

?>