<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
	<head>
        <title>Simple Ban IP</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css" media="screen">@import url(ban/style.css);</style>
	</head>
	<body>

	<?php
		session_start();
		$adminuser = 'admin';
		$adminpass = 'admin';
		
		include "ban/functions.php";
		if($_SESSION['is_logged']){
			$content1 = file('ban/data.txt');
			$continut = explode("$#",$content1[0]);
			
			if(isset($_POST['delete'])){
				$fp = fopen('ban/data.txt','w');
				unset($continut[$_POST['formid']]);
				$string = @implode("$#",$continut);
				fwrite($fp, $string);
				fclose($fp);
				}
		
			if(isset($_POST['addfield'])){
				if(!is_ip($_POST['ip'])){
					$_POST['ip'] = '';
					$err = "<div class='error'>IP entered is not an IP!</div>";
				}
				elseif (preg_match("/".$_POST['ip']."/i", $content1[0])) {
					$_POST['ip'] = '';
					$err = "<div class='error'>Ip Already banned!</div>";
				}
		
			if($_POST['ip']){
				if($_POST['duration']){
					$timestamp = time() + ($_POST['duration']*3600);
					$fp = fopen('ban/data.txt','w');
					$continut[]	= $_POST['ip']."|".$timestamp.'|'.$_POST['duration'];
					$string = implode("$#",$continut);
					fwrite($fp, $string);
					fclose($fp);
					$err="<div class='success'>Ip Banned!</div>";
				}
			}		
		}
		
		$content1 = file('ban/data.txt');
		$content = explode("$#",$content1[0]);
		$to	= $content['0'];
		
		foreach($content as $i=>$val){
			if($content[$i]){
				$forms[] = $content[$i];
			}	
		}
		echo "<div id='container'>
				<table width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td width='70%' valign='top'>
							<table width='100%' cellspacing='0' cellpadding='0'>
								<tr>
									<td class='tablehead'>ID</td>
									<td class='tablehead'>IP</td>
									<td class='tablehead'>Duration</td>
									<td class='tablehead' style='width:190px;'>Expires</td>
									<td class='tablehead' style='width:120px;'></td>
								</tr>";
		if($forms){
			$i = 1;
			foreach($forms as $tag=>$val){
				$z = explode('|',$val);
				list($ip,$timestamp,$type) = $z;
	
					echo "
					<form action='' method='POST'>
						<tr bgcolor='white'>
							<td style='padding-left:4px;'>". $i . "</td>
							<td class='td1' align='center'>" . $ip ."</td>
							<td class='td3' align='center'>" . time2type($type) . "</td>
							<td class='td2' align='center'>";
	
												if($timestamp != 'permanent'){
													echo countdown($timestamp);
												} else {
													 echo "Permanent";
												}
					  echo "</td>
							<td class='td4' align='right'>
								<div class='buttons'>
									<button type='submit' class='negative' name='delete'>Delete</button>
										<input type='hidden' name='formid' value='" . $tag . "'>
								</div>
							</td>
					</tr>
				</form>";
			$i++;
		}
		
		} else { 
			echo "<tr><td colspan='5' align='center'>No IP's banned Yet!</td></tr>"; 
		}
	
		echo "</table>
				<br><br>
			</td>
		<td style='border-left:1px solid #3b3b3b; padding:5px;' valign='top'>
		" . $err . "
			<span class='title'>Ban IP</span>
				<form action='' method='POST'>	
					<table width='100%'>
						<tr>
							<td>IP</td>
							<td><input type='text' class='text' name='ip'></td>
						</tr>		
						<tr>
							<td>Duration</td>
							<td>
								<select name='duration' class='select'>
									<option value=''>Select</option>
									<option value='12'>12 Hours</option>
									<option value='24'>1 Day</option>
									<option value='48'>2 Days</option>
									<option value='72'>3 Days</option>
									<option value='168'>1 Week</option>
									<option value='336'>2 Weeks</option>
									<option value='744'>1 Month</option>
									<option value='8760'>1 Year</option>
								</select>
							</td>
						</tr>
					<tr>
					<td colspan='2'>
						<div class='buttons'><button type='submit' class='positive' name='addfield'>Ban IP</button>
						</div>
					</td>
				</tr>
			</form>	
		</table>
		</td>
	</tr>
	</table>
	</div>";
	
		} else {
			if(isset($_POST['login'])){
				if($_POST['user'] == $adminuser && $_POST['pass'] == $adminpass){
					$_SESSION['is_logged'] = 1;
					$err = '<meta http-equiv="refresh" content="0;url=' . $_SERVER['PHP_SELF'] . '">';
				}else{
					$err = '<font color="red">Wrong username/password!</font>';
				}
			}
		
		echo "<div id='container' style='width:300px; height:150px;'>
				<center>" . $err . "</center>
				<br><br>
				<div class='buttons'>
					<form action='' method='POST'>
						<table align='center'>
							<tr>
								<td>Username: </td>
								<td><input type='text' class='text' name='user' style='width:200px;'></td>
							</tr>
							<tr>
								<td>Password: </td>
								<td><input type='password' class='text' name='pass' style='width:200px;'></td>
							</tr>
							<tr>
								<td colspan='2' align='center'>
									<button type='submit' class='positive' name='login'>
										<img src='ban/images/apply.png'/>Login
									</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>";
	
		}
	?>
	</body>
</html>