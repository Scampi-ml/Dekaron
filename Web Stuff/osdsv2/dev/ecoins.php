<?php

$user_no = $_GET['user_no'];

  $query = "SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '$user_no'"; 
  $result = mssql_query($query);
  $row = mssql_fetch_array($result);
  
  $user_id = $row["user_id"];
  

?>
	<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong>You are editing coins from: </strong>&quot;<?php echo $user_id; ?>&quot;
			</p>
							
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><a href="#" id="dialog_link5" class="ui-state-default ui-corner-all"></span> More info </a></p>
            	<div id="dialog5" title="More info about editing coins">
            <p>
            	You can give credits to any account.<br />
                The user <b>MUST</b> visit the D-Shop before getting coins.<br />
            	Please note that the account has to be <b>logged out</b> before sending any coins.<br />
				You can either add or remove current amount coins.<br /><br />
                
                If the account is online the query will not be competed, if you do want to send coins with the account online.<br />
                The query will fail, you have been noticed before you send the coins.<br /><br />
                
                <b>Send Delivery Confirmation ?</b><br />
                This option will allow you to send a PM to the account's mailbox.<br />
                Its easy for members who are offline, or went offline and not comming back.
            </p>
            </div>

			
	</div></div><br>
<?php

$login = $row["login_flag"];

if($login == '1100'){ 
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p>
        	<center><span class="blink"><h2><?php echo $user_id; ?> is reported as online, please logout the character!</h2></span></center>
        </p>
	</div>
</div>
<br />
<?php
} else {
echo "";
}

$query1 = "SELECT * FROM cash.dbo.user_cash WHERE user_no = '$user_no'";
$result1 = mssql_query($query1);
$row1 = mssql_fetch_array($result1);
$count1 = mssql_num_rows($result1);

  
if($count1 == '0') {
?>
				<div class='ui-widget'>
					<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
						<p>
							<center><span class="blink"><h2><?php echo $user_id; ?> has not yet visited the D-Shop!</h2></span> Therefore it cannot get coin.<br />Please tell <?php echo $user_id; ?> to visit the D-Shop.</center>
						</p>
					</div>
				</div><br />
<?php
} else {
$coins = $row1["amount"];

	if(empty($_POST['select'])) {
?>
			<center><form action='<?php $_SERVER['PHP_SELF']; ?>' method='POST'>
				<table class="ui-widget-content ui-corner-all" width="100%">
					<tr>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Current Coins</td>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;<?php echo $coins; ?></td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Edit Coins<br />&nbsp;&nbsp;<small><i>Enter the new amount of coins</i></small></td>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;&nbsp;<input type='text' name='coins_p' maxlength='20' value='0' size='20'></td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Send Delivery Confirmation ?</td>
                        <td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;&nbsp;<select name='admin' class='input'>
                                                                                        <option value='0'>No</option>
                                                                                        <option value='1'>Yes</option>
                                                                                        </select>
                        </td>
					</tr>
					<tr>
						<td >&nbsp;</td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all" >&nbsp;&nbsp;
							<input  type='hidden' name='select' value='1'>
							<input class="form-submit" type='submit' value='Edit Coins'>
						</td>
					</tr>
				</table>
			</form>
            </center>
<?php
	} elseif($_POST['select'] == '1') {


			$coins_post = $_POST['coins_p'];

			mssql_query("UPDATE
						cash.dbo.user_cash
					SET
						amount = '".$coins_post."'
					WHERE
						user_no = '$user_no'
					");

			
			$query2 = "SELECT * FROM cash.dbo.user_cash WHERE user_no = '$user_no'";
			$result2 = mssql_query($query2);
			$row2 = mssql_fetch_array($result2);
			$new_coins = $row2["amount"];
			
			?>
            <div class='ui-widget'>
	<div class='ui-state-success ui-corner-all' style='padding: 0 .5em;'>
		<p>
        	<center>Edit successfull! <?php echo $user_id; ?> has now <?php echo $new_coins; ?> coins!</center>
        </p>
	</div>
</div>
<br />

			
<?php
		}


}
?>