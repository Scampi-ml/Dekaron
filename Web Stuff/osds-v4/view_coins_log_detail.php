<?php 
include "header.php";

// -----------------------------------
// Get the account
// ----------------------------------- 
$GET_ID = $_GET['id'];

// -----------------------------------
// Do we have a account no ?
// -----------------------------------
if ($GET_ID == "")
{
	echo '<div class="error msg">Error getting ID. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Get all info
// -----------------------------------
$query2 = $db->query('SELECT * FROM cash.dbo.user_use_log WHERE id = "'.$GET_ID.'" ');
$use_log_num = $db->fetchNum($query2);
$use_log = $db->fetchArray($query2);

// -----------------------------------
// Does he even have an id ?
// -----------------------------------
if ($use_log_num < 0)
{
	echo '<div class="error msg">Error getting ID. Please try again.</div>';
	include "footer.php";
	die();
}

echo '<div class="warning msg">THIS PAGE STILL NEEDS TO BE FINISHED BUT ITS WORKING !</div>';

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Transaction ' . $GET_ID . '</h1>
	<form id="myForm" class="uniform" method="post">
		<dl class="inline">
			<fieldset>
				<dt><label>id</label></dt>
				<dd>' . $use_log['id'] . '</dd>
				
				<dt><label>user_no</label></dt>
				<dd>' . $use_log['user_no'] . '</dd>
				
				<dt><label>group_id</label></dt>
				<dd>' . $use_log['group_id'] . '</dd>					
				
				<dt><label>service_no</label></dt>
				<dd>' . $use_log['service_no'] . '</dd>					
				
				<dt><label>character_name</label></dt>
				<dd>' . $use_log['character_name'] . '</dd>					
				
				<dt><label>ip_address</label></dt>
				<dd>' . $use_log['ip_address'] . '</dd>					
				
				<dt><label>bill_gds_cd</label></dt>
				<dd>' . $use_log['bill_gds_cd'] . '</dd>					
				
				<dt><label>item_sn</label></dt>
				<dd>' . bin2hex($use_log['item_sn']) . '</dd>					
				
				<dt><label>item_index</label></dt>
				<dd>' . $use_log['item_index'] . '</dd>					
				
				<dt><label>product</label></dt>
				<dd>' . $use_log['product'] . '</dd>					
				
				<dt><label>product_amt</label></dt>
				<dd>' . $use_log['product_amt'] . '</dd>					
				
				<dt><label>period</label></dt>
				<dd>' . $use_log['period'] . '</dd>
									
				<dt><label>charge_amt</label></dt>
				<dd>' . $use_log['charge_amt'] . '</dd>
				
				<dt><label>free_amt</label></dt>
				<dd>' . $use_log['free_amt'] . '</dd>
			
				<dt><label>intime</label></dt>
				<dd>' . $use_log['intime'] . '</dd>
			</fieldset>
		</dl>
	</form>
</article>';

include "footer.php";
?>