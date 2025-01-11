<?php
include ('header.php');
include ('sidebar.php');
?> 
<!-- Main Section -->
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
            </ul>
            <h2>Guild</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            
            	<?php
				if ( isset( $_GET['guild_code'] ) )
				{
					$query1 = $dekaron->SQLquery('SELECT * FROM character.dbo.guild_info WHERE guild_code = "'. $_GET['guild_code'].'" ');
					$getGuildName = $dekaron->SQLfetchArray($query1);
				?>
                <br /><br />
                
                <img class="thumbnail" src="emblem/emblem.php?cbg=<?php echo $getGuildName['guild_mark2']; ?>&cemblem=<?php echo $getGuildName['guild_mark1']; ?>"  hight="32" width="32" />
                
                
                
                    <h2><?php echo $getGuildName['guild_name']; ?> - Level <?php echo $getGuildName['guild_Level']; ?></h2>
                    <h4><?php echo $getGuildName['guild_notice']; ?></h4>
				<br />
                <br />
                
                <table class="datatable full paginate sortable">
                    <thead>
                        <tr>
                            <th>Character Name</th>
                            <th>Peer Name</th>
                            <th>Last Login</th>
                            <th style="width:70px"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					$query2 = $dekaron->SQLquery('SELECT * FROM character.dbo.guild_char_info WHERE guild_code = "'.$_GET['guild_code'].'" ');
					
					while($getGuildChars = $dekaron->SQLfetchArray($query2))
					{
						$query3 = $dekaron->SQLquery('SELECT * FROM character.dbo.user_character WHERE character_name = "'.$getGuildChars['character_name'].'" ');
						$getCharacterName = $dekaron->SQLfetchArray($query3);
						
						$query4 = $dekaron->SQLquery('SELECT * FROM character.dbo.GUILD_PEERAGE WHERE peerage_code = "'.$getGuildChars['peerage_code'].'" AND guild_code = "'.$_GET['guild_code'].'" ');
						$getPeerageName = $dekaron->SQLfetchArray($query4);
						
						echo '
							<tr> 
								<td>' . $getCharacterName['character_name'] . '</td>
								<td>' . $getPeerageName['peerage_name'] . '</td>
								<td align="center">' . $getGuildChars['ipt_time'] . '</td>
								<td>
									<ul class="action-buttons">
										<li><a href="#" class="button button-gray no-text" rel="#overlay"><span class="pencil"></span></a></li>
										<li><a href="#" class="button button-gray no-text" rel="#overlay"><span class="bin"></span></a></li>
									</ul>
								</td>

							</tr>';
									
					}
                    ?>

					</tbody>
                    </table>
                    <br />
                <?php
				}
				?>
            </div>
        </section>
    </div>
</section>
<!-- Main Section End -->
<?php include ('footer.php'); ?>
