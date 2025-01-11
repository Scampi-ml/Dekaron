<?php
// PaypalIPNConfig.php

// --- MYSQL CONFIG ---
define('MYSQL_HOST', '127.0.0.1');		// Mysql host address
define('MYSQL_USER', 'user');			// User name
define('MYSQL_PASS', 'password');		// User password
define('MYSQL_DB', 'paypal');			// Database name


// --- MSSQL CONFIG ---
define('MSSQL_HOST', '127.0.0.1');		// Mssql host address
define('MSSQL_USER', 'user');			// User name
define('MSSQL_PASS', 'password');		// User password

// --- PAYPAL CONFIG ---
define('PAYPAL_EMAIL', 'myemail@domain.com'); // Your paypal email on which you recieve payments
define('CURRENCY', 'USD');				// The type of currency you set up in paypel
$paypal_packages = array(
// $ Price , Coin amount -- delimit arrays with a comma to add more
array(5.99, 1000),
array(9.99, 2000),
array(20.00, 5000)
);

?>