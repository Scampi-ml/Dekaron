<?php
session_start();

unset($_SESSION['USER']);
unset($_SESSION['USERNO']);
unset($_SESSION['CHARACTERS']);
unset($_SESSION['CHARACTERSNUM']);
unset($_SESSION['gdusername']);
unset($_SESSION['gdpassword']);

session_unset();
session_destroy(); 
setcookie ("gdusername", "",time()-60*60*24*100, "/");
setcookie ("gdpassword", "",time()-60*60*24*100, "/");


echo "<script type='text/javascript'>window.location='index.php';</script>";
?>