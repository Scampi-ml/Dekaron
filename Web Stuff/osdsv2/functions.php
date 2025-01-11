<?php
function anti_injection($sql) {
   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
   $sql = trim($sql);
   $sql = strip_tags($sql);
   $sql = addslashes($sql);
   return $sql;
}

function shortTitle($title){
	$maxlength = 33;
	$title = $title." ";
	$title = substr($title, 0, $maxlength);
	$title = substr($title, 0, strrpos($title,' '));
	$title = $title."...";
	return $title;
}

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

function decode_ip($enc_ip) {
$ip_pop = explode('.', chunk_split($enc_ip, 2, '.'));

return hexdec($ip_pop[0]). '.' . hexdec($ip_pop[1]) . '.' . hexdec($ip_pop[2]) . '.' . hexdec($ip_pop[3]);
}


?>