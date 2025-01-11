<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Guild</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<form method="post" action="guild.php">
                    <select name="character"  size="1"  style="width: 205px;">
                    <option value="">Select character</option>
                    <?php
                        foreach($_SESSION['CHARACTERS'] as $character)
                        {
                            $name_no = explode("-", $character);
							echo '<option value="'.$name_no[1].'">'.$name_no[1].'</option>';
                        }
                    ?>
                    </select>
                    <button type="submit" class="button button-gray" style="padding-top: 1px;">Get Guild</button>
                </form>
            	<?php
				if ( isset( $_POST['character'] ) )
				{
					if($dekaron->isValid($_POST['character']) == false)
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Character</div>';
					}
					elseif(preg_match('/[^0-9A-Za-z]/', $_POST['character']))
					{
						echo '<div class="message error"><h3>Error!</h3>You can only use A-Z / 0-9 characters in the character name.</div>';
					}
					else
					{
						$query5 = $dekaron->SQLquery('SELECT * FROM character.dbo.guild_char_info WHERE character_name = "'.$_POST['character'].'" ');
						$getGuildNum = $dekaron->SQLfetchNum($query5);
						$getGuildCode = $dekaron->SQLfetchArray($query5);
						  
						if ($getGuildNum == '0')
						{
							$guild = false;
						}
						else
						{
							$query1 = $dekaron->SQLquery('SELECT * FROM character.dbo.guild_info WHERE guild_code = "'. $getGuildCode['guild_code'].'" ');
							$getGuildName = $dekaron->SQLfetchArray($query1);
							$guild = true;
						}
					}
				if ( !$guild )
				{
					echo '<br><br><div class="message error"><h3>Error!</h3>'.$_POST['character'].' is not in any guild.</div>';
					echo '
				            </div>
							</section>
						</div>
					</section>';
					
					include ('footer.php');
                    die();
				}
				
				?>
                <br />
                <br />
                <img class="thumbnail" src="emblem/emblem.php?cbg=<?php echo $getGuild['guild_mark2']; ?>&cemblem=<?php echo $getGuild['guild_mark1']; ?>"  hight="32" width="32" />
                    <h2 style="color:#FFFFFF;"><?php echo $getGuildName['guild_name']; ?> - Level <?php echo $getGuildName['guild_Level']; ?></h2>
                    <h4 style="color:#FFFFFF;"><?php echo $getGuildName['guild_notice']; ?></h4>
				<br />
                <br />
                <table class="datatable full paginate sortable">
                    <thead>
                        <tr>
                            <th>Character Name</th>
                            <th>Peer Name</th>
                            <th>Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					$query2 = $dekaron->SQLquery('SELECT * FROM character.dbo.guild_char_info WHERE guild_code = "' . $getGuildCode['guild_code'] . '" ');
					
					while($getGuildChars = $dekaron->SQLfetchArray($query2))
					{
						$query3 = $dekaron->SQLquery('SELECT * FROM character.dbo.user_character WHERE character_name = "'.$getGuildChars['character_name'].'" ');
						$getCharacterName = $dekaron->SQLfetchArray($query3);
						
						$query4 = $dekaron->SQLquery('SELECT * FROM character.dbo.GUILD_PEERAGE WHERE peerage_code = "'.$getGuildChars['peerage_code'].'" AND guild_code = "' . $getGuildCode['guild_code'] . '" ');
						$getPeerageName = $dekaron->SQLfetchArray($query4);
						
						echo '
							<tr> 
								<td>' . $getCharacterName['character_name'] . '</td>
								<td>' . $getPeerageName['peerage_name'] . '</td>
								<td align="center">' . $getGuildChars['ipt_time'] . '</td>
							</tr>';
									
					}
                    ?>
					</tbody>
                    </table>
                <?php
				}
				?>
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>