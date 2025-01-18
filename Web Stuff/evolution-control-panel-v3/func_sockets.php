<?php
function dekaron_sockets($wIndex, $info)
{
	$socket_info_html .= '<div>';
	include ('items.php');
	$item = strtoupper(bin2hex($info));
	$str = str_split($item, 4);
	
	// -----------------------------------------------------------------------------------------------
	// BEGIN SPECIAL NAME
	// -----------------------------------------------------------------------------------------------
	if($item == '00')
	{
		$item_special = '';
	}
	else
	{
		if(is_numeric(hexdec($str[1])) && $str[4] == '')
		{
			$item_special = 'magic';
		}
		else
		{
			$item_special = 'divine';	
		}
	}
			
	if($item_special == 'magic')
	{
		$special_name = '-Magic Item-';
		$special_color = 'lightblue';							
	}
	elseif($item_special == 'divine')
	{
		$special_name = '-Divine Noble Item-';
		$special_color = 'yellow';														
	}
	else
	{
		$special_name = '';
		$special_color = '#fff';
	}
	
	$socket_info_html .= '<h5><center><b style="color: '.$special_color.';">'.$special_name.' '.$items[$wIndex].'</b></center></h5>';
	// -----------------------------------------------------------------------------------------------
	// END SPECIAL NAME
	// -----------------------------------------------------------------------------------------------
	
	
	// -----------------------------------------------------------------------------------------------
	// BEGIN DEFAULT STATS - Mysql Based
	// -----------------------------------------------------------------------------------------------
	
	
	//*--------MySQL Connect---------***
	mysql_connect('localhost', 'root', '');
	mysql_select_db('test');
	//*--------MySQL Connect---------***
	
	$item_armor_db_query = mysql_query("SELECT * FROM `itemarmor` WHERE `index` = ".$wIndex." ");
	$item_etc_db_query = mysql_query("SELECT * FROM `itemetc` WHERE `index` = ".$wIndex." ");
	$item_weapon_db_query = mysql_query("SELECT * FROM `itemweapon` WHERE `index` = ".$wIndex." ");
	
	$item_armor_db = mysql_num_rows($item_armor_db_query);
	$item_etc_db = mysql_num_rows($item_etc_db_query);
	$item_weapon_db = mysql_num_rows($item_weapon_db_query);

	
	if($item_armor_db == 1)
	{
		$result = mysql_query("SELECT * FROM `itemarmor` WHERE `index` = ".$wIndex." ");
		while($default_stats = mysql_fetch_array($result) )
		{
			
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>BUYVALUE</strong> : <BUYVALUE></div>'; 
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>SELLVALUE</strong> : '.number_format($default_stats['price']).'</span></div>'; 
			
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>ENDUARANCE</strong> : <ENDUARANCE></div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>PCCLASS</strong> : <PCCLASS></div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>REQLV</strong> : '.$default_stats['reqlv'].'</div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>DEFENSE</strong> : '.$default_stats['level_0_defance_min'].'</div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>REQSTR</strong> : <REQSTR></div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>REQDEX</strong> : <REQDEX></div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>REQSPR</strong> : <REQSPR></div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>MINMAXDEFENCE</strong> : <MINMAXDEFENCE></div>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>BLOCKINGRATE</strong> : <BLOCKINGRATE></div>';		
			
		}
	}
	elseif($item_etc_db == 1)
	{
		$result = mysql_query("SELECT * FROM itemetc WHERE index = '".$wIndex."' ");
		while($default_stats = mysql_fetch_array($result) )
		{
			//$socket_info_html .= '<address>';
			//$socket_info_html .=  '<div style="margin-left:10px;"><span style="color: #fff;">No default stats found.</span></div>'; 
			//$socket_info_html .= '</address>';
		}
	}
	elseif($item_weapon_db == 1)
	{
		$result = mysql_query("SELECT * FROM itemweapon WHERE index = '".$wIndex."' ");
		while($default_stats = mysql_fetch_array($result) )
		{
			//$socket_info_html .= '<address>';
			//$socket_info_html .=  '<div style="margin-left:10px;"><span style="color: #fff;">No default stats found.</span></div>'; 
			//$socket_info_html .= '</address>';
		}
	}
	else
	{
		$socket_info_html .=  '<div style="margin-left:10px;"><span style="color: #fff;">No default stats found.</span></div>'; 
	}
		
	
		
	// -----------------------------------------------------------------------------------------------
	// END DEFAULT STATS - Mysql Based
	// -----------------------------------------------------------------------------------------------
	
	
	
	
	// -----------------------------------------------------------------------------------------------
	// BEGIN SPECIAL STATS
	// -----------------------------------------------------------------------------------------------
	
	$socket_info_html .= '<br>';	
		
	foreach ($str as $val)
	{
		if($val == '0' && $val == '0000')
		{
		
		}
		else
		{
			$socket_info_html .=  '<div style="margin-left:10px; color: #bebbff;">'.hexdec($val).'</div>'; 
		}
	}
		
		
	$socket_info_html .= '<br>';
	
		
	// -----------------------------------------------------------------------------------------------
	// END SPECIAL STATS
	// -----------------------------------------------------------------------------------------------
		
	$socket_info_html .= '<br>';
	
	// -----------------------------------------------------------------------------------------------
	// BEGIN SOCKETS
	// -----------------------------------------------------------------------------------------------
	
	if(count($str) == '1')
	{
		$sock = '';
	}
	else
	{
		$sock = '0';
		
		if($str[0] == '0000')
		{
			$sock++;
			
		}
		if($str[1] == '0000')
		{
			$sock++;
		}
		if($str[2] == '0000')
		{
			$sock++;
		}
		if($str[3] == '0000')
		{
			$sock++;
		}
		
		
		if($sock == '1')
		{
			$socket_info_html .= '<img src="images/socket.png">';
		}
		elseif($sock == '2')
		{
			$socket_info_html .= '<img src="images/socket.png">';
			$socket_info_html .= '<img src="images/socket.png">';
		}
		elseif($sock == '3')
		{
			$socket_info_html .= '<img src="images/socket.png">';
			$socket_info_html .= '<img src="images/socket.png">';
			$socket_info_html .= '<img src="images/socket.png">';
		}
		elseif($sock == '4')
		{
			$socket_info_html .= '<img src="images/socket.png">';
			$socket_info_html .= '<img src="images/socket.png">';
			$socket_info_html .= '<img src="images/socket.png">';
			$socket_info_html .= '<img src="images/socket.png">';
		}
		else
		{
			// no sockets to be displayed
		}
	}
	
	
	// -----------------------------------------------------------------------------------------------
	// END SOCKETS
	// -----------------------------------------------------------------------------------------------
	
	
		
						
	$socket_info_html .= '</div>';
	return $socket_info_html;

}
?>