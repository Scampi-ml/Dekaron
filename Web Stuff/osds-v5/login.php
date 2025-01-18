<?php
include('osdscore.php');

if(isset($_GET['setadmin']))
{
	$update = $db_account->query("UPDATE user_profile SET user_group = '1' WHERE user_no = '" . $_GET['account'] . "' ");
	JavaAlert($_GET['accname']. LAN_login_set_admin .'!', 'logout.php');
	die();
}



if (isset($_POST['login']))
{
	if(preg_match('/[^0-9A-Za-z]/', $_POST['accname']))
	{
		JavaAlert(LAN_error_az09, 'index.php');
		die();
	}
	
	if(preg_match('/[^0-9A-Za-z]/', $_POST['accpass']))
	{
		JavaAlert(LAN_error_az09, 'index.php');
		die();
	}

	if(empty($_POST['accname']))
	{
		JavaAlert(LAN_error_empty_accname, 'index.php');
		die();
	}
	
	if(empty($_POST['accpass']))
	{
		JavaAlert(LAN_error_empty_accpass, 'index.php');
		die();
	}

	if (isValid($_POST["accname"]) == true && isValid($_POST["accpass"]) == true)
	{
		$accname = $_POST['accname'];
		$accpass = $_POST['accpass'];
		
		$result = $db_account->query("SELECT * FROM user_profile WHERE user_id = '".$accname."' AND user_pwd = '".md5($accpass)."' ");
		$getAccNum = $db_account->fetchNum($result);
		$getAcc = $db_account->fetchArray($result);
		
		if($getAccNum == '0')
		{	
			JavaAlert(LAN_error_no_result, 'index.php');
			die();
		}
		else
		{	
 			//$insert_login = $db_osds->query("INSERT INTO user_login_log (user_id, ip_address, login_time, login_time_detail) VALUES ('".$accname."',  '".$_SERVER['REMOTE_ADDR']."', '".date("M d - H:i")."', '".time()."' )  ");
			
			//+----------------------------------------------------------------------------+
			//|     Check for admin
			//+----------------------------------------------------------------------------+
			
			$result2 = $db_account->query("SELECT * FROM user_profile WHERE user_group = '1' ");
			$getAdmins = $db_account->fetchNum($result2);
			
			if($getAdmins == '0')
			{
				echo HEADER;
				echo '<div id="serverinfo">'.LAN_login_no_admin.'?</div>
				<table>
					<tr>
						<td>
							<ul id="topmenu2">
								<li><a class="tab" href="login.php?setadmin=yes&accname='.$accname.'&account='.$getAcc['user_no'].'">'.LAN_yes.'</a></li>
								<li><a class="tab" href="logout.php">'.LAN_no.'</a></li>
							</ul>
						</td>
					</tr>
				</table>';
				echo '<br><br><br>
					<div class="notice">
						<b>'.LAN_yes.'</b>: <b>'.$accname.'</b> '.LAN_login_no_admin_yes.'<br>
						<b>'.LAN_no.'</b>: '.LAN_login_no_admin_no.'
					</div>';
				echo FOOTER;
				die();
				
			}
			
			
			//+----------------------------------------------------------------------------+


			// load permissions	
			
					
			if($getAcc['user_group'] > '0')
			{
			
				if($getAcc['user_group'] == '1')
				{
					$_SESSION['USER'] = $getAcc['user_id'];
					$_SESSION['USERNO'] = $getAcc['user_no'];
					$_SESSION['ADMIN'] = '1';
					
					// All done, go to the admin page
					echo "<script type='text/javascript'>window.location='admin.php';</script>";
				}
				else
				{
				
					// check level
					$query_prem = $db_osds->query("SELECT * FROM groups WHERE group_id = '".$getAcc['user_group']."' ");
					$getGroup = $db_osds->fetchArray($query_prem);
					
					
					$_SESSION['USER'] = $getAcc['user_id'];
					$_SESSION['USERNO'] = $getAcc['user_no'];
					$_SESSION['ADMIN'] = '0';
					$_SESSION['GROUP'] = $getGroup['group_name'];
					
					// All done, go to the admin pageµ
					echo "<script type='text/javascript'>window.location='admin.php';</script>";
				
				
				}
			

			}
			else
			{
				JavaAlert(LAN_error_no_access, 'index.php');
				die();
			}
		}
	}
	else
	{
		JavaAlert(LAN_error_hack, 'index.php');
		die();
	}
}
else
{
	JavaAlert(LAN_error_no_form, 'index.php');
	die();
}
?>