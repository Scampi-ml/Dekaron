<?php
include ('header.php');
include ('sidebar.php');
?>
<section class="main-section grid_7">
    <div class="main-content grid_4 alpha" style="min-height: 500px;">
        <header>
            <h2>Characters</h2>
        </header>
        <section>
            
            <?php
			$dekaron->flushthis();
			
            $query3 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
            $getCharsNum = $dekaron->SQLfetchNum($query3);
            
            if($getCharsNum == 0)
            {
                echo '<div class="message error"><h3>Error!</h3>Your account does not have any characters.</div>';
            }
            else
            {
            	echo '<ul id="characters" class="listing list-view clearfix">';
                while($getChars = $dekaron->SQLfetchArray($query3))
                {
                    
                    $query4 = $dekaron->SQLquery("SELECT * FROM character.dbo.guild_char_info WHERE character_name = '".$getChars['character_name']."' ");
                    $getGuildNum = $dekaron->SQLfetchNum($query4);
                    $getGuildCode = $dekaron->SQLfetchArray($query4);
                      
                    if ($getGuildNum == '0')
                    {
                        $guildname = 'No Guild';
                    }
                    else
                    {
                        $query5 = $dekaron->SQLquery("SELECT * FROM character.dbo.guild_info WHERE guild_code = '". $getGuildCode['guild_code']."' ");
                        $getGuildName = $dekaron->SQLfetchArray($query5);
                        $guildname = '<a href="edit_guild.php?guild=' . $getGuildCode['guild_code'] . '" />' . $getGuildName['guild_name'] . '</a>';
                    } 
            
                    ?>
                    <li class="user clearfix">
                        <div class="avatar"><img src="images/class/<?php echo $getChars['byPCClass']; ?>.png" width="32" height="32" /></div>
                        <a class="more" href="detail_character.php?character=<?php echo $getChars['character_no']; ?>" onClick="return false">&raquo;</a>
                        <span class="timestamp">Level <?php echo $getChars['wLevel']; ?> </span>
                        <a href="#" class="name"><?php echo $getChars['character_name']; ?></a>
                        <div class="entry-meta">
                            <?php echo $dekaron->_class($getChars['byPCClass']); ?>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
            
            </ul>
        </section>
    </div>

    <div class="preview-pane grid_3 omega">
        <div class="content">
            <h3>Preview Pane</h3>
            <p>This is the preview panel. Click on the name to view more information.</p>
        </div>
        <div class="preview" >
        </div>
    </div>
</section>
<?php include ('footer.php'); ?>