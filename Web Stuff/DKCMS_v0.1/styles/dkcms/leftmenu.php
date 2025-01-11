<?php 

if(isset($_SESSION['id'])){
		echo "
	<table border='0' width='135' align='center'>
		<tr>
			<td>
				<div class='regtext'>
					<h3>Welcome, ".$_SESSION['id']."</h3>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class='menulink'>
					<a href='?dkcms=ucp'>Control Panel</a>
				</div>
			</td>
		</tr>";
	if(isset($_SESSION['admin'])){
		echo "
		<tr>
			<td>
				<div class='menulink'>
					<a href='?dkcms=admin'>Admin Panel</a>
				</div>
			</td>
		</tr>";
	}
		echo "
		<tr>
			<td>
				<div class='menulink'>
					<a href='?dkcms=ucp&amp;page=accset'>Account Settings</a>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class='menulink'>
						<a href='?dkcms=misc&amp;script=logout'>Log Out</a>
				</div>
			</td>
		</tr>
	</table>
	<br />";
		} else {
	if(isset($_POST['login'])) {
		$u = $_POST['username'];
		$p = $_POST['password'];
		$crypt_p = md5($p);
		$s = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$u."'");
		$i = mssql_fetch_array($s);
		
		if($i['user_pwd'] == $crypt_p ){
			$userz = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$i['user_id']."' AND user_pwd = '".$i['user_pwd']."'");
			$auser = mssql_fetch_array($userz);
			$_SESSION['id'] = $auser['user_id'];
			$_SESSION['name'] = $auser['name'];
			
			
			$userz2 = mssql_query("SELECT * FROM account.dbo.tbl_user WHERE user_id='".$u."'");
			$auser2 = mssql_fetch_array($userz2);
			if($auser2['webadmin'] == "1"){
				$_SESSION['admin'] = $auser2['webadmin'];
			}
			
			if($auser2['gm'] == "1"){
				$_SESSION['gm'] = $auser2['gm'];
			}
			$return = "<meta http-equiv=refresh content='0; url=?dkcms=misc&amp;script=redir'>";
		} else {
			$return = "<p><center>Invalid username or password.</center>";
		}
	}
		echo "
		<div class='regtext'>
			<h3>Welcome to $servername</h3>
		</div>
		<p><b>Register now!</b></p>
		<div class='regtext'>
			<form method='post' action=''>
				<center>
					<table border='0' width='135'>
						<tr>
							<td align='left' width='125'>
								<div class='h5'><b>Username:</b></div>
							</td>
						</tr>
						<tr>
							<td>
								<input type='text' name='username' maxlength='12' />
							</td>
						</tr>
						<tr>
							<td align='left' width='125'>
								<div class='h5'><b>Password:</b></div>
							</td>
						</tr>
						<tr>
							<td>
								<input type='password' name='password' maxlength='12' />
							</td>
						</tr>
						<tr>
							<td align='center'>
								<input type='submit' style='width:48%;' name='login' value='Login' />
								<input type='button' style='width:48%;' value='Register' onclick='location.href='?dkcms=main&amp;page=register';' />
								".$return."
							</td>
						</tr>
					</table>
				</center>
			</form>
		</div>
		<br />";
}
?>