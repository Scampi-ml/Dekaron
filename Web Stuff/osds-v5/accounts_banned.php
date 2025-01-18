<?php
include ('osdscore.php');
?>
<div id="serverinfo">Banned Accounts</div>
<table>
    <tr>
        <th>User Name</th>
        <th>&nbsp;</th>
    </tr>
	<?php 
    flush_this();
    $query = $db_account->query("SELECT user_id,user_no FROM user_profile WHERE login_tag = 'N' ORDER BY user_id ASC");
    while ( $banned = $db_account->fetchArray($query) )
    {
        echo '
            <tr>
                <td><a href="edit_account.php?account=' . $banned['user_no'] . '">' . $banned['user_id'] . '</a></td>
                <td><a href="choose_action.php?account='. $banned['user_no'] . '&action=account">Action</a></td>
            </tr>';
    }
    ?>  
</table>
</body>
</html>
