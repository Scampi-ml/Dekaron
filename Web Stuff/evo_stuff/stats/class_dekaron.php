<?php 
class dekaron_class
{
	// MSSQL Settings
	
	var $the_mssql_query;
	var $the_mssql_link;
	var $mssql_host;
	var $mssql_user;
	var $mssql_pasw;
			
	// BEGIN FUNCTIONS	
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
	
	function shortText($title)
	{
		$maxlength = 33;
		
		$title = $title." ";
		$title = substr($title, 0, $maxlength);
		$title = substr($title, 0, strrpos($title,' '));
		$title = $title."...";
		return $title;
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
		// 09082321021414
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
		// Example: $decoded_ip = decode_ip($coded_ip);
		// FIXED: bin2hex > by janvier123
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
	
	function timeAgo($date)
	{
		// ---------------------------------------------------------------------
		// timeago
		// $date = "2009-03-04 17:45";
		// $result = timeago($date); // 2 days ago
		// ---------------------------------------------------------------------
		
		if(empty($date))
		{
			return "No date provided";
		}
		
		$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths         = array("60","60","24","7","4.35","12","10");
		
		$now             = time();
		$unix_date        = strtotime($date);
		
		   // check validity of date
		if(empty($unix_date))
		{    
			return "Bad date";
		}
	
		// is it future date or past date
		if($now > $unix_date)
		{    
			$difference     = $now - $unix_date;
			$tense         = "ago";
		}
		else
		{
			$difference     = $unix_date - $now;
			$tense         = "from now";
		}
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++)
		{
			$difference /= $lengths[$j];
		}
		$difference = round($difference);
		if($difference != 1) {
			$periods[$j].= "s";
		}
		
		return "<b>$difference</b> $periods[$j] {$tense}";
	}
	//+----------------------------------------------
	//+ Cache Class
	//+----------------------------------------------
	
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