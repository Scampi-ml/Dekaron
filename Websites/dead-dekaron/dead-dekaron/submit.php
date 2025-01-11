<?php
// starts session to save generated random number
session_start(); 


// -----------------------------------
// Retard proof
// -----------------------------------
if (!extension_loaded('mssql'))
{
	echo '<b>ERROR!</b> You didnt load the <b>php_mssql.dll</b> in the <b>php.ini</b> file!';
	die();
}
// -----------------------------------
// Lets see if we can compress the pages?
// -----------------------------------
if(!extension_loaded('zlib'))
{
	@ini_set('zlib.output_compression_level', 1);  
	@ob_start('ob_gzhandler'); 
}
// -----------------------------------
// Anti SQL Inject
// -----------------------------------
function anti_injection($sql)
{
   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
   $sql = trim($sql); 
   $sql = strip_tags($sql);
   $sql = addslashes($sql);
   return $sql;
}



// we check if everything is filled in
if(empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['pass2']))
{
	die(msg(0,"All the fields are required"));
}

// is the email valid?
if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email'])))
{
	die(msg(0,"You haven't provided a valid email"));
}

$con = mssql_connect('localhost', 'sa', 'xxxxx');

$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".anti_injection($_POST['fname'])."'",$con);
$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '".anti_injection($_POST['fname'])."'",$con);
$result3 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".anti_injection($_POST['email'])."'",$con);

$row1 = mssql_num_rows($result1);
$row2 = mssql_num_rows($result2);
$row3 = mssql_num_rows($result3);




// redirected after registration.

/* this compare captcha's number from POST and SESSION */
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha'])
	{
	

		if($row1 > '0' || $row2 > '0')
		{
			die(msg(0,"This Account name already exists"));
		}
		elseif($row3 > '0') 
		{
			die(msg(0,"This E-Mail is already in use"));
		}
		elseif($_POST['pass'] != $_POST['pass2']) 
		{
			die(msg(0,"The passwords did not match"));
		}
		elseif($_POST['pass'] == $_POST['fname'])
		 {
			die(msg(0,"Account name and password are the same."));
		}
		elseif(strlen($_POST['fname']) < 3 || strlen($_POST['fname']) > 15) 
		{
			die(msg(0,"The Accountname must at least 3 indications long and may maximally 15 indications long"));
		}
		elseif(strlen($_POST['pass']) < 3 || strlen($_POST['pass']) > 15) 
		{
			die(msg(0,"The Password must at least 3 indications long and may maximally 15 indications long"));
		}
		else
		{
			$dk_time = strftime("%y%m%d%H%M%S");
			list($usec1, $sec1) = explode(" ",microtime());
			$dk_user_no = $dk_time.substr($usec1, 2, 2);
			
			$pass = md5($_POST['pass']);
							
			$query1 = mssql_query("INSERT INTO account.dbo.USER_PROFILE 
			(user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,ipt_time,login_time,logout_time,user_ip_addr,server_id) 
			VALUES 
			('$dk_user_no','".anti_injection($_POST['fname'])."','".$pass."','801011000000','1','0','Y','".$date."',null,null,null,'000')",$con);
			
			$query2 = mssql_query("INSERT INTO account.dbo.Tbl_user 
			(user_no,user_id,user_pwd,user_mail,user_answer,user_question) 
			VALUES 
			('$dk_user_no','".anti_injection($_POST['fname'])."','".anti_injection($_POST['pass'])."','".anti_injection($_POST['email'])."','0','0')",$con);
			
			if(!$query1)
			{
				die(msg(0,"Database Query Failed"));
			}
			elseif (!$query2)
			{
				die(msg(0,"Database Query Failed"));
			}
			else
			{
				echo msg(1,"registered.html");
				unset($_SESSION['captcha']); /* this line makes session free, we recommend you to keep it */
			}
							
	
		}
		
	} 
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['captcha']))
	{
		die(msg(0,"Verify that you are a human"));
	}
/* in case that form isn't submitted this file will create a random number and save it in session */
else
	{
		$rand = rand(0,4);
		$_SESSION['captcha'] = $rand;
		echo $rand;
	}






function msg($status,$txt)
{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}
?>
