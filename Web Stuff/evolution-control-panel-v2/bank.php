<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Bank</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<?php
				if(isset($_POST['submit']))
				{	
					if(!is_numeric($_POST['amount']))
					{
						echo '<div class="message error"><h3>Error!</h3>The amount can only be a number.</div>';
					}
					elseif($_POST['amount'] < '0' )
					{
						echo '<div class="message error"><h3>Error!</h3>Please enter a number bigger then 0</div>';
					}
					elseif($dekaron->isValid($_POST['character']) == false && strlen($_POST['character']) != '18')
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Character No</div>';
					}
					elseif($_POST['character'] == '')
					{
						echo '<div class="message error"><h3>Error!</h3>You didnt select a character.</div>';
					}					
					else
					{
						$query6 = $dekaron->SQLquery("SELECT user_no,dwMoney,webStorage,character_name FROM character.dbo.user_character WHERE character_no = '".$_POST['character']."' ");
						$getCharDil = $dekaron->SQLfetchArray($query6);
					
						if(isset($_POST['deposit']))
						{
							if( $_POST['amount'] > $getCharDil['dwMoney'] )
							{
								echo '<div class="message error"><h3>Error!</h3>You cannot deposit more dil, then there is in your inventory.</div>';
							}
							else
							{
								$webStorage = $getCharDil['webStorage'] + $_POST['amount']; 
								$dwMoney = $getCharDil['dwMoney'] - $_POST['amount'];
								$dekaron->SQLquery("UPDATE character.dbo.user_character SET dwMoney = '".$dwMoney."', webStorage = '".$webStorage."' WHERE character_no = '".$_POST['character']."' ");
								$dekaron->user_action(''.$getCharDil['character_name'].' has deposited '.$_POST['amount'].' dil in the bank');
								echo '<div class="message success"><h3>Success!</h3>Your deposit of <strong>'.number_format($_POST['amount']).'</strong> dil has been put in the bank.</div>';
							}						
						}
						elseif(isset($_POST['widthdraw']))
						{
							if( $_POST['amount'] > $getCharDil['webStorage'] )
							{
								echo '<div class="message error"><h3>Error!</h3>You cannot widthdraw more dil, then there is in the bank.</div>';
							}
							else
							{
								$webStorage = $getCharDil['webStorage'] - $_POST['amount']; 
								$dwMoney = $getCharDil['dwMoney'] + $_POST['amount'];
								$dekaron->SQLquery("UPDATE character.dbo.user_character SET dwMoney = '".$dwMoney."', webStorage = '".$webStorage."' WHERE character_no = '".$_POST['character']."' ");
								$dekaron->user_action(''.$getCharDil['character_name'].' has widthdraw '.$_POST['amount'].' dil out of the bank');
								echo '<div class="message success"><h3>Success!</h3>Your widthdraw of <strong>'.number_format($_POST['amount']).'</strong> dil has been taken out of the bank.</div>';
							}
						}
						else
						{
							echo '<div class="message error"><h3>Error!</h3>No function!</div>';
						}
					}
				}
				
				if ($dekaron->checklogged($_SESSION['USERNO']))
				{
					echo '<div class="message error"><h3>Error!</h3>Your account is still online. You need to logout before you can use the bank.</div>';
				}
				else
				{
					$query5 = $dekaron->SQLquery("SELECT user_no,dwMoney,webStorage,character_name FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
					$getCharsNum = $dekaron->SQLfetchNum($query5);
					
					if($getCharsNum == '0')
					{
						echo '<div class="message error"><h3>Error!</h3>You dont have any characters, you need atleast 1 character to use the bank.</div>';
					}
					else
					{
                    ?>    
                    <table class="datatable full">
                        <thead>
                            <tr>
                                <th>Character Name</th>
                                <th>Inventory</th>
                                <th>Bank</th>
                            </tr>
                        </thead>
                        <tbody>
					<?php
						while($getChars = $dekaron->SQLfetchArray($query5))
						{
							echo '
								<tr> 
									<td>' . $getChars['character_name'] . '</td>
									<td align="center">' . number_format($getChars['dwMoney']) . '</td>
									<td align="center">' . number_format($getChars['webStorage']) . '</td>
								</tr>';
						}
						?>
                        </tbody>
                        </table>
                        <br /><br />
						<table width="100%">
                        	<tr>
                        		<td width="50%">
                                	<form method="post" action="bank.php"  id="form" class="form grid_61">
                                    	<input type="hidden" name="deposit"  />
                                        <input type="hidden" name="submit"  />
                                	<fieldset>
                                    	<legend>Deposit Dil</legend>
                                        <label>Character</label>
                                            <select name="character"  size="1" >
                                            <option value="">Select character</option>
                                            <?php
                                                foreach($_SESSION['CHARACTERS'] as $character)
                                                {
                                                    $name_no = explode("-", $character);
                                                    echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <label>Amount</label><input type="text" name="amount" maxlength="9" value="" />
                                            <div class="action" style="text-align:right;">
                                                <button class="button button-gray" type="submit" >Deposit</button>
                                            </div>
                                    </fieldset>
                                    </form>
                                </td>
                                
                                <td width="50%" align="right">
                                	<form method="post" action="bank.php"  id="form" class="form grid_61">
                                    <input type="hidden" name="widthdraw"  />
                                    <input type="hidden" name="submit"  />
                                	<fieldset>
                                    	<legend>Widthdraw Dil</legend>
                                        <label>Character</label>
                                            <select name="character"  size="1" >
                                            <option value="">Select character</option>
                                            <?php
                                                foreach($_SESSION['CHARACTERS'] as $character)
                                                {
                                                    $name_no = explode("-", $character);
                                                    echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <label>Amount</label><input type="text" name="amount" maxlength="9" value="" />
                                            <div class="action">
                                                <button class="button button-gray" type="submit">Widthdraw</button>
                                            </div>
                                    </fieldset>
                                    </form>
                                </td>
                        	</tr>	
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