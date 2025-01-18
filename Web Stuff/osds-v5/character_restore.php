<?php
include ('osdscore.php');
echo HEADER;

$query = $db_character->query("SELECT * FROM user_character_secede");


echo '<div class="group">
		<h2>Restore Character</h2>
			<table>
				<tr>
					<th>Character Name</th>
					<th>msg</td>
					<th>&nbsp;</td>
				</tr>';

				while ($result = $db_character->fetchArray($query))
				{
				
					// check for character in user_character
					$query1 = $db_character->query("SELECT * FROM user_character WHERE character_name LIKE '%" . $result['character_name'] . "%' ");
					$results1 = $db_character->fetchNum($query1);
					
					$query2 = $db_character->query("SELECT * FROM user_character WHERE character_no LIKE '" . $result['character_no'] . "' ");
					$results2 = $db_character->fetchNum($query2);
					
					echo '<tr class="even">';
					echo '<td>'.$result['character_name'].'</td>';
					echo '<td>';
						if ($results1 > '0')
						{
							echo "character name fail";
						}
						elseif ($results2 > '0')
						{
							echo "character no fail";
						}
						else
						{
							echo "OK";
						}
						
					echo '</td>';
					echo '<td><a href="">Restore</a></td>';
					echo '</tr>';
				}
echo '</table></div>';

echo FOOTER;
?>
