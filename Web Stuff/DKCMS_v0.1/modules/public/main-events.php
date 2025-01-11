<?php 

echo "
	<table width='100%' border='0' cellpadding='0' cellspacing='0'>		
		<tr>
			<td>
				<span style='float: left;'>
					<a href='?dkcms=main&amp;page=events'>
						<img src='$styledir/images/event_title.gif' alt='Events' />
					</a>
				</span>
				<span style='float: right; padding-top: 3px; line-height: 10px;'>
					| <a href='?dkcms=main&amp;page=events'>More</a>
				</span>
			</td>
		</tr>
		<tr>
			<td style='background-color:#b8b8b8;' height='3' />
		</tr>
		<tr>
			<td height='4' />
		</tr>";
	
	$i = 0;
	$ge = mssql_query("SELECT TOP 4 * FROM dkcms.dbo.dkcms_events ORDER BY id DESC ");
	while($e = mssql_fetch_array($ge)){
		$title = $e['title'];
		$maxlength = 33;
		echo "
		<tr>
			<td>
				<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td>
							<img src='images/".$e['type'].".gif' class='absmiddle' alt='".$e['type']."' />
							[".$e['date']."]
							<a href='?dkcms=main&amp;page=events&amp;id=".$e['id']."'>";
		if(strlen($title) > $maxlength){
			echo shortTitle($title);
		}else{
			echo $title;
		}
		echo "
							</a>
						</td>
					</tr>
					<tr>
						<td style='background:url(".$styledir."/images/bbs_line_02.gif) repeat-x; width:100%; height:7px;' colspan='2' />
					</tr>
				</table>
			</td>
		</tr>";
		$i++;
}
		if($i == 0) {
			echo "<tr><td align='center'>There are currently no events.</td></tr>";
		}
	echo "
	</table>";
?>