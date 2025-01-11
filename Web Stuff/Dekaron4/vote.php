<?php
//---------------------------------------------------------- 
$coins = 25; //25 coins 
$webpage = "http://www.vitalitygaming.info/dekaron"; 

// mssql  
    $mssql = array( 
    'host' => "localhost", 
    'user' => "sa", 
    'pass' => "YOURPASSWORD" 
    ); 
     
// mysql 
    $mysql = array( 
    'host' => "localhost", 
    'user' => "root", 
    'pass' => "YOURPASSWORD", 
    'db'   => "vote" 
    ); 
     
//----------------------------------------------------------  
$ip = getenv("REMOTE_ADDR");
$httpref = getenv ("HTTP_REFERER");
$httpagent = getenv ("HTTP_USER_AGENT");
$account = $_POST['account'];
function get_time_difference( $start, $end )
{
    $uts['start']      =    strtotime( $start );
    $uts['end']        =    strtotime( $end );
    if( $uts['start']!==-1 && $uts['end']!==-1 )
    {
        if( $uts['end'] >= $uts['start'] )
        {
            $diff    =    $uts['end'] - $uts['start'];
            if( $days=intval((floor($diff/86400))) )
                $diff = $diff % 86400;
            if( $hours=intval((floor($diff/3600))) )
                $diff = $diff % 3600;
            if( $minutes=intval((floor($diff/60))) )
                $diff = $diff % 60;
            $diff    =    intval( $diff );            
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
        }
        else
        {
        }
    }
    else
    {
    }
    return( false );
}
if (empty($account))
{
	echo "<p>Incorrect format.</p>";
}
elseif (ereg("[^0-9a-zA-Z_-]", $account, $txt))
{
	echo "<p>Incorrect format.</p>";
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
		$sql="insert into users (account,ip,date,votes) values ('".$account."','".$ip."',NOW(),1)";
		$sqlLOG="insert into log (account,ip,date) values ('".$account."','".$ip."',NOW())";mysql_query($sqlLOG,$mylink);
		if (!mysql_query($sql,$mylink))
		{ 
		die('Error: ' . mysql_error());
		} else {
			$result3 = mssql_query("SELECT user_no,user_id FROM account.dbo.user_profile WHERE user_id = '".$account."'",$ms_con);
			$row3 = mssql_fetch_row($result3);
			$user_no = $row3[0];
			$amount=$coins;		
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$user_no."'",$ms_con);
		    	echo 'Thank you for your vote! <a href='.$webpage.'>Now click here';
			}
		} elseif($count2 > '1'){
		} else {
				$voted_ip = $row2[2];
				$voted_date = $row2[3];
				$voted_id = $row2[0];
				$voted_account = $row2[1];
				$current_date = date("Y-m-d H:m:s");
				$diff=get_time_difference($voted_date, $current_date);
				if ($diff['hours'] > '11') {
				$sql="update users set votes=votes+1, date = '".$current_date."', ip='".$ip."' where id='".$voted_id."'";
				$sqlLOG="insert into log (account,ip,date) values ('".$account."','".$ip."',NOW())";mysql_query($sqlLOG,$mylink);
				if (!mysql_query($sql,$mylink))
				{ 
				die('Error: ' . mysql_error());
				} else {
				$result4 = mssql_query("SELECT user_no,user_id FROM account.dbo.user_profile WHERE user_id = '".$account."'",$ms_con);
				$row4 = mssql_fetch_row($result4);
				$user_no = $row4[0];
				$amount=$coins;		
				mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$user_no."'",$ms_con);				
		    	echo 'Thank you for your vote! <a href='.$webpage.'>Now click here';
					}			
				} else {
					echo "<p>You can't vote anymore! Try again later.<p>";
				}
			}	
	}
}
?>