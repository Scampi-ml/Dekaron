<?php 

if($_SESSION['id']){
	echo "
	<fieldset>
		<legend>
			<b>Account Settings</b>
		</legend>";
	if(!isset($_POST['modify'])){
		$query = mssql_query("SELECT * FROM account.dbo.tbl_user WHERE user_id='".$_SESSION['id']."'");
		$row = mssql_fetch_array($query);
		echo "
		<h4>
			If you wish to keep your current password, then leave the password fields blank.
		</h4><br />
		<form method='post' action=''>
			<table border='0' width='100%'>
				<tr>
					<td align='right' width='50%'>
						<b>Username</b>
					</td>
					<td>".$row['user_id']."</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>Current Password</b>
					</td>
					<td>
						<input type='password' name='current' maxlength='12' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>New Password</b>
					</td>
					<td>
						<input type='password' name='password' maxlength='12' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>Confirm Password</b>
					</td>
					<td>
						<input type='password' name='cpassword' maxlength='12' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>E-mail</b>
					</td>
					<td>
						<input type='text' name='email' value='".$row['user_mail']."' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>First Name</b>
					</td>
					<td>
						<input type='text' name='name' value='".$row['name']."' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>Last Name</b>
					</td>
					<td>
						<input type='text' name='lastname' value='".$row['lastname']."' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>Country</b>
					</td>
					<td>
						<input type='text' name='country' value='".$row['country']."' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>Birth date</b><br />
						<i>DD-MM-YYYY</i>
					</td>
					<td valign='top'>
						<input type='text' name='birthday' value='".$row['birthday']."' />
					</td>
				</tr>
				<tr>
					<td align='right' width='50%'>
						<b>Secret number:</b>
					</td>
					<td>
						<input type='text' name='secretnr' value='' />
					</td>
				</tr>
				<tr>
					<td />
					<td>
						<input type='submit' name='modify' value='Modify' />
					</td>
				</tr>
			</table>
		</form>";

	}else{
		$u = mssql_query("SELECT * FROM account.dbo.tbl_user WHERE user_id='".$_SESSION['id']."'");
		$userz = mssql_fetch_array($u);
		$current = $_POST['current'];
		$pass = $_POST['password'];
		$cpass = $_POST['cpassword'];
		$email = $_POST['email'];
		$birthday = $_POST['birthday'];
		$name = $_POST['name'];
		$lastname = $_POST['lastname'];
		$country = $_POST['country'];
		$secretnr = $_POST['secretnr'];
		
		$crypt_pass = md5($pass);
		
		if($secretnr == $userz['secretnr']){
			if($current){
				if($userz['password'] == $crypt_pass){
					if($pass != $cpass){
						echo "Passwords do not match.";
					}else{
						if(strlen($pass) < 6){
							echo "Your password must be between 6 and 12 characters.";
						}elseif(strlen($pass) > 12){
							echo "Your password must be between 6 and 12 characters.";
						}else{
							$u = mssql_query("UPDATE account.dbo.tbl_user SET user_pwd='".$crypt_pass."' WHERE user_id='".$userz['user_id']."'");
							$u = mssql_query("UPDATE account.dbo.USER_PROFILE SET user_pwd='".$crypt_pass."' WHERE user_id='".$userz['user_id']."'");
							echo "Your changes have successfully been saved.";
						}
					}
				}else{
					echo "The password you have entered is incorrect.";
				}
			}elseif($email == ""){
				echo "Please supply an email address.";
			}else{
				$u = mssql_query("UPDATE account.dbo.tbl_user 
									SET 
								user_mail = '".$email."',
								birthday = '".$birth."' ,
								name = '".$name."' ,
								lastname = '".$lastname."' ,
								country = '".$country."' 
									WHERE 
								user_id='".$userz['user_id']."'");
	
				echo "Your changes have successfully been saved.";
			}
				}else{
					echo "Your secret number does not match or incorrect.";
			}

		}
	
	echo "
	</fieldset>";
}else{
	include('modules/public/login.php');
}
?>
