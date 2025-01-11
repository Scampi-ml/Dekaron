<?php
include ('header.php');
include ('sidebar.php');
?>
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Evolution Control Panel</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            <?php
			$dekaron->flushthis();
			$query4 = $dekaron->SQLquery("SELECT user_no,amount FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
			$getCash_query = $dekaron->SQLfetchArray($query4);
			?>
                <div class="message info ac" style="height: 85px;">
                    <h3><img src="images/no_avatar.png" class="thumbnail"> Welcome <?php echo $_SESSION['USER']; ?></h3>
                    <br />
                    <div class="grid_2">
                        <table width="100%" cellpadding="1" cellspacing="1" style="color:#FFFFFF;">
                            <tr>
                                <td align="left"><strong>Characters</strong></td>
                                <td align="right"><?php echo $_SESSION['CHARACTERSNUM']; ?> <a href="characters.php">[View]</a></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Registered on</strong></td>
                                <td align="right"><?php echo $dekaron->userno2date($_SESSION['USERNO']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="grid_2">
                        <table width="100%" cellpadding="1" cellspacing="1"  style="color:#FFFFFF;">
                            <tr>
                                <td align="left"><strong>Coins</strong></td>
                                <?php
                                if (!$getCash_query)
                                {
                                    $getCash = 0;
									//$dekaron->dshopfix($_SESSION['USERNO']);
                                }
                                else
                                {
                                    $getCash = $getCash_query['amount'];
                                }							
                                ?>
                                <td align="right"><?php echo $getCash; ?></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Tokens</strong></td>
                                <?php
                                $query5 = $dekaron->SQLquery("SELECT user_no,token FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
								$getTokens = $dekaron->SQLfetchArray($query5);
								if($getTokens['token'] == '0')
								{
									$tokens = '0';	
								}
								else
								{
									$tokens = $getTokens['token'];	
								}
								?>
                                <td align="right"><?php echo $tokens; ?></td>
                            </tr>
                            
                        </table>
                	</div>
                </div>
                <div class="message success">
                    <?php include ('dfcounter.php'); ?> 
                </div>  
				<?php
					echo '<div class="message success"><strong>Evolution Control Panel V'.$CONFIG['UCP_VERSION'].'</strong> [ <a href="changelog.php">Changelog</a> ] |<strong> Evp Cp support</strong> [ <a href="#"> Visit the support topic here  </a>] | <a href="say_thanks.php">Say Thanks</a></div>';
					
                    if($dekaron->checklogged($_SESSION['USERNO']))
                    {
                        echo '<div class="message warning"><h3>Warning!</h3>Your account is still online. Some functions will be disabled.</div>';
                    }
                    if($_SESSION['CHARACTERSNUM'] == '0')
                    {
                        echo '<div class="message warning"><h3>Warning!</h3>Your account does not have any characters. Some functions will be disabled.</div>';
                    }
                ?>
            </div>
            <div class="clear"></div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>