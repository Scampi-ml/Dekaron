<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] != '2')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
if(empty($_POST['select'])) {
		echo "<table><form action=?do=delinfo method=POST>
				<tr><td class=header colspan=3 ><b>Delete selected info</b></td></tr>
				<tr><td>Character Name:<br><input type=text name=charname maxlength=20></td></tr>
				<tr><td><input type=checkbox name=box[] value=delfq>Delete Finished Quests<br>
				<input type=checkbox name=box[] value=delqip>Delete Quest In-Progress<br>
				<input type=checkbox name=box[] value=delinv>Delete Inventory<br>
				<input type=checkbox name=box[] value=delmail>Delete Mail<br>
				<input type=checkbox name=box[] value=delshop>Delete Shop<br>
				<input type=checkbox name=box[] value=delskill>Delete Skills<br>
				<input type=checkbox name=box[] value=delskillbar>Delete Skillbar<br>
				<input type=checkbox name=box[] value=delstorage>Delete Storage<br>
				<input type=checkbox name=box[] value=delei>Delete Equipped Items</td></tr>
				<tr><td><input type='submit'name='select' value='Delete'></td></tr></form></table>";
	} elseif($_POST['select'] == 'Delete') 
			{
			
			$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".mssql_escape($_POST['charname'])."'");
			$rows = mssql_num_rows($result1);
			if(empty ($_POST['charname']) || $rows < '1') {
			echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Back</a>";
			}
				 
			else {
			$box = $_POST['box'];
			
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE character_name = '".mssql_escape($_POST['charname'])."'");
			$row2 = mssql_fetch_row($result2);
			if (in_array('delfq', $box) == true)
				{
			mssql_query("DELETE FROM character.dbo.User_Quest_Done WHERE character_no = '".mssql_escape($row2[0])."'");
				echo "<br>The characters done quest's has been successfully deleted.";
				}
				if (in_array('delqip', $box) == true)
					{
					mssql_query("DELETE FROM character.dbo.User_Quest_Doing WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters On-going quest's has been successfully deleted.";
				}
					if (in_array('delinv', $box) == true)
					{
					mssql_query("DELETE FROM character.dbo.user_bag WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters inventory items has been successfully deleted.";
				}
					if (in_array('delmail', $box) == true)
					{
						mssql_query("DELETE FROM character.dbo.USER_POSTBOX WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters mailbox has been successfully cleaned out.";
					}
					if (in_array('delshop', $box) == true)
					{
					mssql_query("DELETE FROM character.dbo.user_storage WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters personal shop items has been successfully cleaned out.";
					}
					if (in_array('delskill', $box) == true)
					{		
					mssql_query("DELETE FROM character.dbo.user_skill WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters skills has been successfully deleted.";
					}
					if (in_array('delskillbar', $box) == true)
					{
					mssql_query("DELETE FROM character.dbo.user_slot WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters skillbar has been successfully deleted.";
					}
					if (in_array('delstorage', $box) == true)
					{
						mssql_query("DELETE FROM character.dbo.user_storage WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters storage items has been successfully deleted.";
					}
					if (in_array('delei', $box) == true)
					{
					mssql_query("DELETE FROM character.dbo.user_suit WHERE character_no = '".mssql_escape($row2[0])."'");
					echo "<br>The characters equipped items has been successfully deleted.";
					}
			}
}

?>

