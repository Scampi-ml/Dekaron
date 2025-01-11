<?php
if (isset($_POST['module_add']))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo notice_message_admin('Please select a file', '0', '1', '0');
	}
	elseif ($_FILES["file"]["type"] != 'application/zip')
	{
		echo notice_message_admin('This is not a valid ZIP file.', '0', '1', '0');
	}
	elseif($_FILES["file"]["size"] == '0')
	{
		echo notice_message_admin('Zip file is empty', '0', '1', '0');
	}	
	elseif (file_exists("upload/" . $_FILES["file"]["name"]))
    {
    	echo $_FILES["file"]["name"] . " already exists. ";
    }
	else
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], "cache/tmp/" . $_FILES["file"]["name"]);
		
		$zip_file = 'cache/tmp/'.$_FILES["file"]["name"];
		
		$above_current = dirname(dirname(__FILE__))."/";

		$zip = new ZipArchive;
		$res = $zip->open($zip_file);
		if ($res === TRUE)
		{
			$zip->extractTo($above_current);
			$zip->close();
		}
			 	
		unlink('cache/tmp/'.$_FILES["file"]["name"]);		
	}
	echo notice_message_admin('PHP File Module successfully installed', 0, 0, 'index.php?get=module_add');
}
else
{
?>
<form action="" method="POST" name="module" enctype="multipart/form-data">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
    	<td align="center" class="panel_title" colspan="2">Add PHP File Module</td>
    </tr>
    <tr>
    	<td align="left" class="panel_title_sub" colspan="2">Module PHP File</td>
    </tr>
    <tr>
        <td align="left" class="panel_text_alt1" width="50%">Choose zip file </td>
        <td align="left" class="panel_text_alt2" width="50%"><input type="file" name="file" id="file" /> </td>
    </tr>
    <tr>
    	<td align="left" class="panel_text_alt2" colspan="2">
        	<blink><font color="red"><b>Warning:</b></font></blink>
            <br> 
            All files (if exists) will be overwritten, resetting all settings.
            <br><br>
		</td>
    </tr>
    <tr>
        <td align="center" class="panel_buttons" colspan="2">
        <input type="hidden" name="module_add">
        <input type="submit" value="Add Module" >
    	</td>
    </tr>
</table>
</form>
<?php
}
?>