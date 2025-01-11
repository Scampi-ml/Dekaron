<?php
//// FUNCTIONS THAT DONT NEEFD A FUNCTION TO BE CALLED

if(!extension_loaded('zlib'))
{
	@ini_set('zlib.output_compression_level', 1);  
	@ob_start('ob_gzhandler'); 
}


function flush_this()
{
	if (ob_get_length())
	{           
		@ob_flush();
		@flush();
		@ob_end_flush();
	}   
	@ob_start();
}

function checkForRenewal()
{
	$file = 'temp/md5_file_list.dat';
	$time = '10';
	$filetimemod = @filemtime($file) + $time;
	if ($filetimemod < time())
	{
		return 'needed';
	}
	else
	{
		return 'not_needed';
	}
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
        $title   = "Error";
        $go_back = '<br><p><input type="button" onclick="javascript:history.go(-1);" value="Go Back"></p>';
    }
	elseif($error = 2)
	{
        $title   = "Error";
        $go_back = '<br><p><input type="button" onclick="javascript:location.href=\'index.php?get=home\'" value="Back to Home"></p>';
	}
	else
	{
        $title = "Success";
    }
    $return_msg = '<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
						<tr>
							<td class="cat"><div align="left"><b>' . $title . '</b></div></td>
						</tr>
						<tr>
							<td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>' . $notice . '</p>' . $go_back . '
						</td> 
						</tr>
					</table>';
    if ($redirect == 1)
	{
        $return_msg .= '<meta http-equiv="Refresh" content="'.htmlspecialchars($GLOBALS["msg_redirect"]).'; URL=' . $url_red . '">';
    }
    return $return_msg;
}

function ZahlenFormatieren($Wert)
{
	if ($Wert > 1099511627776)
	{
		$Wert = number_format($Wert / 1099511627776, 2, ".", ",") . " Tb";
	} elseif ($Wert > 1073741824)
	{
		$Wert = number_format($Wert / 1073741824, 2, ".", ",") . " Gb";
	} elseif ($Wert > 1048576)
	{
		$Wert = number_format($Wert / 1048576, 2, ".", ",") . " Mb";
	} elseif ($Wert > 1024)
	{
		$Wert = number_format($Wert / 1024, 2, ".", ",") . " Kb";
	}
	else
	{
		$Wert = number_format($Wert, 2, ".", ",") . " Bytes";
	}

	return $Wert;
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
	$string = ereg_replace("[^A-Za-z0-9".$escape."]", "", $string );
	return $string;
}


function register_admin($user,$pass)
{
	$errorText = '';
		
	$pfile = fopen("engine/admins.txt","a+");
    rewind($pfile);

    while (!feof($pfile))
	{
        $line = fgets($pfile);
        $tmp = explode(':', $line);
        if ($tmp[0] == $user)
		{
            $errorText = "The selected admin name is already taken";
            break;
        }
    }
	
    if ($errorText == '')
	{
		$userpass = md5($pass);
		fwrite($pfile, "\r\n$user:$userpass");
		mkdir("engine/admins/".$user."/", 0777);
    }
    
    fclose($pfile);
	return $errorText;
}
?> 