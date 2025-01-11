<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Say Thanks</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<div class="message info ac">
            	Do you want to say "Thanks" for creating the Evo_CP? You can :)<br />
                You can send me a few dilz :)
                </div>
            	<?php
				if(isset($_POST['submit']))
				{	
					if(!is_numeric($_POST['amount']))
					{
						echo '<div class="message error"><h3>Error!</h3>The amount can only be a number.</div>';
					}
					elseif($_POST['amount'] == '' )
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
						$query6 = $dekaron->SQLquery("SELECT user_no,dwMoney,character_name FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
						$getCharDil = $dekaron->SQLfetchArray($query6);
					
						if(isset($_POST['deposit']))
						{
							if( $_POST['amount'] > $getCharDil['dwMoney'] )
							{
								echo '<div class="message error"><h3>Error!</h3>You cannot send more dil, then there is in your inventory.</div>';
							}
							else
							{
								$dwMoney = $getCharDil['dwMoney'] - $_POST['amount'];
								$dekaron->SQLquery("UPDATE character.dbo.user_character SET dwMoney = '".$dwMoney."' WHERE character_no = '".$_POST['character']."' ");
								
								// i have to set an Item ID, or it wont send => 3786 = Bolt
								$janvier123_char_id = 'C12010630000000448';
								$dekaron->SQLquery("EXEC character.dbo.SP_POST_SEND_OP '".$janvier123_char_id."','Say Thanks',1,'Donation','Donation from ".$getCharDil['character_name']."','3786','".$_POST['amount']."',0");
								$dekaron->user_action(''.$getCharDil['character_name'].' said thanks to janvier123 with '.$_POST['amount'].' dil');
								echo '<div class="message success"><h3>Success!</h3>Thank you for your donation of <strong>'.number_format($_POST['amount']).' </strong> dilz !!!</div>';
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
					echo '<div class="message error"><h3>Error!</h3>Your account is still online. You need to logout.</div>';
				}
				else
				{
					$query5 = $dekaron->SQLquery("SELECT user_no,dwMoney,character_name FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
					$getCharsNum = $dekaron->SQLfetchNum($query5);
					
					if($getCharsNum == '0')
					{
						echo '<div class="message error"><h3>Error!</h3>You dont have any characters, you need atleast 1 character </div>';
					}
					else
					{
                    ?>    
                    <br /><br />
                    <form method="post" action="say_thanks.php"  id="form" class="form grid_6">
                        <input type="hidden" name="deposit"  />
                        <input type="hidden" name="submit"  />
                    <fieldset>
                        <legend>Donate Dilz</legend>
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
                                <button class="button button-gray" type="submit" >Donate</button>
                            </div>
 						   <br /><br />
                           <div class="message warning" style="color:#000000;"><strong>NOTE:</strong> All transactions are final and will not be reversed.</div>                            
                            
                    </fieldset>
                    </form>
                    <?php
					}
				}
				?>
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>