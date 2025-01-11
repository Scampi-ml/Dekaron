<?php
// DF COUNTER
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
$smarty->assign("WARTIME", $wartime);

//echo $wartime .' - ' .$next . ' - ' .time() . ' - ' .$hour_now;
?>