<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="5">Ip Lookup</td>
    </tr>
    <?php
	//$GET_IP = $_GET['ip'];
	$GET_IP = '87.151.11.189';
	include("engine/class_iplookup.php");
	
	$ipology = new ipology(array($GET_IP));
	$out = $ipology->out();
	
	if(is_array($out[$GET_IP]))
	{
		flush_this();
		$count = 0;
	
		foreach($out[$GET_IP] as $tag=>$val)
		{
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';		
			echo '<tr class="' . $tr_color . '">
					<td align="left" class="panel_title_sub2"><b>' . ucfirst($tag) . '</b></td>
					<td class="panel_text_alt_list">';
						if (is_array( $val ))
						{
							echo implode('<br>',$val);
						}
						else
						{
							echo $val;
						}
			echo '</td>
				</tr>';
		}
	}
	else
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No data found</td></tr>';
	}
  	?>
</table>    