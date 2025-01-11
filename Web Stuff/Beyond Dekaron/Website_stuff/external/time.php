<?php 
date_default_timezone_set("Asia/Tbilisi");
$hour = (int)date("H", time());
$min = (int)date("i", time());
$sec = (int)date("s", time());
?>
<script type="text/javascript">
function clockon(hour, min, sec) {
	hours= hour
	minutes= min
	seconds= sec
	seconds++;
	if (seconds==60) {
		seconds = "0";
		minutes++;
	}
	if (minutes==60) {
		minutes = "0";
		hours++;
	}
	if (hours==24) hours = "0";
	if (eval(hours)<10) {hours="0"+hours}
	if (eval(minutes)<10) {minutes="0"+minutes}
	if (eval(seconds)<10) {seconds="0"+seconds}
	document.getElementById('txtTime').innerHTML= hours + ":" + minutes + ":" + seconds;
	setTimeout("clockon("+hours+","+minutes+","+seconds+")",1000);
}
</script>
<span name='txtTime' id='txtTime' class="lol"></span>
<script>clockon('<?php echo $hour; ?>', '<?php echo $min; ?>', '<?php echo $sec; ?>')</script>