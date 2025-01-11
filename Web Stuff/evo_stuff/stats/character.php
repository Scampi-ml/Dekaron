<?php
include ('header.php');
include ('sidebar.php');
include ('array_map.php');


if(isset($_GET['character']))
{
	if(empty($_GET['character']))
	{
		echo '<section class="main-section grid_7"><div class="main-content"><header><h2>Character</h2></header><section class="container_6 clearfix"><div class="grid_6"><div class="message error"><h3>Search Error</h3>You didnt enter a character name<br><br><a href="index.php"><strong>Go Back</strong></a></div></div></section></div></section>';
		include ('footer.php');
		die();
	}
	elseif($dekaron->isValid($_GET['character']) == false && strlen($_GET['character']) > '40')
	{
		echo '<section class="main-section grid_7"><div class="main-content"><header><h2>Character</h2></header><section class="container_6 clearfix"><div class="grid_6"><div class="message error"><h3>Search Error</h3>Invalid Character<br><br><a href="index.php"><strong>Go Back</strong></a></div></div></section></div></section>';
		include ('footer.php');
		die();
	}
	elseif(preg_match('/[^0-9A-Za-z]/', $_GET['character']))
	{
		echo '<section class="main-section grid_7"><div class="main-content"><header><h2>Character</h2></header><section class="container_6 clearfix"><div class="grid_6"><div class="message error"><h3>Search Error</h3>You can only use A-Z / 0-9 characters in the character nam<br><br><a href="index.php"><strong>Go Back</strong></a>e</div></div></section></div></section>';
		include ('footer.php');
		die();
	}
	else
	{
		$query1 = $dekaron->SQLquery("SELECT * FROM character2.dbo.user_character WHERE character_name = '".$_GET['character']."' ");
		$getCharsNum = $dekaron->SQLfetchNum($query1);
		if($getCharsNum == '0')
		{
			echo '<section class="main-section grid_7"><div class="main-content"><header><h2>Character</h2></header><section class="container_6 clearfix"><div class="grid_6"><div class="message error"><h3>Search Error</h3> No character found!<br><br><a href="index.php"><strong>Go Back</strong></a></div></div></section></div></section>';
			include ('footer.php');
			die();
		}
		else
		{
			$getChars = $dekaron->SQLfetchArray($query1);
			
			$query2 = $dekaron->SQLquery("SELECT * FROM account2.dbo.user_profile WHERE user_no = ".$getChars['user_no']." ");
			$getAccountInfo = $dekaron->SQLfetchArray($query2);
			if($getAccountInfo['login_flag'] == '1100')
			{
				$online = 'avatarOnline';
			}
			else
			{
				$online = 'avatarOffline';
			}
			$query3 = $dekaron->SQLquery("SELECT * FROM character2.dbo.guild_char_info WHERE character_name = '".$getChars['character_name']."' ");
			$getGuildNum = $dekaron->SQLfetchNum($query3);
			$getGuildCode = $dekaron->SQLfetchArray($query3);
			  
			if ($getGuildNum == '0')
			{
				$guildname = 'Not in Guild';
				$guildimg = '';
			}
			else
			{
				$query4 = $dekaron->SQLquery("SELECT * FROM character2.dbo.guild_info WHERE guild_code = '". $getGuildCode['guild_code']."' ");
				$getGuildName = $dekaron->SQLfetchArray($query4);
				$guildname = '<h2><a href="">'.$getGuildName['guild_name'].'</a></h2>';
				$guildimg = '<div class="avatar"><img class="thumbnail" src="emblem/emblem.php?cbg='.$getGuild['guild_mark2'].'&cemblem='.$getGuild['guild_mark1'].'"  height="60" width="60" /></div>';
			} 
			$dekaron->flushthis();
			?>

            <section class="main-section grid_7">
              <div class="main-content grid_4 alpha">
                <header class="clearfix"> <span class="<?php echo $online; ?>"><img src="images/class/<?php echo $getChars['byPCClass']; ?>.png" width="60" height="60" /></span>
                  <hgroup>
                    <h1><?php echo $getChars['character_name']; ?></h1>
                    <br />
                    <?php echo $dekaron->_class($getChars['byPCClass']); ?>
                  </hgroup>
                </header>
                <section>
                  <fieldset>
                    <legend>Guild</legend>
                    <?php echo $guildimg; ?>
                    <?php echo $guildname; ?>
                  </fieldset>
                   <fieldset>
                    <legend>About me</legend>     
                        Hi I'm <?php echo $getChars['character_name']; ?>, I'm assuming you're here to see my stats? Alright!
                        <br>
                        <br>
                        Well lets get reading!
                        <br><br>
                        As you can see, I'm an <?php echo $dekaron->_class($getChars['byPCClass']); ?>.<br>
                        I'm also experienced with <?php echo number_format($getChars['dwExp']); ?> experience points, and I'm also level <?php echo $getChars['wLevel']; ?>!<br>
                        I'm quite healthy, with <?php echo number_format($getChars['nHP']); ?> health points, and <?php echo number_format($getChars['nMP']); ?> Mana points.<br>
                        As you can see, I have quite a bit of money, look below for some of my riches!<br>
                        I have 740590459 dil(s), 45000000 dil(s) in my store, and 999999999 dil(s)in my storage.<br>
                        As you can see, I'm rich, but riches isn't everything, my shield points is <?php echo number_format($getChars['nShield']); ?> awesome right?<br>
                        Well, I think I have good stats don't you? I have...500 strength, 133 dexterity, 1031 heal, and 2 spirit points!<br>
                        I'm also in the guild ^^DUNK^^!<br>
                  </fieldset>
                  <div class="clear"></div>
                </section>
              </div>
              <div class="preview-pane grid_3 omega">
                <div class="content">
                  <h3><?php echo $getChars['character_name']; ?>'s Information</h3>
                  
                  <table width="100%" border="0">
                    <tr>
                      <td><div class="progress progress-red"><span style="width: 100%"><b>Health <?php echo number_format($getChars['nHP']); ?></b></span></div></td>
                    </tr>
                    <tr>
                      <td><div class="progress progress-blue"><span style="width: 100%"><b>Mana <?php echo number_format($getChars['nMP']); ?></b></span></div></td>
                    </tr>
                    <tr>
                      <td><div class="progress progress-green"><span style="width: 100%"><b>Shield <?php echo number_format($getChars['nShield']); ?></b></span></div></td>
                    </tr>
                  </table>
                  <br>
                  <fieldset>
                    <legend>Level Progress</legend>
                    <?php
						// determin next level
						include ('exp_array.php');
						$next_level = $getChars['wLevel'] +1;
						
					?>
                    <table width="100%" border="0">
                      <tr>
                        <th scope="row"><div align="left">Current Level</div></th>
                        <td><div align="right"><?php echo $getChars['wLevel']; ?></div></td>
                      </tr>
                      <tr>
                        <th scope="row"><div align="left">Next Level</div></th>
                        <td><div align="right"><?php echo $next_level; ?></div></td>
                      </tr>
                    </table>
                    <br>
                    <table width="100%" border="0">
                      <tr>
                        <th scope="col" align="left"><?php echo number_format($getChars['dwExp']); ?></th>
                        <th scope="col" align="right"><?php echo number_format($exparray[$next_level]); ?></th>
                      </tr>
                    </table>
                    <?php
						
                    	$countPercent = $dekaron->countPercent($getChars['dwExp'], $exparray[$next_level]);
					?>
                    <div class="progress progress-orange"><span style="width: <?php echo $countPercent; ?>%"><b><?php echo $countPercent; ?>%</b></span></div>
                  </fieldset>
                  <br>
                  <fieldset>
                  <legend>Stats</legend>
                  <table width="100%" border="0">
                      <tr>
                        <th height="30" scope="col"><strong>Str</strong></th>
                        <th height="30" scope="col"><strong>Dex</strong></th>
                        <th height="30" scope="col"><strong>Heal</strong></th>
                        <th height="30" scope="col"><strong>Spr</strong></th>
                      </tr>
                      <tr>
                        <td><div align="center"><?php echo number_format($getChars['wStr']); ?></div></td>
                        <td><div align="center"><?php echo number_format($getChars['wDex']); ?></div></td>
                        <td><div align="center"><?php echo number_format($getChars['wCon']); ?></div></td>
                        <td><div align="center"><?php echo number_format($getChars['wSpr']); ?></div></td>
                      </tr>
                    </table>
                  </fieldset>
                  <br>
                  <fieldset>
                  <legend>Player VS Player</legend>
                  <table width="100%" border="0">
                      <tr>
                        <th height="30" scope="col"><strong>Win</strong></th>
                        <th height="30" scope="col"><strong>Lose</strong></th>
                        <th height="30" scope="col"><strong>Total</strong></th>
                      </tr>
                      <tr>
                        <td><div align="center"><?php echo number_format($getChars['wWinRecord']); ?></div></td>
                        <td><div align="center"><?php echo number_format($getChars['wLoseRecord']); ?></div></td>
                        <td><div align="center"><?php echo number_format($getChars['wLoseRecord'] + $getChars['wWinRecord']); ?></div></td>
                      </tr>
                    </table>
                  </fieldset>
                  
                </div>
              </div>
            </section>
            <?php include ('footer.php'); ?>
		
		
<?php		
		}
	}
}
?>