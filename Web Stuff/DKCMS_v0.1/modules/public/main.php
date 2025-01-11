<?php 

if(isset($_GET['page'])){
	$main = $_GET['page'];
}else{
	$main = "";
}
	if($getdkcms == "main"){
		if($main == ""){
			echo '
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" width="287">';
			include ("modules/public/main-news.php");
			echo '
								</td>
								<td valign="top" width="11" />
								<td valign="top" width="284">';
			include ("modules/public/main-events.php");
			echo '
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="15" />
				</tr>
				<tr>
					<td align="center">
						<a href="'.$mblink.'">
							<img src="'.$mbanner.'" />
						</a>
					</td>
				</tr>
				<tr>
					<td height="15" />
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" width="279">';			
			include ("modules/public/main-rank.php");
			echo '
								</td>
								<td width="12" />
								<td valign="top" width="284">';
			include ("modules/public/main-blog.php");
			echo'
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="15" />
				</tr>
			</table>';
		}elseif($main == "download"){
			include('modules/public/download.php');
		}elseif($main == "events"){
			include('modules/public/events.php');
		}elseif($main == "gmblog"){
			include('modules/public/gmblog.php');
		}elseif($main == "news"){
			include('modules/public/news.php');
		}elseif($main == "events"){
			include('modules/public/events.php');
		}elseif($main == "ranking"){
			include('modules/public/ranking.php');
		}elseif($main == "register"){
			include('modules/public/register.php');
		}
	}else{
		header("Location: ?dkcms=main");
	}
?>