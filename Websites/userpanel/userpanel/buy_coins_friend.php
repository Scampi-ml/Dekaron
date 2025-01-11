<?php
include ('header.php');
include ('sidebar.php');
?>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("ajax_suggest_token.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Buy Coins</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            <div class="message info">This will add coins to the account you select! Not yours.</div>
            <?php
				if(isset($_POST['submit']))
				{
					if($dekaron->isValid($_POST['charactern']) == false && strlen($_POST['charactern']) > '40')
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Character</div>';
					}
					elseif(preg_match('/[^0-9A-Za-z]/', $_POST['charactern']))
					{
						echo '<div class="message error"><h3>Error!</h3>You can only use A-Z / 0-9 characters in the character name.</div>';
					}
					else
					{
						if(isset($_POST['charactern']))
						{
							$query1 = $dekaron->SQLquery("SELECT character_name,user_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charactern']."' ");	
							$getSendTo = $dekaron->SQLfetchNum($query1);
							if($getSendTo == '0')
							{
								echo '<div class="message error"><h3>Error!</h3>'.$_POST['character'].' is not found.</div>';
							}
							else
							{
								$getSendToArray = $dekaron->SQLfetchArray($query1);
								$send_to_user_no = $getSendToArray['user_no'];
								$send_to_user_id = $getSendToArray['character_name'];
							}
						}
						else
						{
							echo '<div class="message error"><h3>Error!</h3>No function!</div>';
						}
						
						if(!empty($send_to_user_no))
						{
							echo '<div class="message success">'.$send_to_user_id.' was found.</div>';
							
							$query2 = $dekaron->SQLquery("SELECT user_no,amount FROM cash.dbo.user_cash WHERE user_no = '".$send_to_user_no."' ");	
							$getfix = $dekaron->SQLfetchArray($query2);
							
							if ($send_to_user_no != $getfix['user_no'] )
							{
								$dekaron->dshopfix($send_to_user_no);
							}
							?>
                            <script src="js/gotonext.js" language="javascript" type="text/javascript"></script>	
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="form" class="form grid_6"  name="accentForm">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="">            
                                    <input type="hidden" name="on0" value="Evolution Games Coins (EvoCoins)">
                                    <input type="hidden" name="on1" value="user_id">
                                    <input type="hidden" name="os1" value="<?php echo $send_to_user_no; ?>" maxlength="60">
                                    <input type="hidden" name="currency_code" value="USD">
                                <fieldset>
                                    <legend>Gift Coins</legend>
                                    <label>Username<small></small></label><input type="text" DISABLED value="<?php echo $send_to_user_id; ?>" /> &nbsp;&nbsp;( Please check this !! )
                                    <label>Amount<small></small></label>
                                    <select name="os0" size="1"  style="width: 205px;" required="required">
                                        <option value="550 EvoCoins">550 EvoCoins $5.00 USD</option>
                                        <option value="1110 EvoCoins">1110 EvoCoins $10.00 USD</option>
                                        <option value="2230 EvoCoins">2230 EvoCoins $20.00 USD</option>
                                        <option value="2785 EvoCoins">2785 EvoCoins $25.00 USD</option>
                                        <option value="5600 EvoCoins">5600 EvoCoins $50.00 USD</option>
                                        <option value="8400 EvoCoins">8400 EvoCoins $75.00 USD</option>
                                        <option value="11250 EvoCoins">11250 EvoCoins $100.00 USD</option>
                                        <option value="22700 EvoCoins">22700 EvoCoins $200.00 USD</option>
                                        <option value="34000 EvoCoins">34000 EvoCoins $300.00 USD</option>
                                        <option value="58000 EvoCoins">58000 EvoCoins $500.00 USD</option>
                                    </select>
                                    <div class="action">
                                        <button class="button button-gray" type="submit" >Gift Coins</button>
                                    </div>
                                    <br /><br />
                                    <div class="message warning" style="color:#000000;"><strong>NOTE:</strong> All transactions are final and will not be reversed.</div>
                                    
                                </fieldset>
                            </form> 
                            						
							<?php
							
						}
					}
				}
				else
				{
				?>
                	<br />
                    <form id="form" class="form grid_6" method="post" action="buy_coins_friend.php">
                        <input type="hidden" name="submit"  />
                        <fieldset>
                            <legend>Gift coins to</legend>
                            <label>Character Name<small></small></label><input type="text" name="charactern" maxlength="40" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
                            <div class="action">
                                <button class="button button-gray" type="submit"><span class="accept"></span>OK</button>
                            </div>
                            <br /><br />
                            <div class="message warning" style="color:#000000;"><strong>NOTE:</strong> All transactions are final and will not be reversed.</div>
                        </fieldset>
                        <div class="suggestionsBox message info" id="suggestions" style="display: none;">
                            <strong>Suggestions</strong> <i>(Click the name to select)</i>
                            <br />
                            <br />
                                <div class="suggestionList" id="autoSuggestionsList" style="margin-left: 10px;">
                                    &nbsp;
                                </div>
                            </div>                            
                        
                    </form>  
				<?php
				}
				?>
                
                <br />
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>