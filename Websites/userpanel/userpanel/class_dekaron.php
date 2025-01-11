<?php 
class dekaron_class
{
	var $the_mssql_query;
	var $the_mssql_link;
	var $mssql_host;
	var $mssql_user;
	var $mssql_pasw;
			
	function flushthis()
	{
        echo '<div id="loading-image"><img src="images/fb_loading.png" /></div>';
    	if (ob_get_length())
		{           
			@ob_flush();
			@flush();
			@ob_end_flush();
		}   
		@ob_start();
	}
			
	function createNewid($length, $characters)
	{
		if ($characters == ''){ return ''; }
		$chars_length = strlen($characters)-1;
		
		mt_srand((double)microtime()*1000000);
		
		$newid = '';
		while(strlen($newid) < $length)
		{
			$rand_char = mt_rand(0, $chars_length);
			$newid .= $characters[$rand_char];
		}
		return $newid;
	}

	function isValid($input)
	{	
		$input = strtolower($input);
		$bad_strings = array("--","select","union","insert","update","like","delete","1=1","or");
	
		if (in_array($input,$bad_strings))
		{
			return false;
		} else {
			return true;
		}
	}
	
	function userno2date($userno )
	{
		$count = strlen($userno);
		if($count == '14')
		{
			$array = str_split($userno,2);
			$return = '20' . $array[0] .'-' . $array[1] . '-' . $array[2]; 
		}
		else
		{
			$return = "NA";
		}
		return $return;
	}
	
	function decodeIp($enc_ip)
	{
		if ( $enc_ip == NULL )
		{
			$return = "No data";
		}
		else
		{
			$enc = bin2hex($enc_ip);
			$ip_pop = explode('.', chunk_split($enc, 2, '.'));
			$return =  hexdec($ip_pop[0]). '.' . hexdec($ip_pop[1]) . '.' . hexdec($ip_pop[2]) . '.' . hexdec($ip_pop[3]);
		}
		return $return;
	}
	
	function _login( $username, $password )
	{
		$_SESSION['RETURNERROR'] = '';
		
		//----------------------------------------------------------------------------------
		if(preg_match('/[^0-9A-Za-z]/', $username))
		{
			$_SESSION['RETURNERROR'] = 'You can only use letters and numbers!';
			echo "<script type='text/javascript'>window.location='index.php'; </script>";
			die();
		}
	
		if(empty($username))
		{
			$_SESSION['RETURNERROR'] = 'You didnt enter a username!';
			echo "<script type='text/javascript'>window.location='index.php'; </script>";
			die();
		}
		
		if(empty($password))
		{
			$_SESSION['RETURNERROR'] = 'You didnt enter a password!';
			echo "<script type='text/javascript'>window.location='index.php'; </script>";
			die();
		}
	
		if ($this->isValid($username) == true && $this->isValid($password) == true)
		{			
			$result = $this->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_id = '".$username."' AND user_pwd = '".md5($password)."' ");
			$getAccNum = $this->SQLfetchNum($result);
			$getAcc = $this->SQLfetchArray($result);
			
			if($getAccNum == '0')
			{	
				// added in 4.0
				include ('class_loginfail.php');
				LoginFail::LoginCheck(true);
				$deny_login = LoginFail::LoginCheck();
				if($deny_login)
				{
					$_SESSION['RETURLOGINFAIL'] = '1';
				}

				$_SESSION['RETURNERROR'] = 'Username or password match not found!';
				echo "<script type='text/javascript'>window.location='index.php'; </script>";
				die();
			}
			elseif($getAcc['login_tag'] == 'N' )
			{
			// and || $getAcc['gmtag'] != '0x99'
				$_SESSION['RETURNERROR'] = 'You have been banned! <strong>Reason:</strong><br><br><i>'.$getAcc['reason'].'</i>';
				echo "<script type='text/javascript'>window.location='index.php'; </script>";
				die();			
			}
			else
			{
				echo '<style>html{ background: none repeat scroll 0 0 #121212; }</style>';
				echo '<span style="color: #fff;">Loading...</span>';
			  	$_SESSION['USER'] = $getAcc['user_id'];
			  	$_SESSION['USERNO'] = $getAcc['user_no'];
				
			  	$query1 = $this->SQLquery("SELECT character_no,character_name,user_no FROM character.dbo.user_character WHERE user_no = '".$getAcc['user_no']."' ");
                $getCharsNum = $this->SQLfetchNum($query1);
                
                if($getCharsNum == 0)
                {
                    $_SESSION['CHARACTERS'] = 0;
					$_SESSION['CHARACTERSNUM'] = 0;
                }
				else
				{
					$_SESSION['CHARACTERSNUM'] = $getCharsNum;
					//$_SESSION['CHARACTERSNUM'] = 0;
					$characters = array();
					while($getChars = $this->SQLfetchArray($query1))
                    {
						$characters[] = $getChars['character_no'].'-'.$getChars['character_name'];
					}
					$_SESSION['CHARACTERS']  = $characters;
				}

			  unset($_SESSION['RETURNERROR']);
			  $this->user_action(''.$_SESSION['USER'].' has logged into the cp');
			  echo "<script type='text/javascript'>window.location='overview.php'; </script>";
			}
		}
		else
		{
			$_SESSION['RETURNERROR'] = 'Fucking noob hacker!';
			echo "<script type='text/javascript'>window.location='index.php'; </script>";
			die();
		}
	}
	
