<?php
$table = '';
$GET_IP = $_GET['ip'];
include("engine/class_iplookup.php");

$ipology = new ipology(array($GET_IP));
$out = $ipology->out();

if(is_array($out[$GET_IP]))
{
	
	$count = 0;

	foreach($out[$GET_IP] as $tag=>$val)
	{
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';		
		$table .= '<tr class="' . $tr_color . '">
				<td align="left" class="panel_title_sub2"><b>' . ucfirst($tag) . '</b></td>
				<td class="panel_text_alt_list">';
					if (is_array( $val ))
					{
						$table .= implode('<br>',$val);
					}
					else
					{
						$table .= $val;
					}
		$table .= '</td></tr>';
	}
}
else
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No data found</td></tr>';
}
$smarty->assign("TABLE", $table);
?>
   