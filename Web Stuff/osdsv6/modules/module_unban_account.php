<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("UPDATE account.dbo.USER_PROFILE SET login_tag = 'Y' WHERE user_no = '%s'", $_GET['account'] );
	
	echo notice_message_admin('Account successfully unbanned', '1', '0', 'index.php?get=module_search_account');
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT user_id,user_no FROM account.dbo.user_profile WHERE user_no = '".$_GET['account']."' ");
	$getAccountInfo = $db->SQLfetchArray($SQLquery1);

?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
        <td class="cat"><div align="left"><b>Please confirm</b></div></td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 20px; padding-bottom: 20px;">
        	<b>Are you sure you want to unban "<?php echo $getAccountInfo['user_id']; ?>" ?</b>
            <br><br><br><br>
            <input type="hidden" name="account" value="<?php echo $getGuildInfo['user_id']; ?>" >
        	<input type="submit" value="Unban Account" onclick="ask_url('Are you sure you want to unban this account?','index.php?get=module_unban_account')">
    	</td> 
    </tr>
</table>	
</form>	
<?php
}
?>