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
				<strong>You are editing: </strong>&quot;<?php echo $user_id; ?>&quot;
			</p>
							
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><a href="#" id="dialog_link5" class="ui-state-default ui-corner-all"></span> More info </a></p>
            	<div id="dialog5" title="More info about caccount editing">
            <p>
            	You can edit your account any way you want, but there are some limitations. Like:<br />
				     <ul>
						<li>DISABLED: user_bo (Very bad idea to change this!)</li>
						<li>DISABLED: resident_no (You dont need to change that)</li>
                        <li>DISABLED: user_type (You dont need to change that)</li>
                        <li>DISABLED: login_flag (You dont need to change that, unless you DB is realy messed up)</li>
                        <li>DISABLED: login_tag (If you want ban/unban this user, please use the dev homepage)</li>
                        <li>DISABLED: server_id (You dont need to change that)</li>
            		</ul>

            	I have disabled this for security reasons, or you dont need to edit them<br />
				If you do wanna change them, you can edit this script, but be carefull what you edit!<br />
                Passwords will be changed in user_profile in MD5<br />
                User passwords will NOT be shown here, for security reasons.
            </p>
            </div>
	</div></div><br>
<?php  
  $query1 = "SELECT * FROM account.dbo.tbl_user WHERE user_no = '$user_no'"; 
  $result1 = mssql_query($query1);
  $row1 = mssql_fetch_array($result1);
  
  $query2 = "SELECT * FROM character.dbo.user_character WHERE user_no = '$user_no'";
  $numresults2 = mssql_query($query2);
  $numrows2 = mssql_num_rows($numresults2);
   
  $login = $row["login_flag"];
  $login_tag = $row["login_tag"];

  if($login == '1100'){ 
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p><center><b>Alert:</b> <?php echo $user_id; ?> is reported as online, but you dont have to worry about it!
        <br />But please notify the user that his account was changed.</center></p>
	</div>
</div>
<br />
<?php
} else {
echo "";
}

if($login_tag == 'N'){
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p><center><b>Alert:</b> <?php echo $user_id; ?> is reported as banned!</center></p>
	</div>
</div>
<br />
<?php
} else {
echo "";
}


$acc_ip = decode_ip(bin2hex($row["user_ip_addr"]));

echo '<div class="ui-widget-content ui-corner-all" >';

if(!isset($_POST['modify'])){
echo "<form method='post' action=''>
			<table border='0' width='100%'><br>
				<tr>
					<td align='right' width='50%'>Username :</td>
					<td>".$row['user_id']."</td>
				</tr>
				<tr>
					<td align='right' width='50%'>Characters on account: </td>
					<td>".$numrows2."</td>
				</tr>

				<tr>
					<td align='right' width='50%'>User No: </td>
					<td>".$row1['user_no']."</td>
				</tr>
				<tr>
					<td align='right' width='50%'>E-mail: </td>
					<td><input type='text' name='email' value='".$row1['user_mail']."' /></td>
				</tr>
				<tr>
					<td align='right' width='50%'>New Password: </td>
					<td><input type='password' name='password' maxlength='12' value='".$row1['user_pwd']."' /></td>
				</tr>
				<tr>
					<td align='right' width='50%'>Last known IP: </td>
					<td>".$acc_ip."</td>
				</tr>
				<tr>
					<td align='right' width='50%'>(un)ban Reason: </td>
					<td>".$row1['banreason']."</td>
				</tr>

				<tr>
					<td align='right' width='50%'>Ban Status: </td>
					<td>";
						
						if($row1['banned'] == '1') {

						echo "<a href='?osds=dev&page=ban_acc&user_no=".$user_no."&ban=0' title='User is banned, click here to unban'><img src='images/dev/ban.png' border='0' /></a>";
						
						} else {
					
						echo "<a href='?osds=dev&page=ban_acc&user_no=".$user_no."&ban=1' title='User is not banned, click here to ban'><img src='images/dev/unban.png' border='0' /></a>";
						
						}
					
echo "				</td>
				</tr>
				<tr>
					<td align='right' width='50%'>Banned By: </td>
					<td>";
					
						if($row1['banby'] == '0') {

						echo "Not in use";
						
						} else {
					
						echo "".$row1["banby"]."";
						
						}

					
echo "					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>Ban Time: </td>
					<td>";
					
						if($row1['bantime'] == '0') {

						echo "Not in use";
						
						} else {
					
						echo "".$row1["bantime"]."";
						
						}

					
					
echo "				</td>
				</tr>

				<tr>
					<td align='right' width='50%'>Last Login: </td>
					<td>";
					
						if($row1['lastlogin'] == '0') {

						echo "Never logged in";
						
						} else {
					
						echo "".$row1["lastlogin"]."";
						
						}

					
					
echo "				</td>
				</tr>
				<tr>
					<td align='right' width='50%'>Is admin? </td>
					<td align='left'><select name='admin' class='input'>";
							if($row1["admin"] == '0') {
								echo "<option value='0' selected>No</option>";
							} else {
								echo "<option value='0'>No</option>";
							}
							if($row1["admin"] == '1') {
								echo "<option value='1' selected>Yes</option>";
							} else {
								echo "<option value='1'>Yes</option>";
							}
				echo "</select></td>
				</tr>
				<tr>
					<td align='right' width='50%'>Is gm? </td>
					<td align='left'><select name='admin' class='input'>";
							if($row1["gm"] == '0') {
								echo "<option value='0' selected>No</option>";
							} else {
								echo "<option value='0'>No</option>";
							}
							if($row1["gm"] == '1') {
								echo "<option value='1' selected>Yes</option>";
							} else {
								echo "<option value='1'>Yes</option>";
							}
				echo "</select></td>
				</tr>

				<tr>
					<td></td>
					<td><br><input type='submit' name='modify' value='Modify Account' /></td>
				</tr>
			</table>
		</form>
		</div";


	}else{
		$pass = $_POST['password'];
		$email = $_POST['email'];
		$admin = $_POST['admin'];
		$gm = $_POST['gm'];
		$crypt_pass = md5($pass);
		
		mssql_query("UPDATE account.dbo.tbl_user SET user_pwd = '$pass', user_mail = '$email' WHERE user_no = '$user_no'");
		mssql_query("UPDATE account.dbo.USER_PROFILE SET user_pwd = '$crypt_pass' WHERE user_no = '$user_no'");
		echo "Your changes have successfully been saved.";

		}
	
	echo "
	</fieldset>";

?>
