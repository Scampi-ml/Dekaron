	    <div style='padding: 65px 30px 20px 30px;'>
Dekaron Server:
<?
Error_reporting(0);
$fp = @fsockopen('216.245.200.242', 7880, $errno, $errstr, 2);
if($fp){ echo '<font color=green>Online</font>'; }
else{ echo '<font color=red>Offline</font>'; }
fclose($fp);
?>
<br>
Login Server:
<?
Error_reporting(0);
$fp = @fsockopen('216.245.200.242', 50005, $errno, $errstr, 2);
if($fp){ echo '<font color=green>Online</font>'; }
else{ echo '<font color=red>Offline</font>'; }
fclose($fp);
?>
	    </div>

