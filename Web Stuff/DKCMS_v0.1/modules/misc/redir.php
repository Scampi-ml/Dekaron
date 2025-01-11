<?php 
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="cache-control" content="public" />
<meta http-equiv="content-language" content="en" />
<meta http-equiv="refresh" content="2;URL=index.php?dkcms=main" />
<title>Redirecting...</title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<style type="text/css">
html,body{
	height:100%;
}
body{
	width:100%;
	min-height:100%;
	margin:0;
	padding:0;
	color:#2C2C2C;
	font:normal 11px tahoma;
	background:#FFF;
}
table,input,select{
	font:normal 100% tahoma;
}
table{
	border-collapse:collapse;
}
a{
	color:#62707D;
}
.m{
	vertical-align:middle;
}
.l{
	text-align:left;
}
.c{
	text-align:center;
}
.w100{
	width:100%;
}
.h100{
	height:100%;
}
h1{
	font:bold 20px arial;
	margin:0;
}
h4{
	font:bold 12px arial;
	margin:0;
}
</style>
</head>
<body>
	<table class="w100 h100">
		<tr>
			<td class="c m">
				<table style="margin:0 auto;border:solid 1px ">
					<tr>
						<td class="l" style="padding:1px">
							<div style="width:346px;">
								<div style="padding:3px">
									<div style="padding:15px 30px 15px">
										You are now logged in as: '.$_SESSION['id'].'<br /><br />
										Please wait while we transfer you...
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';

?>