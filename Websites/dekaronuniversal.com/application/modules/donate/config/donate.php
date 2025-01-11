<?php
/*
|--------------------------------------------------------------------------
| General settings
|--------------------------------------------------------------------------
*/
$config['donation_currency'] = "USD"; 
$config['donation_currency_sign'] = "$";
/*
|--------------------------------------------------------------------------
| PayPal Donation (www.paypal.com)
|--------------------------------------------------------------------------
*/
$config['donate_paypal'] = array(
	'use' => true,
	'email' => "dekaronuniversal@gmail.com",
	'sandbox' => false, // false: live servers | true: testing/dev servers
	'values' => array(
		'5' => "5750",
		'10' => "11500",
		'20' => "23300",
		'35' => "28750",
		'50' => "61500",
		'75' => "88500",
		'100' => "125000",
		'200' => "255000"
	)
);
				

$config['force_code_editor'] = true;