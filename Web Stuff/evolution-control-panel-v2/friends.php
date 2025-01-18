<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Friends</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                        <?php
						if($_SESSION['CHARACTERSNUM'] == '0')
						{
							echo '<div class="message error"><h3>Error!</h3>You dont have any chracters. You need to have atleast 1 character before you can use friends.</div>';
						}
						else
						{	
						?>            
                <form action="friends.php" method="get">
                    <select name="character">
                        <option value="">Select character</option>

							<?php				
							foreach($_SESSION['CHARACTERS'] as $character)
							{
								$name_no = explode("-", $character);
								if (isset($_GET['character']) && $dekaron->isValid($_GET['character']) == true && strlen($_GET['character']) == '18' && $_GET['character'] == $name_no[0])
								{
									echo '<option value="'.$name_no[0].'" selected>'.$name_no[1].'</option>';
								}
								else
								{
									echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
								}
							}
							?>
						</select>
						<button type="submit" class="button button-gray" style="padding-top: 1px;">Get friends</button>
						<div></div>
						
					</form>
					<?php
					if(isset($_GET['character']) && $dekaron->isValid($_GET['character']) == true && strlen($_GET['character']) == '18')
					{
					?>
					<br />
					<table class="datatable paginate sortable full" align="center">
						<thead>
							<tr>
								<th>Character</th>
								<th>Added</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$dekaron->flushthis();
							$query4 = $dekaron->SQLquery("SELECT * FROM character.dbo.mssngr_char_list WHERE character_no = '".$_GET['character']."' ");
							while($getFriends = $dekaron->SQLfetchArray($query4))
							{
								echo "<tr>";
								
								$query5 = $dekaron->SQLquery("SELECT character_name,user_no FROM character.dbo.user_character WHERE character_name LIKE '%".$getFriends['fr_character_name']."%' ");
								$getUserNo = $dekaron->SQLfetchArray($query5);
								
								if ($dekaron->checklogged($getUserNo['user_no']))
								{
									echo '<td><font color="green">'.$getFriends['fr_character_name'].'</font></td>';
								}
								else
								{
									echo '<td><font color="red">'.$getFriends['fr_character_name'].'</font></td>';
								}
								echo '<td align="center">'.$getFriends['upt_time'].'</td>';
								
								echo "</tr>";
							}
						?>
						</tbody>
					</table>
					<?php
					}
				}
				?>
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>