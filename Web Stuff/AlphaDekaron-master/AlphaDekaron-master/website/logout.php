<?php
if(isset($_SESSION['accname']))
{
mssql_query("INSERT INTO osds.dbo.sessionlog values (getdate(), '".mssql_escape($_SESSION['accname'])."', '".mssql_escape($_SERVER['REMOTE_ADDR'])."', 'Logout')");
session_unset();
session_destroy();
header("location:index.php");
}
else
{
echo 'You\'re  not logged in!';
}
?>


