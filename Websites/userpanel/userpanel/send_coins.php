<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Send Coins</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<?php
				if(isset($_POST['submit']))
				{	
					if(!is_numeric($_POST['amount']))
					{
						echo '<div class="message error"><h3>Error!</h3>The amount can only be a number</div>';
					}
					elseif($_POST['amount'] < '100' )
					{
						echo '<div class="message error"><h3>Error!</h3>Please enter a number bigger then 100</div>';
					}
					elseif($_POST['amount'] == '' )
					{
						echo '<div class="message error"><h3>Error!</h3>Please enter a amount </div>';
					}
					elseif($dekaron->isValid($_POST['account']) == false)
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Account</div>';
					}
					elseif($dekaron->isValid($_POST['password']) == false)
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Account</div>';
					}					
					elseif($_POST['account'] == '')
					{
						echo '<div class="message error"><h3>Error!</h3>You didnt enter a account</div>';
					}	
					elseif($_POST['password'] == '')
					{
						echo '<div class="message error"><h3>Error!</h3>You didnt account a password</div>';
					}					
					else
					{
						$query7 = $dekaron->SQLquery("SELECT user_no,amount,free_amount FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
						if ( !$query7 )
						{
							$getCash2 = 0;
							// insert D-Shop Fix
							$dekaron->dshopfix($_SESSION['USERNO']);
						}
						else
						{
							$getCash_query2 = $dekaron->SQLfetchArray($query7);
							$getCash2 = $getCash_query2['amount'] + $getCash_query2['free_amount'];
						}
						
						if( $_POST['amount'] > $getCash2)
						{
							echo '<div class="message error"><h3>Error!</h3>You cannot transfer more coins, then there is in your account.</div>';
						}
						else
						{
							$query6 = $dekaron->SQLquery("SELECT user_id,user_pwd,user_no FROM account.dbo.user_profile WHERE user_id = '".$_POST['account']."' AND user_pwd = '".md5($_POST['password'])."' ");
							$getAccountNum = $dekaron->SQLfetchNum($query6);
							
							if($getAccountNum = '0')
							{
								echo '<div class="message error"><h3>Error!</h3>Account password match not found</div>';
							}
							else
							{
								$getAccount = $dekaron->SQLfetchArray($query6);
							
								$this_account_coins = $getCash2 - $_POST['amount'];
								$dekaron->SQLquery("UPDATE cash.dbo.user_cash SET amount = '".$this_account_coins."' WHERE user_no = '".$_SESSION['USERNO']."' ");
								
								
								// 2nd account
								$query8 = $dekaron->SQLquery("SELECT user_no,amount,free_amount FROM cash.dbo.user_cash WHERE user_no = '".$getAccount['user_no']."' ");
								$getCash4 = $dekaron->SQLfetchArray($query8);
								
								if ($getCash4['user_no'] != $getAccount['user_no'])
								{
									$dekaron->dshopfix($getAccount['user_no']);
								}
								
								$second_account_coins = $getCash4['amount'] + $_POST['amount'];
								$dekaron->SQLquery("UPDATE cash.dbo.user_cash SET amount = '".$second_account_coins."' WHERE user_no = '".$getAccount['user_no']."' ");

								$dekaron->user_action(''.$_SESSION['USER'].' has send '.$_POST['amount'].' to '.$getAccount['user_no'].'');
								
								echo '<div class="message success"><h3>Success!</h3>Coins have been send</div>';
							}
						}
					}
				}
				
				if ($dekaron->checklogged($_SESSION['USERNO']))
				{
					echo '<div class="message error"><h3>Error!</h3>Your account is still online. You need to logout before you can use the bank.</div>';
				}
				else
				{
					$query4 = $dekaron->SQLquery("SELECT user_no,amount,free_amount FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
					$getCash_query = $dekaron->SQLfetchArray($query4);
					
					if ($getCash_query['user_no'] != $_SESSION['USERNO'] )
					{
						$getCash = 0;
						// insert D-Shop Fix
						$dekaron->dshopfix($_SESSION['USERNO']);
					}
					else
					{
						$getCash = $getCash_query['amount'] + $getCash_query['free_amount'];
					}				
                    ?>    
                    <div class="message info">
                    	<h3>Info!</h3>
                   		You can send coins to your 2nd account
                        <br /><br />
                        <strong>Requirements:</strong>
                        <ul>
                        	<li>You need to have your 2nd <strong>account name</strong> and <strong>password</strong></li>
                        	<li>You need to have coins on THIS account</li>
                            <li>You need to have minimal <strong>100 coins</strong> on THIS account</li>
                        </ul>
                    </div>
                    <br />
                    <div class="message info ac">
                        <h3>You currently have <?php echo $getCash; ?> coin(s).</h3>
                        Click <a href="log_coins.php">here</a> to view your coins Logs
                    </div>
                    <br />        
                    <form id="form" class="form grid_6" method="post" action="send_coins.php">
                        <input type="hidden" name="submit"  />
                        <fieldset>
                            <legend>To Account</legend>
                            <label>Account</label><input type="text" name="account" maxlength="32" value="" />
                            <label>Password</label><input type="password" name="password" maxlength="32" value="" />
                            <label>Amount</label><input type="text" name="amount" maxlength="32" value="" />
                            <div class="action">
                                <button class="button button-gray" type="submit"><span class="accept"></span>OK</button>
                            </div>
                        </fieldset>
                    </form> 
                    
                    

					<?php
				}
				?>
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>