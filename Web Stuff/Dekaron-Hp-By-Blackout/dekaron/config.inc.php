<?php

//��ʼsession
session_start();

//���ò����б��ػ���
header('Expires: '.date('D,d M Y H:i:s',mktime(0,0,0,1,1,2000)).' GMT');
header('Last-Modified:'.gmdate('D,d M Y H:i:s').' GMT');
header('Cache-control: private, no-cache,must-revalidate');
header('Pragma: no-cache');

$db_name="account";
$db_host="localhost";
$db_user="Dekaron_Platin";
$db_pwd="";
?>
