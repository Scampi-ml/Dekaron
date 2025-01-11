<?php
 $ban = $_GET['ban'];
 
	$query = "SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '".$_GET['user_no']."'"; 
	$result = mssql_query($query);
	$row = mssql_fetch_array($result);
	  
	$user_id = $row["user_id"];
?>
	 	<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong>You are (un)banning: </strong>&quot;<?php echo $user_id; ?>&quot;
			</p>
							
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><a href="#" id="dialog_link3" class="ui-state-default ui-corner-all"></span> More info </a></p>
            	<div id="dialog3" title="More info about (un)banning">
            <p>
            	You can ban or unban a account.<br />
				You can edit the ban file, with a editor.<br />
                Look for line 49 or around it, there you see a list of all reasons.<br />
            </p>
            </div>

			
	</div></div><br>


<?php

 if($ban == '1'){

 
   	if(empty($_POST['select'])) {
?>
			<center><form action='<?php $_SERVER['PHP_SELF']; ?>' method='POST'>
				<table class="ui-widget-content ui-corner-all" width="100%">
					<tr>
						<td width="50%" class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Your name<br />
					  &nbsp;&nbsp;<small><i>If you want a other name, please fill in the name here.</i></small></td>
						<td width="50%" class="ui-widget-content ui-corner-all">&nbsp;&nbsp;
					  <input type='text' name='banby' maxlength='20' value='<?php echo $_SESSION['user_id']; ?>' size='20'></td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Ban Reason<br />
						&nbsp;&nbsp;<small><i>If the ban reason is not in this list, select &quot;Other&quot;.</i></small></td>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;&nbsp;<select name='banreason' class='input'>
                                                                                         <option value='Hacking'>Hacking</option>
                                                                                         <option value='Spam'>Spam</option>
                                                                                         <option value='Impersonating Staff'>Impersonating Staff</option>
                                                                                         <option value='Advertising'>Advertising</option>
                                                                                         <option value='Harrasment'>Harrasment</option>
                                                                                         <option value='Bug exploits'>Bug exploits</option>
                                                                                         <option value='Other'>Other</option>
                                                                                       </select>
                        </td>
					</tr>
					<tr>
						<td >&nbsp;</td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all" >&nbsp;&nbsp;
							<input  type='hidden' name='select' value='1'>
							<input class="form-submit" type='submit' value='Ban Account'>
						</td>
					</tr>
				</table>
			</form>
            </center>
<?php

	} elseif($_POST['select'] == '1') {
	
		$bantime = date("r");
		$banby = $_POST['banby'];
		$banreason = $_POST['banreason'];
		
		
		mssql_query("UPDATE 
						account.dbo.tbl_user 
					SET 
						banned = '1',
						bantime = '".$bantime."',
						banby = '".$banby."',
						banreason = '".$banreason."' 
					WHERE 
						user_no = '".$_GET['user_no']."'");
						
						
						
				mssql_query("UPDATE 
						account.dbo.USER_PROFILE 
					SET 
						login_tag = 'N'
					WHERE 
						user_no = '".$_GET['user_no']."'");

						
						
					$query = "SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '".$_GET['user_no']."'"; 
					$result = mssql_query($query);
					$row = mssql_fetch_array($result);
					  
 					$user_id = $row["user_id"];

?>
            <div class='ui-widget'>
				<div class='ui-state-success ui-corner-all' style='padding: 0 .5em;'>
					<p>
						<center>Ban successfull! <?php echo $user_id; ?> has now been banned!<br> I cant redirect you, because i dont know where you want to go next.</center>
					</p>
				</div>
			</div>
			<br />
<?php
	}
 
}else {
 

if(empty($_POST['select'])) {
?>
			<center><form action='<?php $_SERVER['PHP_SELF']; ?>' method='POST'>
				<table class="ui-widget-content ui-corner-all" width="100%">
					<tr>
						<td width="50%" class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Your name<br />
					  &nbsp;&nbsp;<small><i>If you want a other name, please fill in the name here.</i></small></td>
						<td width="50%" class="ui-widget-content ui-corner-all">&nbsp;&nbsp;
					  <input type='text' name='unbanby' maxlength='20' value='<?php echo $_SESSION['user_id']; ?>' size='20'></td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;Unban Reason<br />
						&nbsp;&nbsp;<small><i>Please select a reason why you want to unban. (Max 50 Chars)</i></small></td>
						<td class="ui-widget-content ui-corner-all">&nbsp;&nbsp;&nbsp;<input type='text' name='unbanreason' maxlength='50' value='' size='20'>
                        </td>
					</tr>
					<tr>
						<td >&nbsp;</td>
					</tr>
					<tr>
						<td class="ui-widget-content ui-corner-all" >&nbsp;&nbsp;
							<input  type='hidden' name='select' value='1'>
							<input class="form-submit" type='submit' value='Unban Account'>
						</td>
					</tr>
				</table>
			</form>
            </center>
<?php

	} elseif($_POST['select'] == '1') {
	
		$unbantime = date("r");
		$unbanby = $_POST['unbanby'];
		$unbanreason = $_POST['unbanreason'];
		
		
		mssql_query("UPDATE 
						account.dbo.tbl_user 
					SET 
						banned = '0',
						bantime = '".$unbantime."',
						banby = '".$unbanby."',
						banreason = '".$unbanreason."' 
					WHERE 
						user_no = '".$_GET['user_no']."'");
						
						
		mssql_query("UPDATE 
						account.dbo.USER_PROFILE 
					SET 
						login_tag = 'Y'
					WHERE 
						user_no = '".$_GET['user_no']."'");

						
						
					$query = "SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '".$_GET['user_no']."'"; 
					$result = mssql_query($query);
					$row = mssql_fetch_array($result);
					  
 					$user_id = $row["user_id"];

?>
            <div class='ui-widget'>
				<div class='ui-state-success ui-corner-all' style='padding: 0 .5em;'>
					<p>
						<center>Unban successfull! <?php echo $user_id; ?> has now been unbanned!<br> I cant redirect you, because i dont know where you want to go next.</center>
					</p>
				</div>
			</div>
			<br />
<?php
	}
 

}

?>