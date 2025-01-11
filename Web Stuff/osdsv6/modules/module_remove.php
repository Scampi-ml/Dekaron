<?php
if (isset($_POST['module_remove']))
{
	if (empty($_POST['m_file']))
	{
		echo notice_message_admin('Please select a file', '0', '1', '0');
	}
	else
	{
		$addon_file = $_POST['m_file'];
		
		include ('modules_addon/'.$addon_file);
		
		$above_current = dirname(dirname(__FILE__))."/";
		
		
		if(file_exists($above_current. 'engine/config_mods/'.$addon_config))
		{
			unlink($above_current . 'engine/config_mods/'.$addon_config);
		}
		
		if(file_exists($above_current . 'nav/'.$addone_nav))
		{
			unlink($above_current . 'nav/'.$addone_nav);
		}
		
		if(file_exists($above_current .'engine/'.$addon_function))
		{
			unlink($above_current.'engine/'.$addon_function);
		}
		
		if(count($addon_files) != '0')
		{
			foreach($addon_files as $file)
			{
				unlink($above_current . $file);
			}
		}
		
		if(file_exists($above_current .'modules/'.$addon_module))
		{
			unlink($above_current .'modules/'.$addon_module);
		}
		
		if(file_exists($above_current .'modules_addon/'.$addon_file))
		{
			unlink($above_current .'modules_addon/'.$addon_file);
		}
		echo notice_message_admin('PHP File Module successfully removed', 0, 0, 'index.php?get=module_remove');
	}
}
else
{
?>
<form action="" method="POST" name="module">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
    	<td align="center" class="panel_title" colspan="2">Remove PHP File Module</td>
    </tr>
    <tr>
    	<td align="left" class="panel_title_sub" colspan="2">Module PHP File</td>
    </tr>
    <tr>
        <td align="left" class="panel_text_alt1" width="50%">Choose PHP file you want to remove.</td>
        <td align="left" class="panel_text_alt2" width="50%">
            <select name="m_file">
                <option value="0" selected="selected">Choose a File</option>
                        <optgroup label="---------------">
                			<?php
                            $directory = opendir('modules_addon/');
                            while ($modfile = readdir($directory))
							{
                                if ($modfile != "." && $modfile != ".." && $modfile != 'index.html')
								{
                                    echo '<option value="' . $modfile . '">' . $modfile . '</option>';
                                }
                            }
                            ?>
			</select>
        </td>
    </tr>
    <tr>
        <td align="center" class="panel_buttons" colspan="2">
        <input type="hidden" name="module_remove">
        <input type="submit" value="Delete Module" onclick="return ask_form('All module data and settings will be removed \nAre you sure you want to remove this module?')">
    	</td>
    </tr>
</table>
</form>
<?php
}
?>
