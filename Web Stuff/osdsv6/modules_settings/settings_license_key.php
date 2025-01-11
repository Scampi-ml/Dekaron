<?php
$contact = '<br>Please contact support for any license issues.';

if(isset($_GET['key']) && !empty($_GET['key']) && $_GET['key'] == 'remove')
{
	$config->set('license_key', '', 'settings_dac_settings' );
	unlink('engine/license.key');
	echo notice_message_admin('License key successfully removed', '1', '0', 'index.php?get=module_settings&php=settings_license_key.php');
}
elseif (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
	$validate = new FormValidator();
	
	$validate->check("license_key","req","Please fill in the license key");
	
	if($validate->ValidateForm() == false)
	{
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_settings&php=settings_license_key.php');
	}
	else
	{
		
		$result = file_get_contents('http://www.dkunderground.org/license.php?key='.$_POST['license_key'].'&action=check');
		
		if(!$result)
		{
			echo notice_message_admin('Error contacting license system.'.$contact.'', '0', '1', 'index.php?get=module_settings&php=settings_license_key.php');
		}
		elseif($result != 'VALID')
		{
			echo notice_message_admin($result.' '.$contact, '0', '1', 'index.php?get=module_settings&php=settings_license_key.php');	
		}
		else
		{
			$activation_code = generate_activation_key();
			$result2 = file_get_contents('http://www.dkunderground.org/license.php?key='.$_POST['license_key'].'&action=activate&activation_code='.$activation_code.'');
			if($result2 == 'ok')
			{				
				$config->set('license_key', $_POST['license_key'], 'settings_dac_settings');
				
				$license_file = 'engine/license.key';
				$fh = fopen($license_file, 'a');
				fwrite($fh, $activation_code);
				fclose($fh);
				
				echo notice_message_admin('License key successfully activated', '1', '0', 'index.php?get=module_settings&php=settings_license_key.php');
			}
			else
			{
				echo notice_message_admin('Failed to activate license key, please try again later.'.$contact.'', '0', '1', 'index.php?get=module_settings&php=settings_license_key.php');
			}
		}
	}
}
else
{
	if(!file_exists('engine/license.key'))
	{
		$isset = '';
	}
	else
	{
		$isset = '<br><a href="index.php?get=module_settings&php=settings_license_key.php&key=remove">Click here</a> to remove the license key';
	}
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">License Key Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>License Key</b>
        	<br>The license key that was given upon purchase
            <?php echo $isset; ?>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="license_key" size="30" value="<?php echo htmlspecialchars($config->get('license_key', 'settings_dac_settings')); ?>" />
        </td>
	</tr>
    <?php
	if(file_exists('engine/license.key'))
	{
		$license = file_get_contents('engine/license.key');
		$license_key = explode('|', $license);
	?>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>License Info</b></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
            <b>Licensed to:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="msg_error"><?php echo htmlspecialchars($license_key[0]); ?></p>
            <br>
            <b>Activated on:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="msg_error"><?php echo htmlspecialchars(date(DATE_RFC822, $license_key[1])); ?></p>
            <br>
            <b>Expires:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="msg_error">Never</p>
            
        </td>
	</tr>
    <?php
	}
	
	if(!file_exists('engine/license.key'))
	{
	?>
        <tr>
            <td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Check & Activate License"></td>
        </tr>
    <?php
	}
	?>
</table>
</form>
<?php
}
?>