<?php
include ('osdscore.php');
include ('class_page.php');
?>
<div id="serverinfo">Account Logout</div>
<?php
flush_this();


$query = $db_account->query("SELECT conn_no FROM USER_CONNLOG_KEY");
$count = $db_account->fetchNum($query);

if($count > 0){
    $page = new page_class($count,18,10);
    $start = $page->get_start();
    $end = $page->get_end();
	
    $query2 = $db_account->query("
    SELECT 
      USER_CONNLOG_KEY.user_no,
      USER_CONNLOG_KEY.login_time,
      USER_CONNLOG_KEY.logout_time,
      USER_CONNLOG_KEY.conn_ip,
      USER_PROFILE.[user_id]
    FROM
      USER_CONNLOG_KEY
      INNER JOIN USER_PROFILE ON (USER_CONNLOG_KEY.user_no = USER_PROFILE.user_no)
    ORDER BY
      USER_CONNLOG_KEY.logout_time ASC");

	$hstring = $page->make_head_string('Results');
	$pstring = $page->make_page_string("");
	
	echo '
	<div id="pageresults"> '.$hstring.' <pp>'.$pstring.'</pp></div>
	<table>
		<tr>
			<th>Account</th>
			<th>Logout Time</th>
			<th>Login Time</th>
			<th>Ip</th>
		</tr>
	';

	
	
    $x = 0;
	while($row2 = $db_account->fetchArray($query2))
	{
		if($x >= $start)
		{
		
			echo '
            <tr class="even">
                <td><a href="choose_action.php?account='. $row2['user_no'] . '&userid='.$row2['user_id'].'&action=account&character_name=&character=">' . $row2['user_id'] . '</a></td>
                <td >' . $row2['logout_time'] . '</td>
                <td >' . $row2['login_time'] . '</td>
                <td align="right"><a href="view_ip.php?ip=' . decodeip(bin2hex($row2['conn_ip'])) . '" >'.decodeip(bin2hex($row2['conn_ip'])) .'</a></td>
            </tr>';


		}
		$x++;
		if($x > $end)
		{
			break;
		}
	}
    echo '</table>';
}
?>			
</body>
</html>