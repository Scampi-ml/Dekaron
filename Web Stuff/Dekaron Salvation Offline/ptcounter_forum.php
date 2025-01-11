<?php
date_default_timezone_set("America/Los_Angeles");


$hour_now = date('H');

if($hour_now == '00'){$next = '03';}
if($hour_now == '01'){$next = '03';}
if($hour_now == '02'){$next = '03';}
if($hour_now == '03'){$next = '07';}
if($hour_now == '04'){$next = '07';}
if($hour_now == '05'){$next = '07';}
if($hour_now == '06'){$next = '07';}
if($hour_now == '07'){$next = '11';}
if($hour_now == '08'){$next = '11';}
if($hour_now == '09'){$next = '11';}
if($hour_now == '10'){$next = '11';}
if($hour_now == '11'){$next = '15';}
if($hour_now == '12'){$next = '15';}
if($hour_now == '13'){$next = '15';}
if($hour_now == '14'){$next = '15';}
if($hour_now == '15'){$next = '19';}
if($hour_now == '16'){$next = '19';}
if($hour_now == '17'){$next = '19';}
if($hour_now == '18'){$next = '19';}
if($hour_now == '19'){$next = '23';}
if($hour_now == '20'){$next = '23';}
if($hour_now == '21'){$next = '23';}
if($hour_now == '22'){$next = '23';}
if($hour_now == '23'){$next = '03';}

$wartime = (mktime($next, 0, 0) - time());

?>
<span id='nationwarx1'></span>


<script type="text/javascript">

countdown_x1 = <?php print $wartime; ?>;

function convert_to_time_x1(secs_x1500)
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
{ return (hh_x1500+"h "+mm_x1500+"m "+ss_x1500+"s"); }
else
{
if (dd_x1500 > 1)
{ return (dd_x1500+" days "+hh_x1500+"hrs "+mm_x1500+"mins "+ss_x1500+"secs"); }
else
{ return (dd_x1500+" day "+hh_x1500+"hrs "+mm_x1500+"mins "+ss_x1500+"secs"); }
}
}

function do_cd_x1()
{
  if (countdown_x1 < 0)
  {
    document.getElementById('nationwarx1').innerHTML = "<b><span style='color: red;'>Party Match: Started!</span></b>";
  }
  else
  {
    document.getElementById('nationwarx1').innerHTML = "<b>Party Match:</b> " + convert_to_time_x1(countdown_x1);
    setTimeout('do_cd_x1()', 1000);
  }
  countdown_x1 = countdown_x1 - 1;
}
do_cd_x1();

</script>

