<?php

// Database and Server Values
$user_db = 'c0d3r3d10'; // Server Username	
$pass_db = '7rutRUpH'; // Server Password
$host_db = 'remote-mysql4.servage.net'; // Server (e.g. localhost)
$db = 'c0d3r3d10'; // Database to be created or name of existing database (Please note: Database containing dashes cannot be created)
//

// Path to images from the Admin Area - (NO TRAILING SLASH)
$dir = '../images'; // Will be the same as value given if images folder is not moved
//

// Path to images from the Admin Area - (NO TRAILING SLASH)
$dir2 = 'images'; // Will be the same as value given if images folder is not moved
//

// Image Properties
$height = '17'; // The height of the image produced when poll results are shown
$width = '2'; // The multiplier of the images width (If a poll hass 100% of the votes & multiplier is 2 then the width will be 200)
//

// Connect Information - No need to edit
@mysql_connect ($host_db, $user_db, $pass_db);
@mysql_select_db ($db);
//

?>