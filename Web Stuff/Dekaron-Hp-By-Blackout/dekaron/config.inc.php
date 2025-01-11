<?php

//开始session
session_start();

//设置不进行本地缓存
header('Expires: '.date('D,d M Y H:i:s',mktime(0,0,0,1,1,2000)).' GMT');
header('Last-Modified:'.gmdate('D,d M Y H:i:s').' GMT');
header('Cache-control: private, no-cache,must-revalidate');
header('Pragma: no-cache');

$db_name="account";
$db_host="localhost";
$db_user="Dekaron_Platin";
$db_pwd="";
?>
