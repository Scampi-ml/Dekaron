<?php

require_once "config.inc.php";


if(isset($_SESSION[step2]) && isset($_POST[step2])) {
    //注册的最后一步
    $errorStr = formStep3();
    if($errorStr!=null){
        require_once('level1.html');
    }else{
        $success="成功给角色：$_POST[user_name]提升到$_POST[level]级";
		require_once('success.html');
		unset($_SESSION[step2], $_SESSION[step1]);
    }}
else {
    //注册的第二步
    require_once('level1.html');
    $_SESSION[step2] = 1;	}
	

function formStep3(){
    $errors = array();
    $errorStr = null;
	
//查询用户名是否存在
	$strSql1="select character_no,wLevel from character.dbo.user_character where character_name='$_POST[user_name]'";
    $character_odbc = odbc_connect('account','DBUSER','DBPASS); 
    $character_result=odbc_do($character_odbc,$strSql1);
    odbc_fetch_row($character_result);
	$character_no=odbc_result($character_result,1);
	$wLevel=odbc_result($character_result,2);
	odbc_close($character_odbc);
    if ( $character_no== null)  $errors[] = "无此玩家！";
	if(!preg_match("/^[0-9]{1,11}$/i",$_POST[level])) $errors[]="等级只能为数字,最少为1位最大3位";
    if(sizeof($errors)>0){
       $errorStr .= "<br><font>";
       $errorStr .= "信息输入错误：";
       foreach($errors as $error)
               $errorStr .= "<li>$error</li>";
       $errorStr .= "</font><br><br>";
    }else{
    $level_query="update character.dbo.user_character set dwExp=dwExp+$_POST[level] where character_no='$character_no'";
    $dk_level_odbc = odbc_connect('account','DBUSER','DBPASS); 
    $dk_level_result=odbc_do($dk_level_odbc,$level_query);
	odbc_close($dk_level_odbc);
    }
    return $errorStr;

}

?>