	function checklogged($user)
	{
		$result = $this->SQLquery("SELECT login_flag FROM account.dbo.user_profile WHERE user_no = '".$user."' ");
		$getAcc = $this->SQLfetchArray($result);
		if($getAcc['login_flag'] == '1100')
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	function user_action($action)
	{
		//$this->SQLquery("INSERT INTO gamelog.dbo.evocp2_userlog(user_no,datetime,action) VALUES ('".$_SESSION['USERNO']."', '".date('m/d/Y g:i:s A')."','".$action."') ");
	}
	
	function loginlog($action)
	{
		//$this->SQLquery("INSERT INTO gamelog.dbo.evocp2_loginlog(time,ip) VALUES ('".time()."', '".$_SERVER['REMOTE_ADDR']."') ");
	}
	
	
	
	function countPercent($num_amount, $num_total) 
	{
		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
	}
	
	function _class($class)
	{
		$array_class = array(
			'0' => 'Azure Knight', 
			'1' => 'Segita Hunter', 
			'2' => 'Incar Magician', 
			'3' => 'Vicious Summoner', 
			'4' => 'Segnale', 
			'5' => 'Bagi Warrior', 
			'6' => 'Aloken',
			'10' => 'Concerra Summoner',
			'11' => 'Seguriper'
			); 
		return $array_class[$class];
	}
	
	function dshopfix($user_no)
	{
		$serv_code = '01';
		$rand_code = $this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
		$date = date("ymd");
		$o_id_code = $serv_code . '' . $date . '' . $rand_code;
		$amount = '0';
		$free_amount = '0';
		$this->SQLquery("INSERT INTO cash.dbo.user_cash(id,user_no,group_id,amount,free_amount) VALUES ('".$o_id_code."','".$user_no."','".$serv_code."','".$amount."','".$free_amount."')  ");
	}
	
	
	function checkForRenewal($cache_file)
	{
		$cachetime = '86400'; //one day (24hrs)
		$filetimemod = filemtime($cache_file) + $cachetime;
		if ($filetimemod > time())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
	//+----------------------------------------------
	//+ Datbase Class
	//+----------------------------------------------

	function SQLconnect()
	{	
		@$this->the_mssql_link = mssql_pconnect($this->mssql_host, $this->mssql_user, $this->mssql_pasw) or die('<div class="message error"><h3>Fatal Error!</h3>Cant connect to the database, please try again later.</div>');
	}

	function SQLquery( $query )
	{
		$this->SQLconnect();
		$this->the_mssql_query = $query;
		$result = mssql_query($query) or die('<div class="message error"><h3>Query Error!</h3>The database can not run your request, please try again later.<br>MSSQL ERROR: <b>'.mssql_get_last_message().'</b></div>');
		return $result;
	}

	function SQLfetchArray( $result )
	{
		return mssql_fetch_array($result);
	}
	
	function SQLfetchRow($result)
	{
		return mssql_fetch_row($result);		
	}
	
	function SQLfetchNum($result)
	{
		return mssql_num_rows($result);
	}
			
	function SQLclose()
	{
		mssql_close($this->the_mssql_link);
		
	}
}
?>