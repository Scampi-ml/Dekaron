<?php
if (isset($_POST) && !empty($_POST))
{
	$permissions = new ConfigMagik("engine/servers/".$_COOKIE["server"]."/".$_POST['admin']."/permissions.ini");
	$permissions->PROCESS_SECTIONS = false;
	$permissions->PROTECTED_MODE   = false;
	$permissions->SYNCHRONIZE      = true;

	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		if($key == 'admin')
		{
			continue;
		}	
		$permissions->set($key, $val, '');
	}
	echo notice_message_admin('Permissions successfully saved', '1', '0', 'index.php?get=module_admin_permissions&admin='.htmlspecialchars($_POST['admin']).'');
}
else
{
	if(isset($_GET['admin']) && !empty($_GET['admin']))
	{
	
		$read_permissions = new ConfigMagik("engine/servers/".$_COOKIE["server"]."/".$_GET['admin']."/permissions.ini");
		$read_permissions->PROCESS_SECTIONS = false;
		$read_permissions->PROTECTED_MODE   = false;
		$read_permissions->SYNCHRONIZE      = true;
	
	
		$count = 0;
		echo "<form action=\"\" method=\"POST\" >";
	
		?>
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
		<tr>
			<td align="center" class="panel_title" colspan="2">Admin Permissions for "<?php echo htmlspecialchars($_GET['admin']); ?>"</td>
		</tr>
		<tr> 
			<td align="left" width="33%" class="panel_title_sub2">Module</td>
			<td align="center" width="33%" class="panel_title_sub2">Permissions</td> 
		</tr> 
		<?php

		$directory = opendir('modules');
		while ($module_file = readdir($directory))
		{
			if ($module_file != "." && $module_file != ".." && $module_file != '.htaccess' && $module_file != 'home.php' && $module_file != 'left_side.php' && $module_file != 'header.php' && $module_file != 'module_action.php')
			{
				$module_name = explode('_', $module_file);
				$module_name2 = explode('.php', $module_name[0].' '.$module_name[1].' '.$module_name[2].' '.$module_name[3].' '.$module_name[4]);
				
				$count++;
				$tr_color = ($count % 2) ? '' : 'even';
				
				echo "<tr class='" . $tr_color . "' >";
					echo "<td align='left' class='panel_text_alt_list'>".htmlspecialchars(ucfirst($module_name2[0]))."</td>";
					echo "<td align='center' class='panel_text_alt_list'>";
					
					$module_file2 = str_replace('.', '_', $module_file);	
					
					echo "<select name='".$module_file2."'>";
						
							switch ($read_permissions->get($module_file2, ''))
							{
								case 'no_access':
									echo '<option value="no_access" selected>No Access</option>
									      <option value="read">Read Access</option>
										  <option value="write">Read & Write Access</option>';
									break;
								case 'read':
									echo '<option value="no_access">No Access</option>
									      <option value="read" selected>Read Access</option>
										  <option value="write">Read & Write Access</option>';
									break;
								case 'write':
									echo '<option value="no_access">No Access</option>
									      <option value="read">Read Access</option>
										  <option value="write" selected>Read & Write Access</option>';
									break;
								default:
									echo '<option value="no_access" selected>No Access</option>
									      <option value="read">Read Access</option>
										  <option value="write">Read & Write Access</option>';
									break;
									
							}
					echo "</select></td>";				
				
			
			}
		}
		echo '<tr><td align="right" class="panel_buttons" colspan="2"><input type="hidden" name="admin" value="'.htmlspecialchars($_GET['admin']).'"><input type="submit" value="Save Permissions"></td></tr>';
				
		echo '</table></form>';
	}
	else
	{
		echo '<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
				<tr>
					<td class="cat"><div align="left"><b>ERROR</b></div></td>
				</tr>
				<tr>
					<td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>You did not select an admin.</p>
				</td> 
				</tr>
			</table>';		
	}
}
?>