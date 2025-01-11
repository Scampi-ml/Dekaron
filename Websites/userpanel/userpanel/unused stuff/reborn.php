<?php
include ('header.php');
include ('sidebar.php');

// +++++++++++++++++++++++++++++++++++
// ++++++++++ REQUIREMENTS +++++++++++
// +++++++++++++++++++++++++++++++++++
$required_dil = '500';
$required_level = '100';
// +++++++++++++++++++++++++++++++++++
?>  

<!-- Main Section -->
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
            </ul>
            <h2>Reborn</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<?php
				$query3 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
				$getAccount = $dekaron->SQLfetchArray($query3);

				if ($getAccount['login_flag'] == '1100')
				{
					echo '<div class="message error"><h3>Error!</h3><p>Your account is still online. You need to logout before you can reborn a character.</p></div>';
				}
				else
				{
				
				?>
                <table class="datatable full">
                    <thead>
                        <tr>
                            <th>Character Name</th>
                            <th>Required Dil</th>
                            <th>Required Level</th>
                            <th style="width:70px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					$query2 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
                    while($getChars = $dekaron->SQLfetchArray($query2))
                    {
						echo '<tr>';
                            echo '<td>'.$getChars['character_name'].'</td>';
							
							if ($required_dil < $getChars['dwMoney'])
							{
								$required_dil_var = true;
								echo '<td><center><img src="images/icons/tick.png"></center></td>';
							}
							else
							{
								$required_dil_var = false;
								echo '<td><center><img src="images/icons/cross.png"></center></td>';
							}
							
							if ($required_level < $getChars['wLevel'])
							{
								$required_level_var = true;
								echo '<td><center><img src="images/icons/tick.png"></center></td>';
							}
							else
							{
								$required_level_var = false;
								echo '<td><center><img src="images/icons/cross.png"></center></td>';
							}
                            
                            echo '<td>';
                                echo '<ul class="action-buttons">';
									
									if ($required_level_var == true && $required_dil_var == true )
									{
                                    	echo '<li><a href="#" class="button button-green">Reborn</a></li>';
									}
									else
									{
										echo '<li></li>';
									}
                                echo '</ul>';
                            echo '</td>';
                        echo '</tr>';
                    }
					
					?>
					</tbody>
                    </table>
                    <br />
                    <div class="message info">
                    	<h3>Reborn Requirements</h3>
                        <p>
                        	<ul>
                            	<li>Required Level: <?php echo $required_level; ?></li>
                                <li>Required Dil: <?php echo $required_dil; ?></li>
                        	</ul>
                        </p>
                    </div>
                    <div class="message info">
                    	<h3>TIP</h3>
                        <p>
                        You can try to transfer some dil from your store or storage to meet the required dil of <?php echo $required_dil; ?>.
                        <br />
                        Make sure your dil is in your inventory.
                        <br />
                        Upon rebirth your characters skilltree and skillslots are reset asswell.
                        </p>
                    </div>
            <?php
			}
			?>        
            </div>
        </section>
    </div>
</section>
<!-- Main Section End -->
<?php
include ('footer.php');
?>
