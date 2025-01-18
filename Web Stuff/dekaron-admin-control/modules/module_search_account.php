<form action="" name="form_edit" method="POST">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
      <td align="center" class="panel_title" colspan="2">Search Account</td>
    </tr>
    <tr>
      <td align="left" class="panel_title_sub" colspan="2">User ID</td>
    </tr>
    <tr>
      <td align="left" class="panel_text_alt1" width="45%" valign="top">
          Enter User id of account which you want to find
          <br>Use <b>*</b> for all results
          <br> Results are limited to the first <?php echo htmlspecialchars($config->get('top', 'settings_search_account')); ?> results    
      </td>
      <td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user"></td>
    </tr>    
    <tr>
      <td align="right" class="panel_buttons" colspan="2">
        <input type="hidden" name="search">
        <input type="submit" value="Search">
      </td>
    </tr>
  </table>
</form>
<?php
if (isset($_POST['search']))
{
	if (!empty($_POST['user']))
	{
		$userid = safe_input($_POST['user'], '');
		?>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
        <tr>
          <td align="center" class="panel_title" colspan="5">Search Results</td>
        </tr>
        <tr>
          <td align="left" class="panel_title_sub2">User ID</td>
          <td align="center" class="panel_title_sub2" width="50">Action</td>
        </tr>
		<?php
			$top = $config->get('top', 'settings_search_account');
			$query1 = $db->SQLquery("SELECT TOP ".$top." user_id,user_no FROM account.dbo.user_profile WHERE user_id LIKE '%".$userid."%' ORDER BY user_id ASC");
			$qnum1 = $db->SQLfetchNum($query1);
			
			if ($qnum1 == '0')
			{
				echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Accounts Found</td></tr>';
			}
			else
			{
				flush_this();
				$count = 0;
				while ($qarray = $db->SQLfetchArray($query1))
				{
					$count++;
					$tr_color = ($count % 2) ? '' : 'even';
					echo '<tr class="' . $tr_color . '">
							<td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($qarray['user_id']) . '</strong></td>
							<td align="center" class="panel_text_alt_list" width="50"><a href="index.php?get=module_action&account=' . htmlspecialchars($qarray['user_no']) . '">[Action]</a</td>
						</tr>';
				}
			}

		echo '</table>';
	}
}
?>