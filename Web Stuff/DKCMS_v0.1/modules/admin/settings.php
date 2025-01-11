<?php 
if(isset($_GET["do"])){
	$do = $_GET["do"];
}else {
	$do = "";
}

if($_SESSION['admin']){
	if($do == "submit"){
		$sservername = $_POST['servername'];
		$ssitetitle = $_POST['sitetitle'];
		$sforumurl = $_POST['forumurl'];
		$ssiteurl = $_POST['siteurl'];
		$sexp = $_POST['exprate'];
		$smoney = $_POST['moneyrate'];
		$sdrop = $_POST['droprate'];
		$smbanner = $_POST['mbanner'];
		$smblink = $_POST['mblink'];
		$sstyledir = $_POST['styledir'];
		$sdkcmsdir = $_POST['dkcmsdir'];
		$semail = $_POST['email'];
	
		$stop = "false";
		if(empty($sservername)){
			echo '<font color="red">Your server doesn&apos;t have a name</font>';
			$stop = "true";
			header("refresh: 1; url=?dkcms=admin&page=settings");
		}
		if($stop == "false"){
			if(empty($ssitetitle)){
				echo '<font color="red">Your site doesn&apos;t have a name?</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($sforumurl)){
				echo '<font color="red">You need to enter a forum URL. If you don&apos; have one, just put a &apos;#&apos; in the text box.</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($ssiteurl)){
				echo '<font color="red">You need to enter a site URL. If you are unsure, just put a &apos;/&apos; in the text box.</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($sexp)){
				echo '<font color="red">Enter an exp rate. Don&apos;t put an x in the text box!</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($smoney)){
				echo '<font color="red">Enter a money rate. Don&apos;t put an x in the text box!</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($sdrop)){
				echo '<font color="red">Enter an drop rate. Don&apos;t put an x in the text box!</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($smbanner)){
				echo '<font color="red">Enter the link to your middle banner. If you are unsure, leave the text box as is.</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($smblink)){
				echo '<font color="red">Enter a link for the middle banner. If you are unsure, put &apos;#&apos; in the text box.</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($sstyledir)){
				echo '<font color="red">Enter a style directory. Default is styles/dkcms/.</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($sdkcmsdir)){
				echo '<font color="red">Enter the dkcms Directory. Default is /dkcms/</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
		if($stop == "false"){
			if(empty($semail)){
				echo '<font color="red">Enter your email.</font>';
				$stop = "true";
				header("refresh: 1; url=?dkcms=admin&page=settings");
			}
		}
			
		if($stop == "false"){
			$mquery = "UPDATE dkcms.dbo.dkcms_settings SET name='$sservername', title='$ssitetitle', forumurl='$sforumurl', siteurl='$ssiteurl', exprate='$sexp', moneyrate='$smoney', droprate='$sdrop', mbanner='$smbanner', mblink='$smblink', styledir='$sstyledir', dkcmsdir='$sdkcmsdir', email='$semail'";
			mssql_query($mquery);
			echo "<h4>settings updated.</h4>";
			echo "<meta http-equiv='refresh' content='1;URL=index.php?dkcms=admin&page=settings' />";
		}
	}
	elseif($do == ""){
		include('config/settings.php');
				
		echo "
		<form method='post' action='?dkcms=admin&amp;page=settings&amp;do=submit'>
			<table border='0' width='100%'>
				<tr valign='top'>
					<td >
						<table border='0' width='100%'>
							<tr>
								<td class='regtext'>
									<b>Server Name:</b>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='servername' type='text' value='".$servername."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext' >
									<b>Site Title:</b>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='sitetitle' type='text' value='".$sitetitle."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext' >
									<b>Forum Link:</b>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='forumurl' type='text' value='".$forumurl."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext' >
									<b>Site URL:</b> <i>(Leave as-is if you aren't sure)</i>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='siteurl' type='text' value='".$siteurl."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext'>
									<b>Administrator Email:</b>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='email' type='text' value='".$adminemail."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext'>
									<b>dkcms Directory:</b> <i>(Leave as-is if you aren't sure)</i>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='dkcmsdir' type='text' value='".$dkcmsdir."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext'>
									<b>Default Style Directory:</b>
								</td>
							</tr>
							<tr>
								<td>
									<input style='width:98%;' name='styledir' type='text' value='".$styledir."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext' >
									<b>Middle Banner Image:</b>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='mbanner' type='text' value='".$mbanner."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td class='regtext' >
									<b>Middle Banner Link:</b>
								</td>
							</tr>
							<tr>
								<td align='center'>
									<input style='width:98%;' name='mblink' type='text' value='".$mblink."' maxlength='100'/>
								</td>
							</tr>
							<tr>
								<td align='regtext'>
									<b>Exp Rate:</b> <input style='width:98%;' name='exprate' type='text' value='".$exprate."' maxlength='100'/><br>
									<b>Money Rate:</b> <input style='width:98%;' name='moneyrate' type='text' value='".$moneyrate."' maxlength='100'/><br>
									<b>Drop Rate:</b> <input style='width:98%;' name='droprate' type='text' value='".$droprate."' maxlength='100'/>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width='100%' align='center' colspan='2'>
						<input name='submit' type='submit' value='Submit' />
					</td>
				</tr>
			</table>";
	}
}else{
	include('modules/public/accessdenied.php');
}
?>