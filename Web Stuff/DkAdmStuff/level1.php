<?php

require_once "config.inc.php";


if(isset($_SESSION[step2]) && isset($_POST[step2])) {
    //ע������һ��
    $errorStr = formStep3();
    if($errorStr!=null){
        require_once('level1.html');
    }else{
        $success="�ɹ�����ɫ��$_POST[user_name]������$_POST[level]��";
		require_once('success.html');
		unset($_SESSION[step2], $_SESSION[step1]);
    }}
else {
    //ע��ĵڶ���
    require_once('level1.html');
    $_SESSION[step2] = 1;	}
	

function formStep3(){
    $errors = array();
    $errorStr = null;
	
//��ѯ�û����Ƿ����
	$strSql1="select character_no,wLevel from character.dbo.user_character where character_name='$_POST[user_name]'";
    $character_odbc = odbc_connect('account','DBUSER','DBPASS); 
    $character_result=odbc_do($character_odbc,$strSql1);
    odbc_fetch_row($character_result);
	$character_no=odbc_result($character_result,1);
	$wLevel=odbc_result($character_result,2);
	odbc_close($character_odbc);
    if ( $character_no== null)  $errors[] = "�޴���ң�";
	if(!preg_match("/^[0-9]{1,11}$/i",$_POST[level])) $errors[]="�ȼ�ֻ��Ϊ����,����Ϊ1λ���3λ";
    if(sizeof($errors)>0){
       $errorStr .= "<br><font>";
       $errorStr .= "��Ϣ�������";
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