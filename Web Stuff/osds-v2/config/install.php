<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>OsDs V2 Beta 1 Install Wizard</title>
		<style type="text/css" media="all">
			html, body, h1, h2, h3, h4, div, p, dl { margin: 0; padding: 0; }
			body { background: #021e2c; color: #fff; font-size: 12px; font-family: Verdana, Arial, "Trebuchet MS", "Times New Roman"; width: 800px; margin: auto; }
			h1, h2, h3, h4 { font-weight: normal; }
			a { color: #444; text-decoration: none; } a:hover { text-decoration: underline; }
			#header { background: #021e2c; padding: 20px; color: #f1f1f1; font-size: 22px; border-bottom: 1px solid #222; }
			#fileInfo { background: #f1f1f1; padding: 20px; border-top: 1px solid #fff; border-bottom: 1px solid #222; -moz-border-radius: 10px; -webkit-border-radius: 10px; }
			#fileInfo h3 { font-size: 16px; color: #444; padding: 0 0 3px 0; margin: 0 0 3px 0; border-bottom: 1px solid #999; letter-spacing: -0.5px; }
			#fileInfo dl { color: #444; margin-bottom: 10px; }
			#fileInfo dt, dd { padding: 3px 0; border-bottom: 1px solid #e1e1e1; }
			#fileInfo dt { float: left; font-weight: bold; }
			#fileInfo dd { text-align: right; }
			#fileInfo p { color: #444; }
			#content { padding: 20px; }
			#content h3 { font-size: 16px; padding: 0 0 5px 0; margin: 0 0 5px 0; border-bottom: 1px solid #03283a; }
			#content p { margin: 0 0 40px 0; }
			#content span { float: right; }
			#content a { color: #fff; text-decoration: underline; }
			#content .collapsed { display: none; }
			#cr { position: fixed; bottom: 20px; right: 20px; color: #818f96; }
			#cr a { color: #818f96; }
		</style>
		<noscript>
			<style type="text/css" media="all">
				#content .collapsed { display: block; }
				#content .toggleLink { display: none; }
			</style>
		</noscript>
	</head>
	<body>
		<div id="header">OsDs V2 Beta 1 R151009 Install Wizard</div>
		<div id="fileInfo">
			<h3>General Information</h3>
			<dl>
				<dt>Title:</dt>
					<dd>OsDs V2 Beta 1 R151009</dd>
				<dt>Version:</dt>
					<dd>V2 (R151009)</dd>
			  <dt>Resource Type:</dt>
					<dd>Conplete Install of OsDs</dd>
				<dt>Requirements:</dt>
					<dd>MSSQL, PHP, APACHE</dd>
				<dt>Author:</dt>
					<dd>Janvier123</dd>
				<dt>Website:</dt>
					<dd><a href="http://www.elitepvpers.de/forum/2moons-pserver-hosting/339168-release-osds-control-panel.html">[Release] OsDs Control Panel </a></dd>
			</dl>
		  <h3>Description</h3>
			<p>OsDs is a fully working PHP script site that can manage almost all of you mssql editing need without going into the mysql database itself. This script is written by janvie123 for the elitepvp community. The script can have some bugs and/or scripts not working, please report all errors, comments, etc on <a href="http://www.elitepvpers.de/forum/2moons-pserver-hosting/339168-release-osds-control-panel.html"><em>epvp.</em></a> I do not give out support for modifications that your apply'ed to it. And i would like to give out a THX to zombe for helping me out sometimes. Have fun with the script and dont forget to leave a &quot;THANKS&quot; on the epvp forums.</p>
	</div>
		<div id="content">
			<h3><?php
if ($_GET['step'] == ""){
echo "Please fill in your MSSQL info, so we can start with the install.</h2>";
echo "This info will be added into the <b>mssql.conf.php</b> so you dont have too.";
echo '<form action="install.php?step=1" method="post">
MSSQL Host:<br>
<input type="text" name="host"/><br/><br/>
MSSQL Username: <br>
<input type="text" name="user"/><br/><br/>
MSSQL Password: <br>
<input type="password" name="pw"/><br/><br/>
<input type="submit" value="OK, ive added my info, begin install." />
</form>';
} else if ($_GET['step'] == "1"){

$content = "<?php
// MSSQL Database Info
// this info is written by install.php
// this is the main config file for
// mssql server, edit when needed


\$mssql = array(
				'host' => \"".$_POST['host']."\",
				'user' => \"".$_POST['user']."\",
				'pass' => \"".$_POST['pw']."\"
				);
?>";
$filename = "mssql.conf.php";
$handle = fopen($filename, 'r+');
if (fwrite($handle, $content) === FALSE) {
       echo "Cannot write to file {$filename}";
	   exit;
	  }
	  fclose($handle);
	  define(ALLOW_OPEN, 1);
@include("mssql.conf.php");
$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
mssql_select_db("character");
mssql_query("ALTER TABLE [user_character] ADD [Reborn] [smallint] DEFAULT(0) NOT NULL");
echo "IF you see this message without any errors, it means everyhting went ok<br>";
echo "and i've added the <b>Reborn</b> to user_character for the reborn system.<br>";
echo "You are now ready to enter OsDs Gm Control Panel. <br><br>";

echo "And ... i've deleted the install.php for your safty, but .... just to be safe, you better take a look.";
unlink("install.php");
}
?></h3>
			<div id="cr">
				No-Copyright &copy; 2009 
<a href="http://www.elitepvpers.de/forum/2moons-pserver-hosting/339168-release-osds-control-panel.html">OsDs</a>			</div>
		</div>
	</body>
</html>