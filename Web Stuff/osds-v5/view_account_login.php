<?php
include ('osdscore.php');

?>
<div id="serverinfo">Account Logout: <?php echo $_GET['userid']; ?></div>
<table>
    <tr>
        <th>Login Time</th>
        <th>Logout Time</th>
        <th>Ip</th>
    </tr>
<?php			
    flush_this();
    $query = $db_account->query("SELECT TOP 100 logout_time,login_time,conn_ip,user_no FROM user_connlog_key WHERE user_no = '".$_GET['account']."' ORDER BY login_time ");
    while ( $LogoutInfo = $db_account->fetchArray($query) )
    {
        echo '
            <tr class="even">
                <td>' . $LogoutInfo['login_time'] . '</td>
                <td>' . $LogoutInfo['logout_time'] . '</td>
                <td><a href="view_ip.php?ip=' . decodeip(bin2hex($LogoutInfo['conn_ip'])) . '" >'.decodeip(bin2hex($LogoutInfo['conn_ip'])) .'</a></td>
            </tr>';
    }
?>
</table>
</body>
</html>