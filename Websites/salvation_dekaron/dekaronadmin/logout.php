<?php
session_start();
unset($_SESSION['admin_name']);
unset($_SESSION['server']);
unset($_SESSION["db_host"]);
unset($_SESSION["db_user"]);
unset($_SESSION["db_pasw"]);
session_destroy();
echo "<script type='text/javascript'>window.location='login.php'; </script>";
die();
?>