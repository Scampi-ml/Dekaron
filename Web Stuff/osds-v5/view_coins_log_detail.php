<?php 
include "osdscore.php";

flush_this();
$query2 = $db_cash->query("SELECT * FROM user_use_log WHERE id = '".$_GET['id']."' ");
$use_log = $db_cash->fetchArray($query2);
?>

<fieldset>
	<legend>Transaction Id: <?php echo $_GET['id']; ?></legend>
	<table >
		<tr class="even">
			<td style="width:50%;"><label>Transaction Id</label></td>
			<td style="width:50%;"><?php echo $use_log['id']; ?></td>
		</tr>
		<tr class="even">
			<td><label>User No</label></td>
			<td><?php echo $use_log['user_no']; ?></td>
		</tr>
		<tr class="even">
			<td><label>Group Id</label></td>
			<td><?php echo $use_log['group_id']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Service No</label></td>
			<td><?php echo $use_log['service_no']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Character Name</label></td>
			<td><?php echo $use_log['character_name']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Ip</label></td>
			<td><?php echo $use_log['ip_address']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Item Serial Number</label></td>
			<td><?php echo bin2hex($use_log['item_sn']); ?></td>					
		</tr>
		<tr class="even">
			<td><label>Item Index</label></td>
			<td><?php echo $use_log['item_index']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Product</label></td>
			<td><?php echo $use_log['product']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Product Amount</label></td>
			<td><?php echo $use_log['product_amt']; ?></td>					
		</tr>
		<tr class="even">
			<td><label>Period</label></td>
			<td><?php echo $use_log['period']; ?></td>
		</tr>
		<tr class="even">
			<td><label>Charge Amount</label></td>
			<td><?php echo $use_log['charge_amt']; ?></td>
		</tr>
		<tr class="even">
			<td><label>Free Amount</label></td>
			<td><?php echo $use_log['free_amt']; ?></td>
		</tr>
		<tr class="even">
			<td><label>Date</label></td>
			<td><?php echo $use_log['intime']; ?></td>
		</tr>
	</table>
</fieldset>
</body>
</html>
