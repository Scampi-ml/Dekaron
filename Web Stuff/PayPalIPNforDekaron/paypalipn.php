<?php
include 'logger.php';
include 'paypalipnconfig.php';
include 'mysql.class.php';
include 'mssql.class.php';

$req = 'cmd=' . urlencode('_notify-validate');
 
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.paypal.com'));
$res = curl_exec($ch);
curl_close($ch);
 
 
// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];

$account = $_POST['custom'];
if($account == 0)
	$acount = 'NO ACCOUNT';
 
$buff = sprintf("%s\t%s\t\$%0.2f\t%s\t%s\t%s", $txn_id, $payment_status, $payment_amount, $receiver_email, $payer_email, $account);
$coins_sent = 0;
 
if (strcmp ($res, "VERIFIED") == 0) 
{
	// create our db connections
	$db_mysql = new mysql();
	$db_mysql->connect();

	$db_mssql = new mssql();
	$db_mssql->connect();

	// check the payment_status is Completed
	if($payment_status == 'Completed')
	{

		// check that txn_id has not been previously processed
		$r = $db_mysql->query("SELECT txn_id FROM paypal_logs WHERE txn_id='".$txn_id."';");

		if(mysql_num_rows($r) == 0)
		{
			// check that receiver_email is your Primary PayPal email
			if($receiver_email == PAYPAL_EMAIL)
			{
				// check that payment_amount/payment_currency are correct
				$validpackage = false;
				for($i = 0; $i < count($paypal_packages); ++$i)
				{
					if($paypal_packages[$i][0] == $payment_amount && $payment_currency == CURRENCY)
					{
						$validpackage = true;
						break;
					}
				}

				// process payment if valid package
				if($validpackage)
				{
					dbg_log('account = '.$account);

					$r = $db_mssql->query("SELECT user_no FROM dbo.USER_PROFILE WHERE user_id='".$account."';");

					if(mssql_num_rows($r))
					{
						$user_no = mssql_fetch_array($r);

						mssql_select_db('cash');
						$r = $db_mssql->query("UPDATE dbo.user_cash SET amount = amount + ".$paypal_packages[$i][1]." WHERE user_no='".$user_no[0]."';");

						// Added coins succesfully!
						if($r)
							$coins_sent = 1;
						else
							dbg_log('ERROR SENDING COINS: '.$buff);
					}
					else
						dbg_log('ACCOUNT NOT FOUND: '.$buff);

					// Add record to MySQL
					$db_mysql->query("INSERT INTO paypal_logs VALUES ('".$txn_id."',".$payment_amount.",'".$payer_email."','".$account."',".$paypal_packages[$i][1].",".$coins_sent.",CURRENT_TIMESTAMP);");

					}
				else
					dbg_log('INVALID PACKAGE: '.$buff);
			}
			else
				dbg_log('INVALID EMAIL: '.$buff);
		}
		else
			dbg_log('DUPLICATE IPN: '.$buff);
	}
	
}
else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
 	dbg_log('INVALID IPN: '.$buff);
}

?>