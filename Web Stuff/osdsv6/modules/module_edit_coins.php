<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("amount","req","Please fill in the acount");
	$validate->check("free_amount","req","Please fill in the free amount");
	
	$validate->check("amount","num","You can only use0-9 characters in your amount");
	$validate->check("free_amount","num","You can only use 0-9 characters in your free amount");
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_coins&account='.$_GET['account'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE cash.dbo.user_cash SET amount = '%s', free_amount = '%s' WHERE user_no = '%s'", $_POST['amount'], $_POST['free_amount'], $_GET['account']);
	
		echo notice_message_admin('Coins successfully updated', '1', '0', 'index.php?get=module_edit_coins&account='.$_GET['account'].'');
	}
}
else
{
	$SQLquery1 = $db->SQLquery("SELECT * FROM cash.dbo.user_cash WHERE user_no = '%s'", $_GET['account']);
	$getCoinsInfo = $db->SQLfetchArray($SQLquery1);
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Coins</td>
	</tr>  
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Amount</b><br>This is the login for the account<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="amount" size="30" maxlength="20" value="<?php echo htmlspecialchars($getCoinsInfo['amount']); ?>" /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Free Amount</b><br>Must be a valid email to recive user info and other info<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="free_amount" size="30" value="<?php echo htmlspecialchars($getCoinsInfo['free_amount']); ?>"  /></td>
	</tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_coins&account=<?php echo $_GET['account']; ?>')"></td>
    </tr>
</table>
<input type="hidden" name="account" value="<?php echo $getGuildInfo['guild_code']; ?>" >
</form>
<?php
}
?>
