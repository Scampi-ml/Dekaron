<?php 

// -----------------------------------
// load all settings from config
// -----------------------------------
$server_info_disk = $Config->get('server_info_disk', 'GENERAL');
$server_info_disk_bar = $Config->get('server_info_disk_bar', 'GENERAL');
$server_info_time = $Config->get('server_info_time', 'GENERAL');
$server_info_cpu = $Config->get('server_info_cpu', 'GENERAL');
$server_info_cpu_bar = $Config->get('server_info_cpu_bar', 'GENERAL');


if($server_info_disk == 'true')
{
	function ZahlenFormatieren($Wert)
	{
		if ($Wert > 1099511627776)
		{
			$Wert = number_format($Wert / 1099511627776, 2, ".", ",") . " TB";
		} elseif ($Wert > 1073741824)
		{
			$Wert = number_format($Wert / 1073741824, 2, ".", ",") . " GB";
		} elseif ($Wert > 1048576)
		{
			$Wert = number_format($Wert / 1048576, 2, ".", ",") . " MB";
		} elseif ($Wert > 1024)
		{
			$Wert = number_format($Wert / 1024, 2, ".", ",") . " kB";
		}
		else
		{
			$Wert = number_format($Wert, 2, ".", ",") . " Bytes";
		}
	
		return $Wert;
	}


	$frei = disk_free_space("./");
	$insgesamt = disk_total_space("./");
	$belegt = $insgesamt - $frei;
	$prozent_belegt = 100 * $belegt / $insgesamt;
	
	echo 'Server Space<br>';
	echo '<b>In Use:</b> <span id="inuse">' . ZahlenFormatieren($belegt) . '</span> (<span id="inusepercent">' . round($prozent_belegt,"2") . '</span> %)';
	echo '<br>';
	if ($server_info_disk_bar == 'true')
	{
		echo '<img src="bar.php?rating=' .  round($prozent_belegt,"2") . '" border="0" name="diskpercent" id="diskpercent"><br>';
	}
	echo '<b>Free Space:</b> <span id="freespace">' .  ZahlenFormatieren($frei) . '</span><br>';
	echo '<b>Disk Space:</b> <span id="diskspace">' . ZahlenFormatieren($insgesamt) . '</span>';
	echo '<br /><br>';
}

if ($server_info_time == 'true')
{
?>
<script type="text/javascript">
	function getthedate(){ 
		var mydate=new Date(); 
		var hours=mydate.getHours(); 
		var minutes=mydate.getMinutes(); 
		var seconds=mydate.getSeconds(); 
		var dn="AM"; 
		if (hours>=12) dn="PM"; 
		if (hours>12) hours=hours-12;        
		if (hours==0) hours=12; 
		if (hours<=9) hours="0"+hours; 
		if (minutes<=9) minutes="0"+minutes; 
		if (seconds<=9)    seconds="0"+seconds; 
		

		var cdate="<span><b>Local Time:</b></span> &nbsp;&nbsp;&nbsp;<span >"+hours+":"+minutes+":"+seconds+" "+dn+"</span><BR>";
		if (document.all) 
			document.all.clock.innerHTML=cdate; 
		else if (document.getElementById) 
			document.getElementById("clock").innerHTML=cdate; 
		else 
			document.write(cdate); 
		setTimeout("getthedate()",1000); 
	} 
	if (!document.all&&!document.getElementById) { getthedate(); js_clock(); }

	function goforit(){ 
		if (document.all||document.getElementById) {
			setTimeout("getthedate()",1000); 
			js_clock();
		}
	}
	var clock_hours = <?php echo date("G"); ?>;
	var clock_minutes = <?php echo date("i"); ?>;
	var clock_seconds = <?php echo date("s"); ?>;
	function js_clock(){
		clock_seconds++;
		if (clock_seconds == 60) {
			clock_seconds = 0;
			clock_minutes++;
			if (clock_minutes == 60) {
				clock_minutes = 0;
				clock_hours++;
				if (clock_hours == 24) {
					clock_hours = 0;
				}
			}
		}
		var disp_minutes = clock_minutes;
		var disp_seconds = clock_seconds;
		var disp_hours = clock_hours;
		var clock_suffix = "AM";
		if (clock_hours > 11){
			clock_suffix = "PM";
			disp_hours = disp_hours - 12;
		}
		if (disp_hours == 0){
			disp_hours = 12;
		}
		if (disp_hours < 10){
			disp_hours = "0" + disp_hours;
		}
		if (clock_minutes < 10){
			disp_minutes = "0" + disp_minutes;
		}
		if (clock_seconds < 10){
			disp_seconds = "0" + disp_seconds;
		}
		var clock_div = document.getElementById('server');
		clock_div.innerHTML = "<span><b>Server Time:</b></span> &nbsp;&nbsp;&nbsp;<span >" + disp_hours + ":" + disp_minutes + ":" + disp_seconds + " " + clock_suffix+"</span><BR>";
		setTimeout("js_clock()", 1000);
		}
	window.onload=goforit; 
</script>
<?php
	echo '<span id="server"></span>';
	echo '<span id="clock"></span>';
}


if (PHP_OS == "WINNT")
{
	$os = "windows";
	$osbuild = php_uname('v');
} elseif (PHP_OS == "Linux")
{
	$os = "linux";
	$osbuild = php_uname('r');
}
else
{
	$os = "nocpu";
	$osbuild = php_uname('r');
}

if ($server_info_cpu == 'true')
{

	if (PHP_OS == "WINNT")
	{
		$os = "windows";
		$osbuild = php_uname('v');
	} elseif (PHP_OS == "Linux")
	{
		$os = "linux";
		$osbuild = php_uname('r');
	}
	else
	{
		$os = "nocpu";
		$osbuild = php_uname('r');
	}

    if ($os == "windows")
    {
        $wmi = new COM("Winmgmts://");
        $cpus = $wmi->execquery("SELECT * FROM Win32_Processor");
		echo '<br>';
        echo '<b>CPU Load: </b>';
        foreach ($cpus as $cpu)
        {
            echo "" . $cpu->loadpercentage . "%<br />";
			if ($server_info_cpu_bar == 'true')
			{
				echo '<img src="bar.php?rating=' . round($cpu->loadpercentage, "2") . '" border="0">';
			}
        }
		echo "<br>";
		
    } elseif ($os == "linux")
    {
		echo "Fucking linux!";
		
    } elseif ($os == "nocpu")
    {
        echo "WTF? NO CPU FOUND? What kinda crap server your using ? ";
    }
    else
    {
        echo "CPU Load: There Was An Error.<br>";
    }
}

?>