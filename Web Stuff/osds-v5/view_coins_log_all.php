<?php 
include "osdscore.php";
?>
<div id="serverinfo">View Coins Log</div>
<br />
<table>
    <tr>
        <th>Character</th>
        <th>Ip Address</th>
        <th>Item ID</th>
        <th>Date</th>
        <th>&nbsp;</th>
    </tr>
<?php    
    flush_this();
    $query = $db_cash->query("SELECT TOP 100 character_name,ip_address,item_index,intime,id FROM user_use_log ORDER BY intime DESC");
    while ( $use_log = $db_cash->fetchArray($query) )
    {
        echo '
            <tr>
                <td>' . $use_log['character_name'] . '</td>
                <td><a href="view_ip.php?ip=' . decodeip(bin2hex($use_log['ip_address'])) . '" >'.decodeip(bin2hex($use_log['ip_address'])) .'</a></td>
                <td>' . $use_log['item_index'] . '</td>
                <td>' . $use_log['intime'] . '</td>
                <td><a href="view_coins_log_detail.php?id=' . $use_log['id'] . '">More...</a></td>
            </tr>';
    }
?>                
</table>
</body>
</html>

