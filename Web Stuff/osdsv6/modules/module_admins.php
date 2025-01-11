<?php
if (isset($_GET['delete']) && !empty($_GET['delete']))
{
	if($_GET['count'] == '1')
	{
		echo notice_message_admin('This is the only user in the server, you cannot delete this user.', '0', '1', 'index.php?get=module_admins');
	}
	else
	{
		rmdir($_GET['admin']);
		echo notice_message_admin('Admin successfully deleted', '1', '0', 'index.php?get=module_admins');
	}
}
else
{
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="2">Admins</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Account</td>
        <td align="left" class="panel_title_sub2">Action</td>  
	</tr> 
	<?php   
        flush_this(); 
        $count = 0;
		
		$directory = opendir('servers/'.$_SESSION["server"].'/');
		while ($admin = readdir($directory))
		{
			if ($admin != "." && $admin != ".." && $admin != 'logs' && $admin != 'index.html')
			{
				$count++;
				$tr_color = ($count % 2) ? '' : 'even';
				
				$tmp = explode(':', $val);
				
				echo "<tr class='" . $tr_color . "' >";
					echo "<td align='left' class='panel_text_alt_list' width='50%'>".htmlspecialchars($admin)."</td>";
					echo "<td align='left' class='panel_text_alt_list' width='50%'>";
					
					if(file_exists('servers/'.$_SESSION["server"].'/'.$admin.'/admin.txt')) 
					{
						echo "Main Admin (Cannot be edited)";
					}
					else
					{
						echo "
						<a href='index.php?get=module_admins&delete=".htmlspecialchars($admin)."&count=".$count."'>Delete</a>&nbsp;&nbsp;
						<a href='index.php?get=module_admin_permissions&admin=".htmlspecialchars($admin)."'>Permissions</a></td>";
					}
				echo "</tr>"; 					
			}
		}
    ?>
</table>
<?php
}
?>