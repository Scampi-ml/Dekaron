<?php 
// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$option_selection1 = $_POST['option_selection1'];


$account = $_POST['custom'];
if($account == 0)
	$acount = 'NO ACCOUNT';


	if($payment_status == 'Denied')
	{
		$body             = "
		<h1>Cashback</h1>
		<table style='margin-left:20px;width:600'>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>item_name</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$item_name."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payment_status</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payment_status."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payment_amount</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payment_amount."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payment_currency</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payment_currency."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>txn_id</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$txn_id."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>receiver_email</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$receiver_email."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payer_email</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payer_email."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>credits</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$option_selection1."</td>
			</tr>		
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>account</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$account."</td>
			</tr>																									
		</table>";
	}
	elseif($payment_status == 'Completed')
	{
		if($payment_amount == '5.00')
		{
			$coins = '1200';
		}
		elseif($payment_amount == '10.00')
		{
			$coins = '2100';
		}
		elseif($payment_amount == '15.00')
		{
			$coins = '3200';
		}		
		elseif($payment_amount == '20.00')
		{
			$coins = '4300';
		}
		elseif($payment_amount == '25.00')
		{
			$coins = '6400';
		}
		elseif($payment_amount == '30.00')
		{
			$coins = '7500';
		}
		elseif($payment_amount == '40.00')
		{
			$coins = '10600';
		}
		elseif($payment_amount == '50.00')
		{
			$coins = '21700';
		}
		elseif($payment_amount == '75.00')
		{
			$coins = '41800';
		}
		elseif($payment_amount == '100.00')
		{
			$coins = '61900';
		}
		else
		{
			$coins = '1';
		}
		
		
		$body             = "
		<h1>Completed</h1>
		<table style='margin-left:20px;width:600'>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>item_name</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$item_name."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payment_status</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payment_status."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payment_amount</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payment_amount."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payment_currency</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payment_currency."</td>
			</tr>
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>txn_id</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$txn_id."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>receiver_email</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$receiver_email."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>payer_email</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$payer_email."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>coins</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$option_selection1."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>real_coins</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$coins."</td>
			</tr>	
			<tr>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;font-weight:bold;margin-bottom:5px;' width='140px'>account</td>
				<td style='padding:0px;margin:0px;height:40px;padding-left:20px;background:#ccc;padding:3px;height:30px;border-top:3px solid #ccc;margin-bottom:5px;' >".$account."</td>
			</tr>																									
		</table>";
		date_default_timezone_set("Europe/Paris");

		$link = mssql_pconnect('37.59.180.41', 'SaBaker1893', 'ImPP8pL0h');
		mssql_query("UPDATE cash.dbo.user_cash SET free_amount = free_amount + ".round($coins)." WHERE user_no = '".$account."' ", $link);
		mssql_query("INSERT INTO game.dbo.wwwlog (tijd, charname, logentry) VALUES ('".date("m/d/Y H:i:s")."', 'Someone', 'has donated to the server')", $link);
		mssql_query("INSERT INTO game.dbo.donations (serial, type, user_no, amount, intime) VALUES ('".$txn_id."', 'Paypal', '".$account."', '".round($coins)."', '".date("m/d/Y H:i:s")."')", $link);
	}
	else
	{
		// Meh...
	}
	

?>