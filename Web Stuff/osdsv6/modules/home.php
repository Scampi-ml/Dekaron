<?php
$core['current_version'] = file_get_contents('engine/version.txt');
$core['new_version'] = file_get_contents('http://users.telenet.be/osds/version.js');
?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">DAC Version</td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">Current version</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Your current version.</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $core['current_version']; ?></b></td>
	</tr>
</table>


<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
		<td align="center" class="panel_title" colspan="2">About Dekaron Admin Control</td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">Important Information</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">
        </td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">Links</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">
        <ul>
        	<li><a href="">Official Support</a></li>
            <li><a href="">Bug Reports</a></li>
            <li><a href="">Addons</a></li>
        </ul>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">&nbsp;</td>
	</tr>
</table>



<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" style="margin-top: 20px;">
    <tr>
    	<td align="center" class="panel_title" colspan="2">DAC News</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Title</td> 
        <td align="left" class="panel_title_sub2">Date</td> 
	</tr> 
	<?php
		require_once( "engine/class_rssfeed.php" );
		$rss = new lastRSS( );
		$rss->cache_dir = "temp";
		$rss->cache_time = 1200;
		$rss->cp = "US-ASCII";
		$rss->date_format = "l";
		$rssurl = "http://www.dkunderground.org/forums/rss/forums/3-annoucements/";
		$count_rss = 0;
		flush_this();
		$count = 0;
		
		if ( $rs = $rss->get( $rssurl ) )
		{
			foreach ( $rs["items"] as $item )
			{
				$count++;
				$count_rss++;
				$tr_color = ($count % 2) ? '' : 'even';
				echo "<tr class='" . $tr_color . "' >";
					echo "<td align='left' class='panel_text_alt_list'><a href='".$item["link"]."' target='_blank'>".$item["title"]."</a></td>";
					echo "<td align='right' class='panel_text_alt_list'>".$item["pubDate"]."</a></td>";
					
				echo "</tr>";
			}
		}
		else
		{
			echo "<tr><td align='center' class='panel_text_alt_list'>Error: Not possible to get rss</tr></td>";
		}
		?>
</table>