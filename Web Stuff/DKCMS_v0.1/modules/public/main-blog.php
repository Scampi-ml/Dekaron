<?php 

echo "
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
	<tr>
        <td>
            <span style='float: left;'>
				<a href='?dkcms=main&amp;page=gmblog'>
					<img class='main_title' border='0' src='$styledir/images/gm_title.gif' alt='more' />
				</a>
			</span>
            <span style='float: right; padding-top: 3px; line-height: 10px;'>
				<a href='?dkcms=main&amp;page=gmblog'>More</a>
			</span>
        </td>
    </tr>
    <tr>
		<td height='1' />
	</tr>
	<tr>
		<td style='background-color:#b8b8b8;' height='3' />
	</tr>
	<tr>
		<td height='4' />
	</tr>
	<tr>
		<td width='200'>";
	$i = 0;
	$gb = mssql_query("SELECT TOP 4 * FROM dkcms.dbo.dkcms_gmblog ORDER BY id DESC");
	while($b = mssql_fetch_array($gb)){
		$title = $b['title'];
		$maxlength = 33;
		echo "
			<table style='width: 100%; height: 100%;' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td width='5%' />
					<td width='85%'>
						<img src='images/gm_arrow.gif' width='7' height='5' alt='arrow' /> 
						[".$b['date']."] 
						[".$b['author']."]
						<a href='?dkcms=main&amp;page=gmblog&amp;id=".$b['id']."'>";
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
					<td style='background:url(".$styledir."/images/bbs_line_02.gif) repeat-x; width:100%; height:7px;' colspan='3' />
				</tr>
			</table>";
			$i++;
			}
		if($i == 0) {
			echo "<tr><td align='center'>There are currently no GM Blogs.</td></tr>";
		}
		echo "
		</td>
	</tr>
</table>";

?>