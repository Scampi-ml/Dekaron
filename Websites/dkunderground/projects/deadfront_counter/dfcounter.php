<?php

$hour_wars = array('04', '08', '12', '16', '20');
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
    document.getElementById('nationwarx1500').innerHTML = "<b>Deadfront is NOW!!</b>";
  }
  else
  {
	document.getElementById('nationwarx1500').innerHTML = " "+convert_to_time_x1500(countdown_x1500)+" until the next deadfront.";
    setTimeout('do_cd_x1500()', 1000);
  }
  countdown_x1500 = countdown_x1500 - 1;
}
document.write("<span id='nationwarx1500'></span>\n");

do_cd_x1500();
</script>

