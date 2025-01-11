<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>OSDS V5 | Dekaron Control Panel</title>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="./style.css" media="all" rel="stylesheet" type="text/css" />
<script src="./js/jquery-1.2.6.pack.js" type="text/javascript"></script>
<!--[if lt IE 7]>
       <script type="text/javascript" src="./js/supersleight-min.js"></script>
       <script type="text/javascript" src="./js/jquery.dropdown.js"></script>
       <style type="text/css" media="screen">
       @import url("http://theme.idowebdesign.ca/immaculee/blue/ie6.css");
           
    	</style>
        
	<![endif]-->
<script type="text/javascript">
    
	$(function() {
		$("body").addClass("has-script");
       
    });
	
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

function formatbytes($size)
{
	$units = array('B', 'KB', ' MB', 'GB', 'TB');
	for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
	return round($size, 2).$units[$i];
}
?>

<body>
<div id="container">
  <!-- header -->
  <div id="header">
    <h1><a href="index.php"></a></h1>
  </div>
  <?php include ('menu.php'); ?>
  <div id="subbar" class="clearfix">
    <h1>Download</h1>
  </div>
  <!-- end mainbar -->
  <div id="content" class="page clearfix">
    <div id="main">
      <div class="block">
             <table width="100%" border="0" cellspacing="3" cellpadding="3">
              <tr>
                <td><strong>Code license</strong></td>
                <td>GNU GPL v3</td>
              </tr>
              <tr>
                <td><strong>Version</strong></td>
                <?php $remote_version = file_get_contents('http://users.telenet.be/osds/version.txt'); ?>
                <td><?php echo $remote_version; ?> (<a href="changelog.php">Changelog</a>)</td>
              </tr>
            </table>
            <br />
            <br />
			<center>
			<a class="ordernow" href="http://users.telenet.be/osds/install.exe"><center>Download now</center></a>
            <br />
            <br />
            <a class="ordernow" href="http://osds.dkunderground.org/docs/Installation.html"><center>Install Guide</center></a>
			</center>
      </div>
    </div>
    <?php include ('side.php'); ?>
  </div>
</div>
<!-- end content -->
</div>
<!--end container-->
</body>
</html>
