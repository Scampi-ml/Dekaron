<?php
session_start();
require_once ('../includes/config.php');
;echo '';
if ($_SESSION['kal_login'] != 'yes'){
require_once ('../includes/login_template.php');exit();
} else {
require_once ('../includes/template.php');exit();
}
?>