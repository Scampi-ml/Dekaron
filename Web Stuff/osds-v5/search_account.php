<div id="serverinfo">Search for: &quot;<?php echo $search_string; ?>&quot; </div>
<table>
<?php
	flush_this();
	$query = $db_account->query("SELECT * FROM user_profile WHERE user_id LIKE '%" . $search_string . "%' ORDER BY user_id ASC"); 
	$results = $db_account->fetchNum($query);
	if ( $results != '0' )
	{
		while ($result = $db_account->fetchArray($query))
		{
	
			echo '<tr class="even">
					<th style="width:'.$CONFIG_TABLE_PX1.'px">';
					
					if(exo_getglobalvariable('CONFIG_RED_ACC', '') == 'yes')
					{
						if( $result['login_time'] == NULL )
						{
							echo '<font color="#ff5e5e">'.$result['user_id'].'</font>';
						}
						else
						{
							echo $result['user_id'];
						}
					}
					else
					{
						echo $result['user_id'];
					}
			echo '	</th><td><a href="choose_action.php?account='. $result['user_no'] . '&userid='.$result['user_id'].'&action=account&character=&character_name=">'.LAN_action.'</a></td></tr>';
		}
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}
?>