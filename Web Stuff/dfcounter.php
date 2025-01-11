<html>
<head>
<title>Evo DF Timer</title>


<style type="text/css">
<!--
.style1 {font-size: 36px}
-->
</style>
<div align="center">
<br><br>
The Dead Front timer is currently having some problems due to some changes in configuration. We will address it in the next update.
<span class="style1">
<br /><br /><br /><br />
<?php

date_default_timezone_set("America/Chicago");
$hour_wars = array(23, 03, 07, 11, 15, 19);
sort($hour_wars);
$hour_now = date('H');
$hour_next = 02;

foreach($hour_wars as $hour_war)
{
  if($hour_war > $hour_now)
  {
    $hour_next = $hour_war;
    break;
  }
}

$wartime = (mktime($hour_next, 0, 0) - time());
?>
<script type="text/javascript">
countdown_x1500 = <?php echo $wartime;?>;
function convert_to_time_x1500(secs_x1500)
{
  secs_x1500 = parseInt(secs_x1500);
  hh_x1500 = secs_x1500 / 3600;
  hh_x1500 = parseInt(hh_x1500);
  mmt_x1500 = secs_x1500 - (hh_x1500 * 3600);
  mm_x1500 = mmt_x1500 / 60;
  mm_x1500 = parseInt(mm_x1500);
  ss_x1500 = mmt_x1500 - (mm_x1500 * 60);

  if (hh_x1500 > 23)
  {
     dd_x1500 = hh_x1500 / 24;
     dd_x1500 = parseInt(dd_x1500);
     hh_x1500 = hh_x1500 - (dd_x1500 * 24);
  } else { dd_x1500 = 0; }

  if (ss_x1500 < 10) { ss_x1500 = "0"+ss_x1500; }
  if (mm_x1500 < 10) { mm_x1500 = "0"+mm_x1500; }
  if (hh_x1500 < 10) { hh_x1500 = "0"+hh_x1500; }
  if (dd_x1500 == 0) { return (hh_x1500+"h "+mm_x1500+"m "+ss_x1500+"s "); }
  else {
    if (dd_x1500 > 1) { return (dd_x1500+" days "+hh_x1500+" hours "+mm_x1500+" minutes"+ss_x1500+" seconds"); }
    else { return (dd_x1500+" day "+hh_x1500+" hours "+mm_x1500+" minutes "+ss_x1500+" seconds"); }
  }
  
  
}
function do_cd_x1500()
{
  if (countdown_x1500 < 0)
  {
    document.getElementById('nationwarx1500').innerHTML = "<b><span style='color: red;'>Deadfront is NOW!!</span></b><br>";
  }
  else
  {
    document.getElementById('nationwarx1500').innerHTML = "<b>" + convert_to_time_x1500(countdown_x1500) + " until the next deadfront ...</b><br>";
    setTimeout('do_cd_x1500()', 1000);
  }
  if (countdown_x1500 < 1200)
  {
  document.getElementById('nationwarx15002').innerHTML = "Get your ass to Chain or Fire!<br>";
  }
  else
  {
  document.getElementById('nationwarx15002').innerHTML = "";
  }
  
  if (countdown_x1500 < 300)
  {
  	document.getElementById('nationwarx15003').innerHTML = "Application Time has started!<br>";
  }
  else
  {
  	document.getElementById('nationwarx15003').innerHTML = "";
  }
  if (countdown_x1500 < 120)
  {
  	document.getElementById('nationwarx15004').innerHTML = "You have now 2 minutes to apply!<br>";
  }
  else
  {
  	document.getElementById('nationwarx15004').innerHTML = "";
  }
  if (countdown_x1500 < 60)
  {
  	document.getElementById('nationwarx15005').innerHTML = "You have now 1 minute to apply!<br>";
  }
  else
  {
  	document.getElementById('nationwarx15005').innerHTML = "";
  }


  
  countdown_x1500 = countdown_x1500 - 1;
}
document.write("<span id='nationwarx1500'></span>\n");
document.write("<span id='nationwarx15002'></span>\n");
document.write("<span id='nationwarx15003'></span>\n");
document.write("<span id='nationwarx15004'></span>\n");
document.write("<span id='nationwarx15005'></span>\n");


do_cd_x1500();
</script>
</div>
</span>