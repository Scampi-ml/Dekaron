<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/tables.css" />

<!-- jquerytools -->
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript"> jQuery(window).load(function() { jQuery('#loading-image').hide();});</script>


<?php 
include ('class_dekaron.php');

$dekaron = new dekaron_class();
include ('settings.php');


function dekaron_sockets($windex, $info, $serial)
{
	$socket_info_html .= '<div style="margin-left: 20px;">';
	include ('items.php');
	$item = $info;
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
	
	$socket_info_html .= '<h5><center><b style="color: '.$special_color.';">'.$special_name.' '.$items[$windex].'</b></center></h5>';
	// -----------------------------------------------------------------------------------------------
	// END SPECIAL NAME
	// -----------------------------------------------------------------------------------------------
	
    $job = array(
	   '1000-0000-0000-0000-0000-0000-0000-0000' => "Azure Knight",
	   '0100-0000-0000-0000-0000-0000-0000-0000' => "Segita Hunter",
	   '0010-0000-0000-0000-0000-0000-0000-0000' => "Incar Magician",
	   '0001-0000-0000-0000-0000-0000-0000-0000' => "Vicious Summoner",
	   '0000-1000-0000-0000-0000-0000-0000-0000' => "Segnale",
	   '0000-0100-0000-0000-0000-0000-0000-0000' => "Bagi Warrior"
    );	
	
    $weapon_type = array(
	   '4' => "One-Handed",
	   '5' => "Two-handed"
    );	
	
	
	// -----------------------------------------------------------------------------------------------
	// BEGIN DEFAULT STATS - Mysql Based
	// -----------------------------------------------------------------------------------------------
	
	
	//*--------MySQL Connect---------***
	mysql_connect('localhost', 'root', '');
	mysql_select_db('test');
	//*--------MySQL Connect---------***
	
	$item_db_query = mysql_query("SELECT * FROM `items` WHERE `index` = ".$windex." ");
	$item_db = mysql_num_rows($item_db_query);

	
	if($item_db == 1)
	{
		$result = mysql_query("SELECT * FROM `items` WHERE `index` = ".$windex." ");
		while($default_stats = mysql_fetch_array($result) )
		{
			if($default_stats['level_0_melee_min_attack'] != '0' || $default_stats['level_0_magic_min_attack'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Weapon Type</strong> : '.$weapon_type[$default_stats['type']].'</div>';
			}
			
			$socket_info_html .=  '<br>';
			$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Class</strong> : '.$job[$default_stats['job']].'</div>';
			
			if($default_stats['price'] != '0')
			{
				$socket_info_html .=  '<br>';
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Selling Price</strong> : '.number_format($default_stats['price']).'</span></div>'; 
			}
			
			if($default_stats['level_0_defance_min'] != '0')
			{
				$socket_info_html .=  '<br>';
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Defense</strong> : '.$default_stats['level_0_defance_min'].'</div>';
			}
			
			if($default_stats['reqlv'] != '0')
			{			
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Req. Level</strong> : Lv '.$default_stats['reqlv'].'</div>';
			}
			
			if($default_stats['level_0_str_request'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Req. Str</strong> : '.$default_stats['level_0_str_request'].'</div>';
			}
			
			if($default_stats['level_0_dex_request'] != '0')
			{			
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Req. Dex</strong> : '.$default_stats['level_0_dex_request'].'</div>';
			}
			
			if($default_stats['level_0_spr_request'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Req. Spr</strong> : '.$default_stats['level_0_spr_request'].'</div>';
			}
			
			if($default_stats['level_0_melee_min_attack'] != '0' && $default_stats['level_0_melee_max_attack'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Physical Damage</strong> : '.$default_stats['level_0_melee_min_attack'].' ~ '.$default_stats['level_0_melee_max_attack'].'</div>';
			}			
			
			if($default_stats['level_0_magic_min_attack'] != '0' && $default_stats['level_0_magic_max_attack'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Magic Damage</strong> : '.$default_stats['level_0_magic_min_attack'].' ~ '.$default_stats['level_0_magic_max_attack'].'</div>';
			}
			
			if($default_stats['level_0_melee_min_attack'] != '0' || $default_stats['level_0_magic_min_attack'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Attack Speed</strong> : 1</div>';
			}
			
			if($default_stats['level_0_blocking_rate'] != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none"><strong>Block Rate</strong> : '.$default_stats['level_0_blocking_rate'].'%</div>';	
			}
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
			$result2 = mysql_query("SELECT * FROM `item_options` WHERE `optionindex` = '".hexdec($val)."' ");
			$num_res = mysql_num_rows($result2);
			while($special_stats = mysql_fetch_array($result2) )
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #bebbff;">'.$special_stats['type'].' ('.$special_stats['description'].')</div>'; 
			}
			if($num_res == '0')
			{
				$socket_info_html .=  '<br><div style="margin-left:10px; color: #bebbff;">Option Index not found '.hexdec($val).'</div>';
			}
		}
		
	}
	// -----------------------------------------------------------------------------------------------
	// END SPECIAL STATS
	// -----------------------------------------------------------------------------------------------

	// -----------------------------------------------------------------------------------------------
	// BEGIN SERIAL
	// -----------------------------------------------------------------------------------------------
		
		
	$socket_info_html .= '<br>';
	
	$serial2 = '18491200154180400000';
	$serial_str = str_split($serial2, 5);
	
	foreach ($serial_str as $serial_val)
	{
		$socket_info_html .=  '<br><div style="margin-left:10px; color: #cebbff;">'.hexdec($serial_val).'</div>';
	}
	
	// -----------------------------------------------------------------------------------------------
	// END SERIAL
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

echo dekaron_sockets($_GET['windex'], $_GET['info']);



?>