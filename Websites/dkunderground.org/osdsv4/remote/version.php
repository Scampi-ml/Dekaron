<?php
$url = 'http://osds.googlecode.com/svn/';
require_once("phpsvnclient.php");

$phpsvnclient = new phpsvnclient($url);

	
	
$version = $phpsvnclient->getFileVersion('/trunk/');
echo $version;
?>