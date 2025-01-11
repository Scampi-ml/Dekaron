<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>launcher</title>
<style type="text/css">
<!--
body {
	margin:0; 
	padding:0;
	background-color: #5b5c60;
	color:#FFFFFF;
}
a {
	color:#FFFFFF;
}
a:link, a:visited {
	color:#FFFFFF;
	text-decoration:none;
}
a:hover {
	color:#FFFFFF;
}
-->
</style>
</head>
<body>
<a href="http://www.beyond-dk.eu/" target="_blank"><img src="vote.png" border="0"></a>
<hr>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo @htmlspecialchars_decode(file_get_contents('http://www.beyond-dk.eu/forums/ssi4.php?a=out&f=20,32,33,35&show=5&type=rss')); ?>
</table>
<hr>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col" align="center">Next deadfront</th>
    <th scope="col" align="center">Server Time</th>
  </tr>
  <tr>
    <td align="center"><?php require_once ('dfcounter.php'); ?></td>
    <td align="center"><?php require_once ('time.php'); ?></td>
  </tr>
</table>
</body>
</html>
