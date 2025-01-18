                        </section>
                <aside id="sidebar" class="grid_3 pull_9">
                    <div class="box search">
                        <form action="search.php" method="post" class="uniform" >
                            <label>Quick Search</label>
                            <input name="what" type="text" size="20" />
                            <button class="button small">Go</button>
                            <br /><br />
                            <label><input type="radio" name="method" value="account" />Account</label>
                            <label><input type="radio" checked="checked" name="method" value="character" />Character</label>
                        </form>
                    </div>
                    <div class="box search">
                        <form action="http://www.dkunderground.org/osdsv4/onlinesearch.php" method="post">
                            <label>Online Help</label>
                            <input name="onlinesearch" type="text" size="20" />
                            <button class="button small">Go</button>
                        </form>
                    </div>

                    
                    <?php
										
                    // Show the server info?
					$server_info = $Config->get('server_info', 'GENERAL');
                    if ($server_info == 'true')
					{
						ob_start();
						echo '<div class="box info">
									<h2>Server Info</h2>
									<section>
										<div id="server_stats">';
											require_once("sinfo.php");
						
						echo '			</div>
									</section>
								</div>';
						ob_end_flush();
					}
                    
                
 					$recent_login_block = $Config->get( 'recent_login_block', 'GENERAL');
                    if($recent_login_block == 'true')
                    {
                    	echo'             
                        <div class="box">
                            <h2>Your Recent Logins</h2>
                            <section>';
							
							$recent_login_block_top = $Config->get( 'recent_login_block_top', 'GENERAL');
						   
								$query = $db->query('SELECT TOP '.$recent_login_block_top.' * FROM osdsv4.dbo.user_login_log WHERE user_id = "' . $_SESSION['user_id'] . '" ORDER BY login_time DESC ');
								$login_log_num = $db->fetchNum($query);
								
								if ($login_log_num > 0)
								{
									echo "<ul>";
									while($login = $db->fetchArray($query) )
									{
										echo "<li>" . $login['ip_address'] . "<div style='float:right;'>" . $login['login_time'] . "</div></li>";
									}
									echo "</ul>";
								}
								else
								{
									echo "<li>No Logins found?</li>";
								}
                                    
                                echo '
                            </section>
                        </div>';
                    }
                
                    
					$server_version_ini = $Config->get('server_version_ini', 'GENERAL');
                    if ($server_version_ini == 'true')
                    {
                        echo '<div class="box info">
                                <h2>Server Version</h2>
                                <br />
                                    <center>
										' . getDekaronVersion();
										$server_version_ini_edit = $Config->get('server_version_ini_edit', 'GENERAL');
										if ($server_version_ini_edit == 'true')
										{
										
											echo '<br><a href="change_version_ini.php?version=' . getDekaronVersion() . '">[ Change Version ]</a>';
										}
										echo '
										</center>
                                <br />
                            </div>';
                    }
                    
                	$version_check_block = $Config->get( 'version_check_block', 'GENERAL');
                    if($version_check_block == 'true')
                    {
					
						
                    	echo '
								<div class="box info">
									<h2>Version Check</h2>
									<center>
									<br>
									<a href="check_version.php"><button type="submit" name="submit" class="button small">Check for updates</button></a>
									<br><br>
									</center>
								</div>';
					}
					?>
                
                </aside>
            </section>
        </section>
	</body>
</html>
