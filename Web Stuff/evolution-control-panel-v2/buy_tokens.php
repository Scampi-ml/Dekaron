<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Buy Tokens</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            <?php
				if(isset($_POST['exchange']))
                {
					if($dekaron->isValid($_POST['exchange']) == false && !is_numeric($_POST['exchange']) )
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Amount</div>';
					}
					elseif($_POST['exchange'] == '')
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Amount</div>';
					}
					else
					{
						$deduct = $_POST['exchange'] * 15;
						$result2 = $dekaron->SQLquery("SELECT * FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
						$row1 = $dekaron->SQLfetchArray($result2);
						if($deduct > $row1['amount'])
						{
							echo '<div class="message error"><h3>Error!</h3>You dont have enough coins to buy '.$_POST['exchange'].' tokens.</div>';
						}
						else
						{
							$dekaron->SQLquery("UPDATE cash.dbo.user_cash SET amount = amount - ".$deduct." WHERE user_no = '".$_SESSION['USERNO']."' ");
							$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = token + ".$_POST['exchange']." WHERE user_no = '".$_SESSION['USERNO']."'");
							$dekaron->user_action('Purchase of '.$_POST['exchange'].' tokens');
							echo '<div class="message success"><h3>Success!</h3>Purchase of '.$_POST['exchange'].' tokens was successful</div>';
						}
					}
				}
				
				$query4 = $dekaron->SQLquery("SELECT user_no,amount FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
				if ( !$query4 )
				{
					$getCash = 0;
					// insert D-Shop Fix
					$dekaron->dshopfix($_SESSION['USERNO']);
				}
				else
				{
					$getCash_query = $dekaron->SQLfetchArray($query4);
					$getCash = $getCash_query['amount'];
				}

				$result1 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
				$list = $dekaron->SQLfetchArray($result1);
				
				$resqtok = $dekaron->SQLquery("SELECT * FROM gamelog.dbo.tokenQueue WHERE user_no = '".$_SESSION['USERNO']."' ");
				$queue = 0;
				while($qtok = $dekaron->SQLfetchArray($resqtok))
				{
					$dater = time() - $qtok['hour'];
					if($dater >= 180)
					{
						$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = token + 1 WHERE user_no = '".$_SESSION['USERNO']."' ");
						$dekaron->SQLquery("DELETE gamelog.dbo.tokenQueue WHERE user_no = '".$_SESSION['USERNO']."' AND hour = '".$qtok['hour']."' ");
					}
					else
					{
						$queue = $queue + 1;
					}
				}
				if($queue > '0')
				{
					$getTokens = $list['token'] + $queue;
				}
				else
				{
					$getTokens = $list['token'];
				}
				
				?>
                <div class="message info ac">
                    <h3>You currently have <?php echo $getCash; ?> coin(s).</h3>
                </div>
                <div class="message info ac">
                    <h3>You currently have <?php echo $getTokens; ?> token(s).</h3>
                </div>                
                <br />
                <?php
				if ($dekaron->checklogged($_SESSION['USERNO']))
				{
					echo '<div class="message error"><h3>Error!</h3>Your account is still online. You need to logout before you can buy coins.</div>';
				}
				else
				{
					$coins =  $getCash / 15;
					$coins = explode(".",$coins);
				?>
                    <form action="buy_tokens.php" method="post" id="form" class="form grid_6">
                        <fieldset>
                            <legend>Buy Coins</legend>
                            <label>Amount of tokens<small>1 token =  15 coins</small></label><input type="text" name="exchange" maxlength="32" value="" /> &nbsp;&nbsp; (Max <?php echo $coins[0]; ?>)
                            <div class="action">
                                <button class="button button-gray" onClick="gotoNext()">Buy Tokens</button>
                            </div>
                            <br /><br />
                           <div class="message warning" style="color:#000000;"><strong>NOTE:</strong> All transactions are final and will not be reversed.</div>
                        </fieldset>
                    </form> 
                <?php
				}
				?>
			<div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>