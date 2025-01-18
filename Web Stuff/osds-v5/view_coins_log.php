<?php 
include "osdscore.php";
?>
<table>
    <tr>
        <th>Character</th>
        <th>ip</th>
        <th>Item</th>
        <th>date</th>
        <th>&nbsp;</th>
    </tr>
                
                


<?php

$GET_ACCOUNT_NO = $_GET['account'];
$GET_USER_ID = $_GET['userid'];

if ($GET_ACCOUNT_NO == "")
{
		JavaAlert(LAN_ea_error_no_account,  'goback');
		die();
}

$query2 = $db_cash->query("SELECT * FROM user_use_log WHERE user_no = ".$GET_ACCOUNT_NO." ");
$use_log_num = $db_cash->fetchNum($query2);

if ($use_log_num == '0')
{
	JavaAlert(LAN_vcl_nolog, 'goback');
	die();
}

echo '
	<h2>'.LAN_view.' '.lcfirst(LAN_coins).' '.lcfirst(LAN_log).': ' . $GET_USER_ID . '</h2>
	<hr>

				';
			
				while ( $use_log = $db_cash->fetchArray($query2) )
				{
					echo '
						<tr>
							<td >' . $use_log['character_name'] . '</td>
							<td ><a href="view_ip.php?ip=' . decodeip(bin2hex($use_log['ip_address'])) . '" >'.decodeip(bin2hex($use_log['ip_address'])) .'</a></td>
							<td >' . $use_log['item_index'] . '</td>
							<td >' . $use_log['intime'] . '</td>
							<td ><a href="view_coins_log_detail.php?id=' . $use_log['id'] . '">More...</a></td>
						</tr>';
				}
			
echo'</table>';
echo FOOTER;

?>
