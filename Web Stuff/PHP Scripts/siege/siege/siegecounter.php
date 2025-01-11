<?php

date_default_timezone_set("America/Chicago");

?>

<html>

<head>

<title>Evo Siege Timer</title>

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

<div id="msg6">Evolution Siege Timer</div>

<br><br><br>


<script type="text/javascript" language="javascript">


function pad(number, length) {
   
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
   
    return str;

}


dateFuture = new Date(2012,2,3,19,00,00);

function GetCount(){

        dateNow = new Date();                                             //grab current date
        amount = dateFuture.getTime() - dateNow.getTime();                //calc milliseconds between dates
        delete dateNow;

        // time is already past
        if(amount < 0){
                days=0;hours=0;mins=0;secs=0;

                days=pad(days, 2);
                hours=pad(hours, 2);
                mins=pad(mins, 2);
                secs=pad(secs, 2);

                document.getElementById('countboxdays').innerHTML=days;
                document.getElementById('countboxhours').innerHTML=hours;
                document.getElementById('countboxmins').innerHTML=mins;
                document.getElementById('countboxsecs').innerHTML=secs;
        }
        // date is still good
        else{
                days=0;hours=0;mins=0;secs=0;

                amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

                days=pad((Math.floor(amount/86400)), 2);//days
                amount=amount%86400;

                hours=pad((Math.floor(amount/3600)), 2);//hours
                amount=amount%3600;

                mins=pad((Math.floor(amount/60)), 2);//minutes
                amount=amount%60;

                secs=pad((Math.floor(amount)), 2);//seconds

                document.getElementById('countboxdays').innerHTML=days;
                document.getElementById('countboxhours').innerHTML=hours;
                document.getElementById('countboxmins').innerHTML=mins;
                document.getElementById('countboxsecs').innerHTML=secs;

                setTimeout("GetCount()", 1000);
        }
}

window.onload=function(){GetCount();}//call when everything has loaded



</script>

<!-- end countdown timer script -->


<div id="countboxholder">
<img src="CountdownTimerBackground.png" />
<div id="countboxdays"></div>
<div id="countboxhours"></div>
<div id="countboxmins"></div>
<div id="countboxsecs"></div>

<div id="timer_days_label">days</div>
<div id="timer_hours_label">hours</div>
<div id="timer_mins_label">mins</div>
<div id="timer_seconds_label">secs</div>
</div>
<br><br><br><br>
<center><b style="color:#FFFFFF;">It does not matter what timezone your are in!</b></center>

