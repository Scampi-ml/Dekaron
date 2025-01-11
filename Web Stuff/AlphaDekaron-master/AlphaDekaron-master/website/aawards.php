<?php
if(ALLOW_OPEN != 1) {
Header('HTTP/1.1 403');
exit(0);
}
echo '<table><tr><td class=header colspan=5>Alpha Awards</td></tr><tr><td class=submenu colspan=5><a href=?do=awards&type=myawards target=_self>My Awards</a> | <a href=?do=awards&type=challenge target=_self>Challenge List</a></td></tr>';
if ($_GET['type'] == 'challenge')
{
	echo '<tr><td class=submenu><a href=?do=awards&type=challenge&chal=maxlevel>Max Level</a></td></tr>';
	if($_GET['chal'] == 'maxlevel')
	{
		if(!empty($_POST['maxchar']))
		{
			$query = mssql_query("select character_no from character.dbo.user_character where user_no = '".mssql_escape($_SESSION['user_no'])."' and wLevel = '255' and character_name = '".mssql_escape($_POST['maxchar'])."'");
			$count = mssql_num_rows($query);
			if ($count == 1)
			{
				$query2 = mssql_query("select award from osds.dbo.awards where cid = '".mssql_escape($_POST['maxchar'])."' and aid = '".mssql_escape($_SESSION['user_no'])."' and award = 'Max Level'");
				$count = mssql_num_rows($query2);
				if ($count == 0)
				{
					$fetch = mssql_fetch_array($query);
					mssql_query("INSERT INTO osds.dbo.awards (wDate, award, aid, cid) VALUES (getdate(), 'Max Level', '".mssql_escape($_SESSION['user_no'])."', '".mssql_escape($_POST['maxchar'])."')");
					mssql_query("EXEC character.dbo.SP_POST_SEND_OP '".mssql_escape($fetch[0])."','Alpha Dekaron',1,'Max Level Award','Congratulations on achieving max level!','65323','0',0");
					echo '<tr><td>Congratulations on achieving max level!<br>A Heart of the Phoenix has been sent in the mail.</td></tr>';
				}
				else
				{
					echo '<tr><td>This character does not meet the requirements.</td></tr>';
				}
			}
			else
			{
				echo '<tr><td>This character does not meet the requirements.</td></tr>';
			}
		}
		else
		{
			echo '<tr><td><b><u>Challenge:</u></b><br>Get level 255!</tr>';
			$query = mssql_query("select character_name from character.dbo.user_character where user_no = '".mssql_escape($_SESSION['user_no'])."' and wLevel = '255'");
			$count = mssql_num_rows($query);
			if ($count > 0)
			{
				$charLevel = array();
				while($fetch = mssql_fetch_array($query))
				{
					$query2 = mssql_query("select cid from osds.dbo.awards where award = 'Max Level' and aid = '".mssql_escape($_SESSION['user_no'])."' and cid = '".mssql_escape($fetch[0])."'");
					$count2 = mssql_num_rows($query2);
					if ($count2 == 0)
					{
						$charLevel[] = $fetch[0];
					}
				}
				if (count($charLevel) > 0)
				{
					echo '<form action=?do=awards&type=challenge&chal=maxlevel method=post><tr><td><select name=maxchar>';
					foreach($charLevel as $chars)
					{
						echo '<option value="',htmlspecialchars($chars),'">',htmlspecialchars($chars),'</option>';
					}
					echo '</select></td></tr><tr><td><input type=submit value=Apply></input></td></tr></form>';
				}
				else
				{
					echo '<tr><td><b>You do not have any characters that meet the requirements.</b></td></tr>';
				}
			}
			else
			{
				echo '<tr><td><b>You do not have any characters that meet the requirements.</b></td></tr>';
			}
			echo'<tr><td><b>Award:</b> Heart of the Phoenix<br>(200 hp recovery/sec, 1500 shield recovery/sec)</td></tr>';
		}
	}	
}
else
{
	$query = mssql_query("select wDate, award, cid from osds.dbo.awards where aid = '".mssql_escape($_SESSION['user_no'])."' order by wDate asc");
	$count = mssql_num_rows($query);
	if ($count < 1)
	{
		echo '<tr><td  colspan=3>You don\'t have any awards.</td></tr>';
	}
	else
	{
			echo '<tr><td><b><u>Date</u></b></td><td><b><u>Award</u></b></td><td><b><u>Character</u></b></td></tr>';
		while ($fetch = mssql_fetch_array($query))
		{
			echo '<tr><td>',htmlspecialchars($fetch[0]),'</td><td>',htmlspecialchars($fetch[1]),'</td><td>',htmlspecialchars($fetch[2]),'</td></tr>';
		}
	}
}
echo '</table>';
?>