<?php
session_start();

unset($_SESSION['USER']);
unset($_SESSION['USERNO']);
unset($_SESSION['CHARACTERS']);
unset($_SESSION['CHARACTERSNUM']);
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Dekaron Evolution Userpanel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<body class="login">
<script type='text/javascript'>window.location='index.php';</script>
</body>
</html>
