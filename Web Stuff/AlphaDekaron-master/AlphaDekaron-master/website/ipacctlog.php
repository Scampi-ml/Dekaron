<?php
if(ALLOW_OPEN != 1) {
Header('HTTP/1.1 403');
exit(0);
}

$query = mssql_query("SELECT distinct Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) from account.dbo.user_connlog_key where user_no = '".mssql_escape($_SESSION['user_no'])."'");
echo '<table><tr><td class=header colspan=2>Game Account IP Login Log</td></tr><tr><td><b><u>IP</u></b></td><td><b><u>Login time</u></b></td></tr>';
while ($fetch = mssql_fetch_array($query))
{
$query2 = mssql_query("SELECT max(login_time) from account.dbo.user_connlog_key where Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) = '".mssql_escape($fetch[0])."'");
$fetch2 = mssql_fetch_array($query2);
echo '<tr><td>',htmlspecialchars($fetch[0]),'</td><td>',htmlspecialchars($fetch2[0]),'</td></tr>';
}
echo '</table>';

$query = mssql_query("SELECT distinct IP from osds.dbo.sessionlog where account = '".mssql_escape($_SESSION['accname'])."'");
echo '<br><br><table><tr><td class=header colspan=2>Site IP Login Log</td></tr><tr><td><b><u>IP</u></b></td><td><b><u>Login time</u></b></td></tr>';
while ($fetch = mssql_fetch_array($query))
{
$query2 = mssql_query("SELECT max(wTime) from osds.dbo.sessionlog where IP = '".mssql_escape($fetch[0])."' and wAction = 'Login Success'");
$fetch2 = mssql_fetch_array($query2);
echo '<tr><td>',htmlspecialchars($fetch[0]),'</td><td>',htmlspecialchars($fetch2[0]),'</td></tr>';
}
echo '</table>';
?>