<form action="" name="form_edit" method="POST">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
      <td align="center" class="panel_title" colspan="2">Search Character</td>
    </tr>
    <tr>
      <td align="left" class="panel_title_sub" colspan="2">Character Name</td>
    </tr>
    <tr>
      <td align="left" class="panel_text_alt1" width="45%" valign="top">
          Enter name of character which you want to find
          <br>Use <b>*</b> for all results    
          <br> Results are limited to the first <?php echo htmlspecialchars($config->get('top', 'settings_search_character')); ?> results    
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
		$character_name = safe_input($_POST['user'], '');
		?>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
        <tr>
          <td align="center" class="panel_title" colspan="5">Search Results</td>
        </tr>
        <tr>
          <td align="left" class="panel_title_sub2">Character Name</td>
          <td align="center" class="panel_title_sub2" width="100">Controls</td>
        </tr>
		<?php
			$top = $config->get('top','settings_search_character');
			$query1 = $db->SQLquery("SELECT TOP ".$top." character_name,character_no FROM character.dbo.user_character WHERE character_name LIKE '%".$character_name."%' ORDER BY character_name ASC");
			$qnum1 = $db->SQLfetchNum($query1);
			
			if ($qnum1 == '0')
			{
				echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Characters Found</td></tr>';
			}
			else
			{
				flush_this();
				$count = 0;
				while ($qarray = $db->SQLfetchArray($query1))
				{
					if($config->get('top','settings_search_character') == '0')
					{
						preg_match('/^19999999999991/', $result['user_no'], $matches, PREG_OFFSET_CAPTURE);
						if( $matches ) 
						{
							continue;
						}	
					}
								
					$count++;
					$tr_color = ($count % 2) ? '' : 'even';
					echo '<tr class="' . $tr_color . '">
							<td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($qarray['character_name']) . '</strong></td>
							<td align="center" class="panel_text_alt_list" width="50"><a href="index.php?get=module_action&character='. htmlspecialchars($qarray['character_no']).'">[Action]</a</td>
						</tr>';
				}
			}
		
		echo '</table>';
	}
}
?>