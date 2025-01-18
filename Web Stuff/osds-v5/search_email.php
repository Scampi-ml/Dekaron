<div id="serverinfo">Search for: &quot;<?php echo $search_string; ?>&quot; </div>
<table>
	<tr>
    	<th>User Id</th>
        <th>User Mail</th>
        <th>&nbsp;</th>
	</tr>
        
<?php
	flush_this();
	$query = $db_account->query("SELECT user_no,user_id,user_mail FROM Tbl_user WHERE user_mail LIKE '%" . $search_string . "%' "); 
	$results = $db_account->fetchNum($query);
	if ( $results != '0' )
	{
		while ($result = $db_account->fetchArray($query))
		{
	
			echo '<tr class="even">
					<th>'.$result['user_id'].'</th>
					<td>'.$result['user_mail'].'</td>
					<td><a href="choose_action.php?account='. $result['user_no'] . '&userid='.$result['user_id'].'&action=account">'.LAN_action.'</a></td></tr>';
		}
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}
?>