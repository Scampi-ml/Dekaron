<?php 
include "header.php";

// -----------------------------------
// Get the account
// ----------------------------------- 
$GET_ACCOUNT_NO = $_GET['account'];

// -----------------------------------
// Do we have a account no ?
// -----------------------------------
if ($GET_ACCOUNT_NO == "")
{
	echo '<div class="error msg">Error getting account. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$getAccountInfo = $db->fetchArray($query1);

$query_cash = $db->query('SELECT * FROM cash.dbo.user_cash WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$row_cash = $db->fetchArray($query_cash);
$cash_dshop_check = $db->fetchNum($query_cash);

$query2 = $db->query('SELECT * FROM cash.dbo.user_use_log WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$use_log_num = $db->fetchNum($query2);

// -----------------------------------
// Does he even have a coins id ?
// -----------------------------------
if ($cash_dshop_check == "")
{
	echo '<div class="error msg">
			Error getting coins. Its seems this account does not have a coins ID
			<br>
			<a href="create_coins.php?account=' . $getAccountInfo['user_no'] . '&user_id=' . $getAccountInfo['user_id'].'" ><b>Create an coins ID</b></a>
		</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>View Coins Log: ' . $getAccountInfo['user_id'] . '</h1>
		<table class="gtable sortable">
			<thead>
				<tr>
					<th>Character</th>
					<th>Ip Address</th>
					<th>Item ID</th>
					<th>Date</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>';
			
			if ($use_log_num < 0)
			{
				echo '<tr><td>' . $getAccountInfo['user_id'] . ' did not use any coins.</td></tr>';
			
			} else {
			
				while ( $use_log = $db->fetchArray($query2) )
				{
					echo '
						<tr>
							<td>' . $use_log['character_name'] . '</td>
							<td>' . $use_log['ip_address'] . '</td>
							<td>' . $use_log['item_index'] . '</td>
							<td>' . $use_log['intime'] . '</td>
							<td><a href="view_coins_log_detail.php?id=' . $use_log['id'] . '">More</a></td>
						</tr>';
						
				}
			}
echo'			
			</tbody>
		</table>
</article>';
include "footer.php";
die();

?>
