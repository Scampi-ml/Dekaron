<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Unstuck</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<?php
				if ( isset ( $_GET['unstuck'] ) )
				{
					$update = $dekaron->SQLquery('UPDATE character.dbo.user_character SET wMapIndex = "7", wPosX = "282", wPosY = "219" WHERE character_no = "'.$_GET['unstuck'].'" ');
					$dekaron->user_action('unstucked '.$_GET['character_name'].' ');
					echo '<div class="message success"><h3>Success!</h3>'.$_GET['character_name'].' has been moved to loa castle.</div><br>';
				}

				if ($dekaron->checklogged($_SESSION['USERNO']))
				{
					echo '<div class="message error"><h3>Error!</h3>Your account is still online. You need to logout before you can unstuck yourself.</div>';
				}
				else
				{
				
				?>
                <table class="datatable full">
                    <thead>
                        <tr>
                            <th>Character Name</th>
                            <th style="width:70px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					$query2 = $dekaron->SQLquery("SELECT user_no,character_name,character_no,wMapIndex FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
                    while($getChars = $dekaron->SQLfetchArray($query2))
                    {
						if ($getChars['wMapIndex'] == '64' || $getChars['wMapIndex'] == '16')
						{
							echo '<tr>
								<td>'.$getChars['character_name'].'</td>
								<td>
									<ul class="action-buttons">
										<li><a class="button button-red">Jailed</a></li>
									</ul>
								</td>
								</tr>';						
						}
						else
						{
							echo '<tr>
								<td>'.$getChars['character_name'].'</td>
								<td>
									<ul class="action-buttons">
										<li><a class="button button-green" onclick="window.location.href=\'unstuck.php?unstuck='.$getChars['character_no'].'&character_name='.$getChars['character_name'].'\';">Unstuck</a></li>
									</ul>
								</td>
							</tr>';
						}
                    }
					?>
					</tbody>
                    </table>
                    <br />
                    <div class="message info">
                        <h3>TIP</h3>
                        This will move your character to Loa Castle.
                    </div>

                <?php
				}
				?>
            </div>
        </section>
    </div>
</section>
<!-- Main Section End -->
<?php include ('footer.php'); ?>