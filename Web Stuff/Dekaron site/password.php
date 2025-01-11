<?php

require_once "config.inc.php";

if(isset($_SESSION[step2]) && isset($_POST[step2])) {
    //注册的最后一步
    $errorStr = formStep3();
    if($errorStr!=null){
        require_once('password-1.html');
    }else{
        $success="成功给角色：$_POST[user_name]提升到$_POST[level]级";
		require_once('password-2.html');
		unset($_SESSION[step2], $_SESSION[step1]);
    }}
else {
    //注册的第二步
    require_once('password-1.html');
    $_SESSION[step2] = 1;	}

//判断用户提交的表单的数据的 准确性 和 保存提交数据 的函数
function formStep3(){
    $errors = array();
    $errorStr = null;

//查询用户名是否存在
if (strlen($_POST[username])<1) {
    $errors[] = "Please enter your account name.";
}
else {
	$strSql="select * from Tbl_user where user_id='$_POST[username]'";
	if ($_POST[ZoneGroup]=="zone1") { 
	   $account_odbc = odbc_connect('account','jeff','root'); 
       } elseif ($_POST[ZoneGroup]=="zone2") {
	   $account_odbc = odbc_connect('account2','jeff','root');
	   } else { 
	   die ("<p><b>分区选择错误!</b></p>");
	   } 
    $user_result=odbc_do($account_odbc,$strSql);
    $result_query=odbc_fetch_row($user_result);
    $pwdsql="select user_pwd from account.dbo.user_profile where user_id='$_POST[username]'";
	$pwd_result=odbc_do($account_odbc,$pwdsql);
	$pwd_result_query=odbc_fetch_row($pwd_result);
	if (odbc_result($pwd_result,1)=="lock") {
	    die ("<p><b>用户账号已被封停!</b></p>");}
	
    if (odbc_result($user_result,2)=="")  $errors[] = "User Does Not Exist. even you havent registered, or your account name is wrong.";
//验证邮箱及找回密码问题答案正确性
    if (odbc_result($user_result,4)!= $_POST[mail]) $errors[]="Your E-Mail is wrong, I think..";
	if (odbc_result($user_result,5)!= $_POST[answer] or odbc_result($user_result,6)!= $_POST[question]) $errors[]="Question and/or answer is wrong.";
//验证密码是否规范
    if(!preg_match("/^[0-9a-zA-Z]{6,12}$/i", $_POST[newpwd1])) $errors[]="Only English letters and numbers is allowed for your password.";
    if(preg_match("/^[0-9]{6,12}$/i",$_POST[password1])) $errors[]="You cant only have numbers in your password. You will need some letters, too ;]";
//验证用户名和密码是否相同
    if($_POST[username]==$_POST[password1]) $errors[]= "Account name and password cant be the same.";
//验证密码长度
    if(strlen($_POST[newpwd1])<6) $errors[] = "The length of the password can't be less than 6 Chararcters.";
    if(strlen($_POST[newpwd1])>12) $errors[] = "Password can't be bigger than 12 characters.";
//验证密码一致性
    if($_POST[newpwd2]!=$_POST[newpwd1]) $errors[] = "Password is either wrong in one of the text bars, or its all wrong. Try again.";
	$password=md5($_POST[newpwd2]);
}
//错误信息输出
    if(sizeof($errors)>0){
       $errorStr .= "<br><font>";
       $errorStr .= "Error:";
       foreach($errors as $error)
               $errorStr .= "<li>$error</li>";
       $errorStr .= "</font><br><br>";
    }else{
//用户修改密码语句
     $repasswd_query="UPDATE user_profile SET user_pwd='$password' WHERE user_id='$_POST[username]'";
//用户资料保存处密码修改
	 $repasswd_query2="UPDATE Tbl_user SET user_pwd='$_POST[newpwd2]' WHERE user_id='$_POST[username]'";
//执行用户修改密码语句
	 $dk_account_result=odbc_do($account_odbc,$repasswd_query);
	 $dk_account_result=odbc_do($account_odbc,$repasswd_query2);
     odbc_close($account_odbc);


    }
//返回错误消息到页面
    return $errorStr;
}

?>
