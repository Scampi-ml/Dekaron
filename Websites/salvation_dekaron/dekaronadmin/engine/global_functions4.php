<?php
//// FUNCTIONS THAT DONT NEEFD A FUNCTION TO BE CALLED
if (!extension_loaded('mssql'))
{
	$error = '
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>PHP Server Error</title>
		<link rel="stylesheet" type="text/css" href="style/error.css" />
		</head>
		<body>
		<div align="center">
		  <div class="maintenance" style="margin-top: 40px;">
			<div class="maintenance_title" align="left">PHP Server Error</div>
			<div class="maintenance_reason" align="left">You didnt load the <b>php_mssql.dll</b> in the <b>php.ini</b> file!</div>
		  </div>
		</div>
		</body>
		</html>
		';	
		return $error;
	die($error);
}

//// FUNCTIONS THAT NEED A FUNCTION TO BE CALLED
function notice_message_admin($notice, $redirect = 0, $error = 0, $url )
{
	// unset _POST
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		unset($key);
		unset($val);
	}

    if ($url == null)
	{
        $url_red = '';
    }
	else
	{
        $url_red = $url;
    }
    if ($error == 1)
	{
        $title   = "Message";
        $go_back = '<br><p><input type="button" onclick="javascript:history.go(-1);" value="Go Back"></p>';
    }
	elseif($error = 2)
	{
        $title   = "Message";
        $go_back = '<br><p><input type="button" onclick="javascript:location.href=\'index.php?get=home\'" value="Back to Home"></p>';
	}
	else
	{
        $title = "Success";
    }
    $return_msg = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border"><tr><td class="cat"><div align="left"><b>' . $title . '</b></div></td></tr><tr><td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>' . $notice . '</p>' . $go_back . '</td> </tr></table>';
    if ($redirect == 1)
	{
        $return_msg .= '<meta http-equiv="Refresh" content="'.htmlspecialchars($GLOBALS["msg_redirect"]).'; URL=' . $url_red . '">';
    }
    return $return_msg;
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

function convertbytes($size)
{
    $unit=array('B','Kb','Mb','Gb','Tb','Pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
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

function safe_input($string, $escape)
{
	$string = preg_replace("[^A-Za-z0-9".$escape."]", "", $string );
	return $string;
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

?> 