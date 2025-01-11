<?php

require_once "config.inc.php";


if(isset($_SESSION[step2]) && isset($_POST[step2])) {
    //注册的最后一步
    $errorStr = formStep3();
    if($errorStr!=null){
        require_once('post.html');
    }else{
        $success="sucessfully added to:$_POST[user_name]发送了代码为$_POST[wIndex]物品$_POST[number]个";
		require_once('success.html');
		unset($_SESSION[step2], $_SESSION[step1]);
    }}
else {
    //注册的第二步
    require_once('post.html');
    $_SESSION[step2] = 1;	}
	

function formStep3(){
    $errors = array();
    $errorStr = null;
	
//查询用户名是否存在
    $post_title='Reward';
    $body_text='Here is your personal Reward/Starting KIT Sent by a GM. Click on ATTACHMENT to put the attached item in your inventory, and delete this message :)';

	$strSql1="select character_no from character.dbo.user_character where character_name='$_POST[user_name]'";
    $character_odbc = odbc_connect('account','DBUSER','DBPASS'); 
    $character_result=odbc_do($character_odbc,$strSql1);
    odbc_fetch_row($character_result);
	$character_no=odbc_result($character_result,1);
	odbc_close($character_odbc);
    if ( $character_no== null)  $errors[] = "无此玩家！";
	
	if (!preg_match("/^[0-9]{1,5}$/i",$_POST[wIndex])) $errors[]="物品代码为１－５位的数字";
	if (!preg_match("/^[0-9]{1,3}$/i",$_POST[number])) $errors[]="物品数目为１－３位数字，最多99个";
	
	if(sizeof($errors)>0){
       $errorStr .= "<br><font>";
       $errorStr .= "信息输入错误：";
       foreach($errors as $error)
               $errorStr .= "<li>$error</li>";
       $errorStr .= "</font><br><br>";
    }else{
	$post_query="EXEC character.dbo.SP_POST_SEND_OP '$character_no','[GM]TheRoss',1,'$post_title','$body_text','$_POST[wIndex]',0,0 ";
    $dk_post_odbc = odbc_connect('account','DBUSER','DBPASS'); 
	
	for ($i=1; $i<=$_POST[number]; $i++) {
	    $dk_post_result=odbc_do($dk_post_odbc,$post_query);
    }
    
	odbc_close($dk_post_odbc);
    }
    return $errorStr;

}

?>

itemlist:<br>
60082,Veteran's Amulet<br>
60069,Super Noble Health C Pack 5000<br>
60070,Super Noble Mana C Pack<br>