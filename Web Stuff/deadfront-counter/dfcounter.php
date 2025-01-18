<?php
date_default_timezone_set("America/Chicago");
?>
<html>
<head>
<title>Evo DF Timer</title>
<style type="text/css">
html {
	background: url(1234105375360.jpg) no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
        #pagecontainer { 
        margin: 10px auto 0; 
        width: 800px;
        float: none; 
        padding-top: 25px;
		
        }
/*- Countdown Timer----------------------- */

        #countbox {
        font-size: 30pt; 
        font-family: "Arial"; 
        text-decoration: bold;
        background-color:#000000;
        color: #FFFFFF;
        text-align: center;
        }

        #countboxholder {
	position:relative;
	
        }

        #countboxdays {
        position:absolute;
	top:5px;
	left:15px;
	font-size:75px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:left;
	color:#ffffff;
        letter-spacing:40px;
        }

        #countboxhours {
        position:absolute;
	top:5px;
	left:207px;
	font-size:75px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:left;
	color:#ffffff;
        letter-spacing:40px;
        }

        #countboxmins {
        position:absolute;
	top:5px;
	left:400px;
	font-size:75px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:left;
	color:#ffffff;
        letter-spacing:40px;
        }

        #countboxsecs {
        position:absolute;
	top:5px;
	left:592px;
	font-size:75px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:left;
	color:#ffffff;
        letter-spacing:40px;
        }

        #timer_days_label {
	position:absolute;
	top:112px;
	left:43px;	
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }

        #timer_hours_label {
	position:absolute;
	top:112px;
	left:229px;	
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }

        #timer_mins_label {
	position:absolute;
	top:112px;
	left:427px;	
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }
        #timer_mins_label2 {
	margin: 10px auto 0;
	top:600px;
	font-size:36px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }		

        #timer_seconds_label {
	position:absolute;
	top:112px;
	left:619px;
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }
		
#msg1 {
	margin: 10px auto 0;
	top:640px;
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }		
#msg2 {
	margin: 10px auto 0;
	top:680px;
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }		
#msg3 {
	margin: 10px auto 0;
	top:720px;
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }		
#msg4 {
	margin: 10px auto 0;
	top:760px;
	font-size:30px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }		
		
	#msg5 {
	margin: 10px auto 0;
	top:240px;
	font-size:50px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
        }
	#msg6 {
	margin: 10px auto 0;
	top:40px;
	font-size:55px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-align:center;
	color:#ffffff;	
        }	

</style>
<br />
<br />
<br /><br />
<div id="pagecontainer">
<div id="msg6">Evolution Deadfront Timer</div>
<br><br><br>

<?php
$hour_wars = array('03', '07', '11', '15', '19', '23');
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

function convert_to_time_x1500hh(secs_x1500)
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
  if (dd_x1500 == 0) { 
		return (hh_x1500);
		return (mm_x1500);
		
  }
}
function convert_to_time_x1500mm(secs_x1500)
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
  if (dd_x1500 == 0) { 

		return (mm_x1500);

  }
}

function convert_to_time_x1500ss(secs_x1500)
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
  if (dd_x1500 == 0) { 
  return (ss_x1500);
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
	document.getElementById('countboxhours').innerHTML = convert_to_time_x1500hh(countdown_x1500);
	document.getElementById('countboxmins').innerHTML = convert_to_time_x1500mm(countdown_x1500);
	document.getElementById('countboxsecs').innerHTML = convert_to_time_x1500ss(countdown_x1500);
    setTimeout('do_cd_x1500()', 1000);
  }
  if (countdown_x1500 < 1200)
  {
  document.getElementById('nationwarx15002').innerHTML = "<br>Get your ass to Chain or Fire! You have 20min!";
  }
  else
  {
  document.getElementById('nationwarx15002').innerHTML = "";
  }
  
  if (countdown_x1500 < 600)
  {
  document.getElementById('nationwarx15006').innerHTML = "Do you have your map? Enough pots?";
  }
  else
  {
  document.getElementById('nationwarx15006').innerHTML = "";
  }
  
  
  if (countdown_x1500 < 300)
  {
  	document.getElementById('nationwarx15003').innerHTML = "Application Time has started!";
  }
  else
  {
  	document.getElementById('nationwarx15003').innerHTML = "";
  }
  if (countdown_x1500 < 120)
  {
  	document.getElementById('nationwarx15004').innerHTML = "You have now 2 minutes to apply!";
  }
  else
  {
  	document.getElementById('nationwarx15004').innerHTML = "";
  }
  if (countdown_x1500 < 60)
  {
  	document.getElementById('nationwarx15005').innerHTML = "You have now 1 minute to apply!";
  }
  else
  {
  	document.getElementById('nationwarx15005').innerHTML = "";
  }
  countdown_x1500 = countdown_x1500 - 1;
}
document.write("<div id='msg5'><span id='nationwarx1500'></span></div>\n");
document.write("<div id='countboxholder'><img src='CountdownTimerBackground.png' /><div id='countboxdays'>00</div><div id='countboxhours'></div><div id='countboxmins'></div><div id='countboxsecs'></div><div id='timer_days_label'>days</div><div id='timer_hours_label'>hours</div><div id='timer_mins_label'>mins</div><div id='timer_seconds_label'>secs</div></div>\n");
document.write("<div id='msg1'><span id='nationwarx15002'></span></div>\n");
document.write("<div id='msg4'><span id='nationwarx15006'></span></div>\n");
document.write("<div id='msg2'><span id='nationwarx15003'></span></div>\n");
document.write("<div id='msg3'><span id='nationwarx15004'></span></div>\n");
document.write("<div id='msg4'><span id='nationwarx15005'></span></div>\n");

do_cd_x1500();
</script>
</div>
