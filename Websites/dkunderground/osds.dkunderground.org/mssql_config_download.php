<?php
$get_info = $_GET['data'];

$str = base64_decode($get_info);

$downloadfile = "osds_config.php";

header("content-type: plain/text");
header("Content-disposition: attachment; filename=$downloadfile");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");

echo $str; 
?>