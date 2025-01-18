<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
    	<td align="right" class="panel_buttons" colspan="1"><b>Select a setting</b>&nbsp;&nbsp;
			<?php
            	echo '<form name="navigation" style="float:right;"><select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value">';
					echo '<option>-------------</option>';
					if ( $handle = @opendir( "modules_settings" ) )
					{
						while ( ( $file = readdir( $handle ) ) !== false )
						{
							if ( preg_match( "#^settings_(.*).php\$#i", $file, $matches ) )
							{
								$file_name = explode('_', $file);
								$file_name2 = explode('.php', $file_name[1].' '.$file_name[2].' '.$file_name[3].' '.$file_name[4]);
								echo '<option value="index.php?get=module_settings&php=' . $file . '">'.ucfirst($file_name2[0]).'</option>';
							}
						}
						closedir( $handle );
					}
            	echo '</select></form>';
            ?>
		</td>
    </tr>
</table>
<br>

<?php 	
if(isset($_GET['php']))
{
	if(file_exists('modules_settings/'.$_GET['php']))
	{
		require ('modules_settings/'.$_GET['php']);
	}
	else
	{
		echo '<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
				<tr>
					<td class="cat"><div align="left"><b>ERROR</b></div></td>
				</tr>
				<tr>
					<td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>Setting <b>'.$_GET['php'].'</b> could not be found.</p>
				</td> 
				</tr>
			</table>';		
	}
}
?>