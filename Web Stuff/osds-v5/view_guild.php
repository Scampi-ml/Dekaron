<?php
include "osdscore.php"; 

echo HEADER;  

$GET_GUILD_CODE = $_GET['guild'];

if ($GET_GUILD_CODE == "")
{
	JavaAlert(LAN_noguild, 'goback');
	die();
}

$query1 = $db_character->query("SELECT * FROM guild_info WHERE guild_code = '" . $GET_GUILD_CODE . "' ");
$getGuild = $db_character->fetchArray($query1);


echo '<fieldset>
		<legend>'.LAN_view.' '.LAN_guild.': ' . $getGuild['guild_name'] . '</legend>
			<table width="100%" >';

			
					$query2 = $db_character->query("SELECT * FROM guild_char_info WHERE guild_code = '" . $GET_GUILD_CODE . "' ");
					
					while($getGuildChars = $db_character->fetchArray($query2))
					{
						$query3 = $db_character->query("SELECT * FROM user_character WHERE character_name = '".$getGuildChars['character_name']."' ");
						$getCharacterName = $db_character->fetchArray($query3);
						
						$query4 = $db_character->query("SELECT * FROM GUILD_PEERAGE WHERE peerage_code = '".$getGuildChars['peerage_code']."' AND guild_code = '" . $GET_GUILD_CODE . "' ");
						$getPeerageName = $db_character->fetchArray($query4);
						
						$query5 = $db_account->query("SELECT * FROM user_profile WHERE user_no = '".$getCharacterName['user_no']."' ");
						$getAccount = $db_account->fetchArray($query5);

					
						echo '
							<tr class="even">
								<th style="width:'.$CONFIG_TABLE_PX1.'px"><a href="edit_character.php?character=' . $getCharacterName['character_no'] . '">' . $getCharacterName['character_name'] . '</a></th>
								<td >' . $getPeerageName['peerage_name'] . '</td>
							</tr>';
									
					}

	
	echo '
	</table>
</fieldset>';
echo FOOTER;
	
?>
