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
            <h2>Send Tokens</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<?php
				if(isset($_POST['submit']))
				{
					if($dekaron->isValid($_POST['charactern']) == false && strlen($_POST['charactern']) > '40')
					{
						echo '<div class="message error"><h3>Error!</h3>Invalid Character</div>';
					}
					elseif(preg_match('/[^0-9A-Za-z]/', $_POST['charactern']))
					{
						echo '<div class="message error"><h3>Error!</h3>You can only use A-Z / 0-9 characters in the character name</div>';
					}
					elseif(!is_numeric($_POST['amount']))
					{
						echo '<div class="message error"><h3>Error!</h3>The amount can only be a number</div>';
					}
					elseif($_POST['amount'] < '0' )
					{
						echo '<div class="message error"><h3>Error!</h3>Please enter a number bigger then 0</div>';
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
							if($send_to_user_no == $_SESSION['USERNO'])
							{
								echo '<div class="message error"><h3>Error!</h3>You cannot send tokens to yourself</div>';
							}
							else
							{						
								// more accurate reading 
								$query3 = $dekaron->SQLquery("SELECT user_no,token FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
								$getTokens = $dekaron->SQLfetchArray($query3);
								if($getTokens['token'] == '0')
								{
									$tokens = '0';	
								}
								else
								{
									$tokens = $getTokens['token'];	
								}
								
								$query4 = $dekaron->SQLquery("SELECT user_no,token FROM account.dbo.user_profile WHERE user_no = '".$send_to_user_no."' ");
								$getTokens2 = $dekaron->SQLfetchArray($query4);
								if($getTokens2['token'] == '0')
								{
									$tokens2 = '0';	
								}
								else
								{
									$tokens2 = $getTokens2['token'];	
								}
								
								if($_POST['amount'] > $tokens)
								{
									echo '<div class="message error"><h3>Error!</h3>You cannot send more tokens then you currently have.</div>';
								}
								else
								{
									$my_tokens = $tokens - $_POST['amount'];
									$his_tokens = $tokens2 + $_POST['amount'];
		
									$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = '".$my_tokens."' WHERE user_no = '".$_SESSION['USERNO']."' ");
									$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = '".$his_tokens."' WHERE user_no = '".$send_to_user_no."' ");
									$dekaron->user_action('send '.$_POST['amount'].' tokens to '.$send_to_user_id.'');
									echo '<div class="message success"><h3>Success!</h3>You send '.$_POST['amount'].' token(s) to '.$send_to_user_id.'.</div>';
								}
							}
						}
					}
				}
				$query5 = $dekaron->SQLquery("SELECT user_no,token FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
				$getTokensNow = $dekaron->SQLfetchArray($query5);
				if($getTokensNow['token'] == '0')
				{
					$tokens3 = '0';	
				}
				else
				{
					$tokens3 = $getTokensNow['token'];	
				}
				
				?>
                <div class="message info ac">
                    <h3>You currently have <?php echo $tokens3; ?> token(s).</h3>
                </div>
                <?php
				if($tokens3 == '0')
				{
					echo '<div class="message error"><h3>Error!</h3>You cannot send tokens if you dont have any tokens.</div>';
				}
				else
				{
				?>            
                    <form id="form" class="form grid_6" method="post" action="send_tokens.php">
                        <input type="hidden" name="submit"  />
                        <fieldset>
                            <legend>Send tokens to</legend>
                            <label>Amount<small>Max: <?php echo $tokens3; ?> token(s)</small></label><input type="text" name="amount" maxlength="40" value="" />
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
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>