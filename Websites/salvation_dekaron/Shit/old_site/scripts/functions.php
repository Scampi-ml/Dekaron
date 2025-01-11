<?php
//// FUNCTIONS THAT DONT NEEFD A FUNCTION TO BE CALLED

function anti_injection($sql)
{
   $sql = @preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
   $sql = trim($sql); 
   $sql = strip_tags($sql);
   $sql = addslashes($sql);
   return $sql;
}

function checkEmailAddress( $address )
{
	if (function_exists('filter_var'))
	{ //Introduced in PHP 5.2
        if(filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE)
		{
          return false;
        }
		else
		{
          return true;
        }
    }
	else
	{
        return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
	}
}

function xssCheckUrl( $url )
{
	// This causes problems if people submit bbcode with urlencoded items that are valid
	// e.g.: http://www.google.com/search?q=site%3Aipb3preview.ipslink.com+-%22Viewing+Profile%22
	// %22 gets changed into " and then this fails, even though this is a valid url
	// $url = trim( urldecode( $url ) );
	$url	= trim( $url );

	/* Test for http://%XX */
	if ( stristr( $url, 'http://%' ) )
	{
		return FALSE;
	}
	
	/* Test for http://&XX */
	if ( stristr( $url, 'http://&' ) )
	{
		return FALSE;
	}

	if ( ! preg_match( '#^(http|https|news|ftp)://(?:[^<>\"]+|[a-z0-9/\._\- !&\#;,%\+\?:=]+)$#iU', $url ) )
	{
		return FALSE;
	}

	return TRUE;
}

function alnum($string)
{
    if(preg_match('/[^a-zA-Z0-9]/', $string) == 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function alnum_u($string)
{
    if(preg_match('/[^a-zA-Z0-9_]/', $string) == 0)
    {
        return true;
    }
    else
    {
        return false;
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

function countPercent($num_amount, $num_total) 
{
	$count1 = $num_amount / $num_total;
	$count2 = $count1 * 100;
	$count = number_format($count2, 0);
	return $count;
}

function _map($map)
{
	require_once ('array_map.php');
	return $array_map[$map];	
}

function _class($class)
{
	require_once ('array_class.php');
	return $array_class[$class];
}

function dshopfix($user_no)
{
	$serv_code = '01';
	$rand_code = createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
	$date = date("ymd");
	$o_id_code = $serv_code . '' . $date . '' . $rand_code;
	$amount = '0';
	$free_amount = '0';
	$db->SQLquery("INSERT INTO cash.dbo.user_cash(id,user_no,group_id,amount,free_amount) VALUES ('".$o_id_code."','".$user_no."','".$serv_code."','".$amount."','".$free_amount."')  ");
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
function ParseCSVFile($file)
{
	$n = 0;
	while(!feof($file))
	{
		$sArr[$n] = fgets($file);
		++$n;
	}
	return $sArr;
}

function GetItemData($data, $index, $idCol, $getCol)
{
	for($i = 0; $i < count($data); ++$i)
	{
		$s = explode(',', $data[$i]);
		if($s[$idCol] == $index)
		{
			return $s[$getCol];
		}
	}
	return '';
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

function formatSeconds($secondsLeft)
{
  $minuteInSeconds = 60;
  $hourInSeconds = $minuteInSeconds * 60;
  $dayInSeconds = $hourInSeconds * 24;
  $days = floor($secondsLeft / $dayInSeconds);
  $secondsLeft = $secondsLeft % $dayInSeconds;
  $hours = floor($secondsLeft / $hourInSeconds);
  $secondsLeft = $secondsLeft % $hourInSeconds;
  $minutes= floor($secondsLeft / $minuteInSeconds);
  $seconds = $secondsLeft % $minuteInSeconds;
  $timeComponents = array();



  if ($minutes > 0) {
    $timeComponents[] = $minutes . " minute" . ($minutes > 1 ? "s" : "");
  }

  if ($seconds > 0) {
    $timeComponents[] = $seconds . " second" . ($seconds > 1 ? "s" : "");
  }

  if (count($timeComponents) > 0)
  {
    $formattedTimeRemaining = implode(", ", $timeComponents);
    $formattedTimeRemaining = trim($formattedTimeRemaining);
  }
  return $formattedTimeRemaining;

}




?> 