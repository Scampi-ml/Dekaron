<?php 

echo "
	<table width='100%' border='0' cellpadding='0' cellspacing='0'>				
		<tr valign='bottom'>
			<td>
				<span style='float: left;'>
					<a href='?dkcms=main&amp;page=news'>
						<img src='$styledir/images/notice_title.gif' alt='News' border='0' />
					</a>
				</span>
				<span style='float: right; padding-top: 3px; line-height: 10px;'>
					<a href='?dkcms=main&amp;page=news'>More</a>
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
	$gn = mssql_query("SELECT TOP 4 * FROM dkcms.dbo.dkcms_news ORDER BY id DESC");
	while($n = mssql_fetch_array($gn)){
		$title = $n['title'];
		$maxlength = 33;
		echo "
		<tr>
			<td>
				<table width='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td>
							<img src='images/".$n['type'].".gif' alt='".$n['type']."' class='absmiddle' />
							[".$n['date']."]
							<a href='?dkcms=main&amp;page=news&amp;id=".$n['id']."'>";
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
			echo "<tr><td align='center'>There are currently no news.</td></tr>";
		}

echo "
	</table>";
?>