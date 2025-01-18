<?php
include "osdscore.php";
?>
<div id="serverinfo">Online Players</div>
<table>
	<tr> 
        <th>Account</th> 
        <th>Character</th> 
        <th>Level</th>
        <th>Class</th> 
        <th>MapID</th> 
        <th>&nbsp;</th> 
	</tr> 

<?php    
	flush_this();        	
	$result = $db_account->query("select p.user_id as uid, c.character_name as cnm, c.wlevel as clvl, c.wmapindex cmapi, c.bypcclass as ccls, c.login_time FROM character.dbo.user_character c join account.dbo.user_profile p ON c.user_no = p.user_no WHERE c.login_time IN (SELECT max(login_time) FROM character.dbo.user_character GROUP BY user_no) AND p.login_flag = '1100' and c.login_time is not null order by c.wmapindex desc");  

	$array_class = array('0' => 'Incar Magician', '1' => 'Segita Hunter', '2' => 'Incar Magician', '3' => 'Vicious Summoner', '4' => 'Segnale', '5' => 'Bagi Warrior','6' => 'Aloken'); 

	while ($record = $db_account->fetchArray($result)) 
    { 
        echo "<tr class='even'> 
				<td>".$record['uid']."</td> 
				<td>".$record['cnm']."</td> 
				<td>".$record['clvl']."</td> 
				<td>".$array_class[$record['ccls']]."</td> 
				<td>".$record['cmapi']."</td>
				<td><a href='choose_action.php?userid=".$record['uid']."&action=account'>Action</a></td>
            </tr>"; 
    }
?>
</table>