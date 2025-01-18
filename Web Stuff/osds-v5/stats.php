<?php include ('osdscore.php'); ?>
<div id="serverinfo">Server Statistics</div>
<div class="response-msg notice"><span>Warning</span>Do not cancel while loading results. It may crash the program.</div>
<table>
    <tr>
        <td>Accounts</td>
      <td><?php $query1 = $db_character->query("SELECT * FROM user_character"); echo $db_character->fetchNum($query1); sleep(1); flush_this(); ?></td>
    	<td>&nbsp;</td>
    </tr>
    <tr>
        <td>Characters</td>
      <td><?php $query2 = $db_account->query("SELECT * FROM user_profile"); echo $db_account->fetchNum($query2); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td >Online Accounts</td>
      <td><?php $query3 = $db_account->query("SELECT * FROM user_profile WHERE login_flag = '1100' "); echo $db_account->fetchNum($query3); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Banned Accounts</td>
      <td><?php $query4 = $db_account->query("SELECT * FROM user_profile WHERE login_tag = 'N' "); echo $db_account->fetchNum($query4); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td >Guilds</td>
      <td><?php $query5 = $db_character->query("SELECT * FROM guild_info "); echo $db_character->fetchNum($query5); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Deadfront</td>
      <td><?php $query6 = $db_character->query("SELECT * FROM cm_bcd_item "); echo $db_character->fetchNum($query6); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td >Deleted Characters</td>
      <td><?php $query7 = $db_character->query("SELECT * FROM del_user_char_list "); echo $db_character->fetchNum($query7); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Characters in guild</td>
      <td><?php $query8 = $db_character->query("SELECT * FROM GUILD_CHAR_INFO "); echo $db_character->fetchNum($query8); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Costumes</td>
      <td><?php $query9 = $db_character->query("SELECT * FROM user_suit "); echo $db_character->fetchNum($query9); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Mails</td>
      <td><?php $query10 = $db_character->query("SELECT * FROM USER_POSTBOX "); echo $db_character->fetchNum($query10); sleep(1); flush_this(); ?></td>
        <td><a href="view_stats_mail.php">View</a></td>
    </tr>
    <tr>
        <td>Deleted Mails</td>
      <td><?php $query11 = $db_character->query("SELECT * FROM USER_POSTBOX_SECEDE "); echo $db_character->fetchNum($query11); sleep(1); flush_this(); ?></td>
        <td><a href="view_stats_deleted_mail.php">View</a></td>
    </tr>
    <tr>
        <td>Character doing quests</td>
      <td><?php $query12 = $db_character->query("SELECT * FROM User_Quest_Doing "); echo $db_character->fetchNum($query12); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Characters done quests</td>
      <td><?php $query13 = $db_character->query("SELECT * FROM User_Quest_Done "); echo $db_character->fetchNum($query13); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Skills</td>
      <td><?php $query14 = $db_character->query("SELECT * FROM user_skill "); echo $db_character->fetchNum($query14); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Storage Items</td>
      <td><?php $query15 = $db_character->query("SELECT * FROM user_storage "); echo $db_character->fetchNum($query15); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Store Items</td>
      <td><?php $query16 = $db_character->query("SELECT * FROM USER_STORE "); echo $db_character->fetchNum($query16); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Items</td>
      <td><?php $query17 = $db_character->query("SELECT * FROM user_bag "); echo $db_character->fetchNum($query17); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Deleted Items</td>
      <td><?php $query18 = $db_character->query("SELECT * FROM user_bag_secede "); echo $db_character->fetchNum($query18); sleep(1); flush_this(); ?></td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>