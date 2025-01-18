<?php
$hour_wars = array(02, 04, 06, 08, 10, 12, 14, 16, 18, 20, 22, 24);
sort($hour_wars);
$hour_now = date('H');
$hour_next = 02;

foreach($hour_wars as $hour_war) {
  if($hour_war > $hour_now) {
    $hour_next = $hour_war;
    break;
  }
}

$wartime = (mktime($hour_next, 0, 0) - time());
?>

countdown_x100 = <?=$wartime;?>;
function convert_to_time_x100(secs_x100)
{
  secs_x100 = parseInt(secs_x100);
  hh_x100 = secs_x100 / 3600;
  hh_x100 = parseInt(hh_x100);
  mmt_x100 = secs_x100 - (hh_x100 * 3600);
  mm_x100 = mmt_x100 / 60;
  mm_x100 = parseInt(mm_x100);
  ss_x100 = mmt_x100 - (mm_x100 * 60);
  if (hh_x100 > 23)
  {
     dd_x100 = hh_x100 / 24;
     dd_x100 = parseInt(dd_x100);
     hh_x100 = hh_x100 - (dd_x100 * 24);
  } else { dd_x100 = 0; }
  if (ss_x100 < 10) { ss_x100 = "0"+ss_x100; }
  if (mm_x100 < 10) { mm_x100 = "0"+mm_x100; }
  if (hh_x100 < 10) { hh_x100 = "0"+hh_x100; }
  if (dd_x100 == 0) { return (hh_x100+":"+mm_x100+":"+ss_x100); }
  else {
    if (dd_x100 > 1) { return (dd_x100+" days "+hh_x100+":"+mm_x100+":"+ss_x100); }
    else { return (dd_x100+" day "+hh_x100+":"+mm_x100+":"+ss_x100); }
  }
}
function do_cd_x100()
{
  if (countdown_x100 < 0)
  {
    document.getElementById('war').innerHTML = "<b><span style='color: red;'><blink>WAR IS NOW!!</blink></span></b>";
  }
  else
  {
    document.getElementById('war').innerHTML = convert_to_time_x100(countdown_x100);
    setTimeout('do_cd_x100()', 1000);
  }
  countdown_x100 = countdown_x100 - 1;
}
document.write("<span id='war'></span>\n");
do_cd_x100();