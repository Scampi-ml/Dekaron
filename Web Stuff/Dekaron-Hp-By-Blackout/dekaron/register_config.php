<?php

require_once "config.inc.php";

if(isset($_SESSION[step2]) && isset($_POST[step2])) {
    //提取的最后一步
    $errorStr = formStep3();
    if($errorStr!=null){
        require_once('register.html');
    }else{
        require_once('success.html');
		$suc=$success;
		unset($_SESSION[step2], $_SESSION[step1]);
    }}
else {
    //Username
    require_once('register.html');
    $_SESSION[step2] = 1;	}


//判断用户提交的表单的数据的 准确性 和 保存提交数据 的函数
function formStep3(){
    $errors = array();
    $errorStr = null;
//查询用户名是否存在
	$strSql="select * from Tbl_user where user_id='$_POST[username]'";
	if ($_POST[ZoneGroup]=="zone1") { 
	   $account_odbc = odbc_connect('account','sa','admin'); 
       } elseif ($_POST[ZoneGroup]=="zone2") {
	   $account_odbc = odbc_connect('account2','sa','admin');
	   } else { 
	   die ("<p><b>分区选择错误!</b></p>");
	   } 
    $user_result=odbc_do($account_odbc,$strSql);
    $result_query=odbc_fetch_row($user_result);
    if (odbc_result($user_result,1)!= "")  $errors[] = "This Accountname already exists, please choose another one.";
//验证用户名是否规范
    if(!preg_match("/^[0-9a-zA-Z]{3,15}$/i", $_POST[username])) $errors[]="You are only alowed to use uppper and lower cases in English in your username.";
//验证用户名长度
    if(strlen($_POST[username])<3) $errors[] = "The length of your username can't be less than 3 characters";
    if(strlen($_POST[username])>15) $errors[]= "The length of your username can't be more than 15 characters";
//验证密码是否规范
    if(!preg_match("/^[0-9a-zA-Z]{3,15}$/i", $_POST[password1])) $errors[]="You can only use English Characters of Upper case and lower case in your password. Try again";
    if(preg_match("/^[0-9]{3,15}$/i",$_POST[password1])) $errors[]="You are not alowed just to input numbers as your password.";
//验证用户名和密码是否相同
    if($_POST[username]==$_POST[password1]) $errors[]= "Accountname and password can't be the same!";
//验证密码长度
    if(strlen($_POST[password1])<3) $errors[] = "The length of the password can't be less than 3 characters";
    if(strlen($_POST[password1])>15) $errors[] = "The length of the password can't be more than 15 characters";
//验证密码一致性
    if($_POST[password2]!=$_POST[password1]) $errors[] = "Password does not match";
//验证找回密码问题答案长度
    if(strlen($_POST[question])>20) $errors[] = "The length of the secret question can't be more than 20 characters";
    if(strlen($_POST[question])<5) $errors[] = "The length of the secret question can't be less than 5 characters";
    if(strlen($_POST[answer])>20) $errors[] = "The length of the secret answer can't be more than 20 characters";
    if(strlen($_POST[answer])<5) $errors[] = "The length of the secret answer can't be less than 5 characters";
//验证用户email正确性
    if(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST[mail])) $errors[]="Your E-mail Adress is not valid. Please enter a valid one.";


//错误信息输出
    if(sizeof($errors)>0){
       $errorStr .= "<br><font>";
       $errorStr .= "You have the following error(s):";
       foreach($errors as $error)
               $errorStr .= "<li>$error</li>";
       $errorStr .= "</font><br><br>";
    }else{

//加密密码
    $passwd_user=md5($_POST[password1]);
//获取user_no
     $dk_time=strftime("%y%m%d%H%M%S");
     list($usec1, $sec1) = explode(" ",microtime());
     $dk_user_no=$dk_time.substr($usec1,2,2);
//用户注册语句
	 $dk_account_query="insert into user_profile(user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,ipt_time,login_time,logout_time,user_ip_addr,server_id) values('$dk_user_no','$_POST[username]','$passwd_user','801011000000','1','0','Y','05/06/2009 00:00:00',null,null,null,'000')";
//用户资料保存
	 $dk_account_query2="insert into Tbl_user(user_no,user_id,user_pwd,user_mail,user_answer,user_question) values('$dk_user_no','$_POST[username]','$_POST[password1]','$_POST[mail]','$_POST[answer]','$_POST[question]')";
  //执行用户注册和资料保存语句
	 $dk_account_result1=odbc_do($account_odbc,$dk_account_query);
	 $dk_account_result2=odbc_do($account_odbc,$dk_account_query2);
     odbc_close($account_odbc);



    }
//返回错误消息到页面
    return $errorStr;
}

?>
