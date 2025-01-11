<?php
date_default_timezone_set("Europe/Paris");


$hour_now = date('H');

if($hour_now == '00'){$next = '02';}
if($hour_now == '01'){$next = '02';}
if($hour_now == '02'){$next = '04';}
if($hour_now == '03'){$next = '04';}
if($hour_now == '04'){$next = '06';}
if($hour_now == '05'){$next = '06';}
if($hour_now == '06'){$next = '08';}
if($hour_now == '07'){$next = '08';}
if($hour_now == '08'){$next = '10';}
if($hour_now == '09'){$next = '10';}
if($hour_now == '10'){$next = '12';}
if($hour_now == '11'){$next = '12';}
if($hour_now == '12'){$next = '14';}
if($hour_now == '13'){$next = '14';}
if($hour_now == '14'){$next = '16';}
if($hour_now == '15'){$next = '16';}
if($hour_now == '16'){$next = '18';}
if($hour_now == '17'){$next = '18';}
if($hour_now == '18'){$next = '20';}
if($hour_now == '19'){$next = '20';}
if($hour_now == '20'){$next = '22';}
if($hour_now == '21'){$next = '22';}
if($hour_now == '22'){$next = '24';}
if($hour_now == '23'){$next = '24';}

$wartime = (mktime($next, 0, 0) - time());

?>
<span id='nationwarx1500'>Dead Front</span>


<script type="text/javascript">

countdown_x1500 = <?php print $wartime; ?>;

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
}
else
{ dd_x1500 = 0; }

if (ss_x1500 < 10) { ss_x1500 = "0"+ss_x1500; }
if (mm_x1500 < 10) { mm_x1500 = "0"+mm_x1500; }
if (hh_x1500 < 10) { hh_x1500 = "0"+hh_x1500; }
if (dd_x1500 == 0)
{ return ("&nbsp;&nbsp;&nbsp;"+hh_x1500+" hours&nbsp;&nbsp;&nbsp;"+mm_x1500+" minutes&nbsp;&nbsp;&nbsp;"+ss_x1500+" seconds"); }
else
{
if (dd_x1500 > 1)
{ return (dd_x1500+" days "+hh_x1500+"hrs "+mm_x1500+"mins "+ss_x1500+"secs"); }
else
{ return (dd_x1500+" day "+hh_x1500+"hrs "+mm_x1500+"mins "+ss_x1500+"secs"); }
}
}

function do_cd_x1500()
{
document.getElementById('nationwarx1500').innerHTML = "<b>Next Dead Front In: " + convert_to_time_x1500(countdown_x1500) + "</b></span>";
setTimeout('do_cd_x1500()', 1000);
countdown_x1500 = countdown_x1500 - 1;
}

do_cd_x1500();

</script>

