<div id="serverinfo">Search for: &quot;<?php echo $search_string; ?>&quot; </div>
<table>
    <tr>
        <th>Guild Name</th>
        <th>Guild Level</th>
        <th>&nbsp;</th>
    </tr>
<?php
	flush_this();
	$query = $db_character->query("SELECT guild_code,guild_name,guild_Level FROM guild_info WHERE guild_name LIKE '%" . $search_string . "%' ORDER BY guild_name ASC ");
	$results = $db_character->fetchNum($query);


	if ( $results > exo_getglobalvariable('CONFIG_SEARCH_MAX', '') )
	{
		JavaAlert('Too many results, please be more specific \nFound '.$results.'', 'goback');
		die();
	}
				
	if ( $results != '0' )
	{
		while ($result = $db_character->fetchArray($query))
		{

			preg_match('/^MASTERCODE/', $result['guild_name'], $matches, PREG_OFFSET_CAPTURE);
			if( $matches ) 
			{
				continue;
			}

			echo '<tr class="even">
					<td>'.$result['guild_name'].'</td>
					<td>'.$result['guild_Level'].'</td>
					<td><a href="edit_guild.php?guild='.$result['guild_code'].'">Action</a></td>
				  </tr>';
		}
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}




?>
