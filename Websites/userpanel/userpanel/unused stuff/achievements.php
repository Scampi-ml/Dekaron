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
                     		<h2>Achievements</h2>
                        </header>
                        <section class="container_6 clearfix">
                            <div class="grid_6">

                <?php
				
											
				$query1 = $dekaron->SQLquery("SELECT * FROM achievements.dbo.user_achievements ORDER BY id ASC");
				//$getAchievements = $dekaron->SQLfetchNum($query1);
				
				while ($getAchievement = $dekaron->SQLfetchArray($query1))
				{
					$query2 = $dekaron->SQLquery("SELECT * FROM achievements.dbo.user_achievements_progress WHERE user_no = '".$_SESSION['USERNO']."' ");
					$getUserAchievement = $dekaron->SQLfetchArray($query2);
				?>
				
                    <div style="margin-left: 20px;">
                    <div class="achieveImgHolder"><img src="images/achievements/<?php echo $getAchievement['achievement_image']; ?>"></div>
                    <div class="achieveTxtHolder">
                        <div class="achieveTxt">
                        <?php
						if ($getUserAchievement['achievement_unlocked'] != NULL)
						{
						?>
							<div style="float:right; margin-right: 20px;">Unlocked: <?php echo $getUserAchievement['achievement_unlocked']; ?></div>
                        <?php
						}
						?>
                            
                            <p><?php echo $getAchievement['achievement_title']; ?></p>
                            <p2><?php echo $getAchievement['achievement_desc']; ?></p2>
                            
                            <?php 
							if ($getAchievement['achievement_bar'] == 1)
							{
							?>
                            <div style="float:right; margin-top: 15px; margin-right: 40px;">
							
							<?php
                            if ($getUserAchievement['achievement_count_current'] == NULL)
							{
								echo "0";	
							}
							else
							{
								echo $getUserAchievement['achievement_count_current'];
							}
							
							?> / <?php echo $getAchievement['achievement_count']; ?>
                            
                            </div>
                            <div class="achievementProgressBar" style="margin-left: 10px;">
                            <?php $countPercent = $dekaron->countPercent($getUserAchievement['achievement_count_current'], $getAchievement['achievement_count']); ?>
                                <!-- 500 px -->
                               <img width="500" height="14" src="bar.php?height=14&width=500&rating=<?php echo $countPercent; ?>"> &nbsp; 
                            </div>
                            <?php 
							}
                            ?>
                           
                        </div>
                    </div>
                    <br clear="left">
                    <br>
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