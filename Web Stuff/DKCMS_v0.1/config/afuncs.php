<?php 

if(basename($_SERVER["PHP_SELF"]) == "afuncs.php"){
	die("403 - Access Forbidden");
}


function shortTitle($title){
	$maxlength = 33;
	$title = $title." ";
	$title = substr($title, 0, $maxlength);
	$title = substr($title, 0, strrpos($title,' '));
	$title = $title."...";
	return $title;
}
function isIE() {
 $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
  if(strpos($user_agent, 'MSIE') !== false) {
	return true;
  } else {
	return false;
  }
}
$IE = isIE();

function unSolved($type){
	if($type == "ticket"){
		$GrabTickets = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets WHERE status = 'Open'");
		$counttick = mssql_num_rows($GrabTickets);
		if($counttick == 1){
			$tickquant = "is";
			$tickplural = "";
		}else{
			$tickquant = "are";
			$tickplural = "s";
		}
		return "There ".$tickquant." <u><b>".$counttick." unsolved ticket".$tickplural."</b></u>.";
	}
}
?>