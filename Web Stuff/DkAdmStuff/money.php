<?php

require_once "config.inc.php";


if(isset($_SESSION[step2]) && isset($_POST[step2])) {
    //ע������һ��
    $errorStr = formStep3();
    if($errorStr!=null){
        require_once('money.html');
    }else{
        $success="�ɹ����ʺţ�$_POST[user_name]������Ϸ��$_POST[money]DIL";
		require_once('success.html');
		unset($_SESSION[step2], $_SESSION[step1]);
    }}
else {
    //ע��ĵڶ���
    require_once('money.html');
    $_SESSION[step2] = 1;	}
	

function formStep3(){
    $errors = array();
    $errorStr = null;
	
//��ѯ�û����Ƿ����
	$strSql1="select * from character.dbo.user_character where character_name='$_POST[user_name]'";
    $character_odbc = odbc_connect('account','DBUSER','DBPASS'); 
    $character_result=odbc_do($character_odbc,$strSql1);
    odbc_fetch_row($character_result);
	$character_no=odbc_result($character_result,1);
	odbc_close($character_odbc);
    if ( $character_no== null)  $errors[] = "�޴���ң�";
	
    if (strlen($_POST[money])<1) $errors[]="���������ӵ���Ϸ����";
	
    if(!preg_match("/^[0-9]{1,12}$/i",$_POST[money])) $errors[]="��Ϸ��ֻ��Ϊ����,����Ϊ1λ";
    if(sizeof($errors)>0){
       $errorStr .= "<br><font>";
       $errorStr .= "��Ϣ�������";
       foreach($errors as $error)
               $errorStr .= "<li>$error</li>";
       $errorStr .= "</font><br><br>";
    }else{

    $money_query="update character.dbo.user_character set dwMoney=dwMoney+$_POST[money] where character_no='$character_no'";
    $dk_money_odbc = odbc_connect('account','DBUSER','PASS'); 
    $dk_money_result=odbc_do($dk_money_odbc,$money_query);
	odbc_close($dk_money_odbc);
    }
    return $errorStr;

}

?>