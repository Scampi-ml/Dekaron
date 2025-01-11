<?php
$data = '';
$tpl = '';
$data .= '<form name="navigation" style="float:right;"><select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value">';
	$data .= '<option>-------------</option>';
	if ( $handle = @opendir( "modules_settings" ) )
	{
		while ( ( $file = readdir( $handle ) ) !== false )
		{
			if ( preg_match( "#^settings_(.*).php\$#i", $file, $matches ) )
			{
				$file_name = @explode('_', $file);
				$file_name2 = @explode('.php', $file_name[1].' '.$file_name[2].' '.$file_name[3].' '.$file_name[4]);
				$data .= '<option value="index.php?get=module_settings&php=' . $file . '">'.ucfirst($file_name2[0]).'</option>';
			}
		}
		closedir( $handle );
	}
$data .= '</select></form>';


if(isset($_GET['php']))
{
	if(file_exists('modules_settings/'.$_GET['php']))
	{
		require ('modules_settings/'.$_GET['php']);
		$file = explode('.php',$_GET['php']);
		$tpl = '1';
		$smarty->assign("file", $file[0]);
	}
}

$smarty->assign("DATA", $data);
$smarty->assign("tpl", $tpl);
?>