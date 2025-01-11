<?php
//---------------------------------------------------------- 
$coins = 250; //250 coins 
$webpage = "http://www.xtremetop100.com/in.php?site=1132343940"; 


// mssql  
    $mssql = array( 
    'host' => "localhost ", 
    'user' => "sa", 
    'pass' => "xxxxx" 
    ); 
     
// mysql 
    $mysql = array( 
    'host' => "localhost", 
    'user' => "deadd_vote", 
    'pass' => "xxxxx", 
    'db'   => "deaddk_vote" 
    ); 
     
//----------------------------------------------------------  
function fetch_ip()
{
	if(isset($_SERVER['HTTP_CF_CONNECTING_IP']))
	{
		return $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	else
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}

	function time_left_vote($futureTime)
	{
		$delay2 = '43200';
		$now2 = $futureTime + $delay2;
		$difference = $now2 - time();
		if($now2 > time())
		{
		  $days = intval($difference / 86400);
		  $difference = $difference % 86400;
		  $hours = intval($difference / 3600);
		  $difference = $difference % 3600;
		  $minutes = intval($difference / 60);
		  $difference = $difference % 60;
		  $seconds = intval($difference);
		  $return = $hours."h ".$minutes."m ".$seconds."s"; 
		}
		else
		{
			$return = 'ok';
		}	
		return $return;  
	}
$ip = fetch_ip();
$httpref = getenv ("HTTP_REFERER");
$httpagent = getenv ("HTTP_USER_AGENT");
$account = $_POST['account'];

if (empty($account))
{
	echo '<meta http-equiv="refresh" content="0; url=http://deaddekaron.com/index.php?dk=votenow">';	
}
elseif (ereg("[^0-9a-zA-Z_-]", $account, $txt))
{
	echo "<p>Incorrect name format.</p>";
}
else 
{
    $ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	$result1 = mssql_query("SELECT * FROM account.dbo.user_profile WHERE user_id = '".$account."'",$ms_con);
	$count1 = mssql_num_rows($result1);
	if($count1 < '1') {
	echo "<p>Account not found.</p>";
	} elseif($count > '1') {
	echo "<p>Too many results.</p>";
	} else { 
	$mylink = mysql_Connect($mysql['host'], $mysql['user'], $mysql['pass']);
	mysql_select_db($mysql['db'],$mylink);
    $result2 = mysql_query("select * from users where account='".$account."'",$mylink);
	$row2 = mysql_fetch_row($result2);
	$count2 = mysql_num_rows($result2);
	if($count2< '1'){
		$sql="insert into users (account,ip,votetime,votes) values ('".$account."','".$ip."','".time()."',1)";
		$sqlLOG="insert into log (account,ip,votetime) values ('".$account."','".$ip."','".time()."')";mysql_query($sqlLOG,$mylink);
		if (!mysql_query($sql,$mylink))
		{ 
		die('Error: ' . mysql_error());
		} else {
			$result3 = mssql_query("SELECT user_no,user_id FROM account.dbo.user_profile WHERE user_id = '".$account."'",$ms_con);
			$row3 = mssql_fetch_row($result3);
			$user_no = $row3[0];
			$amount=$coins;		
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$user_no."'",$ms_con);
		    	echo 'Thank you! <meta http-equiv="refresh" content="1; url='.$webpage.'"> ';
			}
		} elseif($count2 > '1'){
		} else {
				$voted_ip = $row2[2];
				$voted_date = $row2[3];
				$voted_id = $row2[0];
				$voted_account = $row2[1];
				$current_date = time();
				
				
				$diff = time_left_vote($voted_date);
				
				
				if ($diff == 'ok') {
				$sql="update users set votes=votes+1, votetime = '".time()."', ip='".$ip."' where id='".$voted_id."'";
				$sqlLOG="insert into log (account,ip,votetime) values ('".$account."','".$ip."','".time()."')";mysql_query($sqlLOG,$mylink);
				if (!mysql_query($sql,$mylink))
				{ 
				die('Error: ' . mysql_error());
				} else {
				$result4 = mssql_query("SELECT user_no,user_id FROM account.dbo.user_profile WHERE user_id = '".$account."'",$ms_con);
				$row4 = mssql_fetch_row($result4);
				$user_no = $row4[0];
				$amount=$coins;		
				mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$user_no."'",$ms_con);				
		    	echo 'Thank you! <a href='.$webpage.'>Now click here to finish the process!';		
					         }			
				} else {
					echo "<p>You can't vote anymore! Try waiting ".time_left_vote($voted_date).".<p>";
				}
			}	
	}
}
?>
