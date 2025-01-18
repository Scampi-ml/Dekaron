<?php
if (!isset($_POST["timezoneoffset"])){
?>
 <form method="post" action="<?php echo $_SERVER["PHP_SELF"];  ?>" id="time_form" name="time_form">
 <script type="text/javascript">
  tzo = - new Date().getTimezoneOffset()*60;
  document.write('<input type="hidden" value="'+tzo+'" name="timezoneoffset">');
 </script>
 <input type="submit" value="Get Server Client TimeZone Difference" name="Ok">
 </form>
<?php
}else{
 $serverTimezoneOffset = (date("O") / 100 * 60 * 60);
 echo 'Server Timezone Offset : ' . ($serverTimezoneOffset/(60*60)) .' hours';
 echo '<br />';
}

function createsessions($username,$password)
{
	//Add additional member to Session array as per requirement
	$_SESSION["gdpassword"] = $password;		
	if(isset($_POST['remme']))
	{
		//Add additional member to cookie array as per requirement
		setcookie("gdpassword", $_SESSION['gdpassword'], time()+60*60*24*100, "/");
		return;
	}
}


function convertTime($difference)
{
	$days = intval($difference / 86400);
	if ( $days == '0'){$d = '';}else{$d = $days.'d ';}
	$difference = $difference % 86400;
	$hours = intval($difference / 3600);
	if ( $hours == '0'){$h = '';}else{$h = $hours.'h ';}
	$difference = $difference % 3600;
	$minutes = intval($difference / 60);
	if ( $minutes == '0'){$m = '';}else{$m = $minutes.'m ';}
	$difference = $difference % 60;
	$seconds = intval($difference);
	if ( $seconds == '0'){$s = '';}else{$s = $seconds.'s';}
  return $d.$h.$m.$s;

}

$df_times = array('23:00','03:00','07:00','11:00','15:00','19:00');
$df_times2 = array('2300','0300','0700','1100','1500','1900');

$server_time = date("Hi");



$server_time1 = time();
$server_time2 = time();
$server_time3 = time();
$server_time4 = time();
$server_time5 = time();
$server_time6 = time();


$df_time1 = time() + 14400;
$df_time2 = time() + 14400;
$df_time3 = time() + 14400;
$df_time4 = time() + 14400;
$df_time5 = time() + 14400;
$df_time6 = time() + 14400;

$time = strtotime("+5 hours");

?>

<table width="100%" border="1">
  <tr>
    <th scope="col">Dead Front</th>
    <th scope="col">Server Time</th>
    <th scope="col">Your Time</th>
    <th scope="col">Time Left</th>
  </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
    </tr>


    <tr>
        <td align="center">Deadfront @ <?php echo $df_times[0]; ?></td>
        <td align="center"><?php echo date("H:i"); ?></td>
        
        <td align="center"><?php echo abs( $server_time - $df_times[0] );?></td>
        <td align="center"><?php echo convertTime(time() + time); ?></td>
    </tr>
    <tr>
        <td align="center">Deadfront @ <?php echo $df_times[1]; ?></td>
        <td align="center"><?php echo date("H:i"); ?></td>
        <td align="center"><?php echo date('H:i', $time);?></td>
        <td align="center"><?php echo convertTime(date('H:i', $time)); ?></td>
    </tr>
    <tr>
        <td align="center">Deadfront @ <?php echo $df_times[2]; ?></td>
        <td align="center"><?php echo date("H:i"); ?></td>
        <td align="center"><?php echo date('H:i', $time);?></td>
        <td align="center">&nbsp;</td>
    </tr>
    <tr>
        <td align="center">Deadfront @ <?php echo $df_times[3]; ?></td>
        <td align="center"><?php echo date("H:i"); ?></td>
        <td align="center"><?php echo date('H:i', $time);?></td>
        <td align="center">&nbsp;</td>
    </tr>
    <tr>
        <td align="center">Deadfront @ <?php echo $df_times[4]; ?></td>
        <td align="center"><?php echo date("H:i"); ?></td>
        <td align="center"><?php echo date('H:i', $time);?></td>
        <td align="center">&nbsp;</td>
    </tr>
    <tr>
        <td align="center">Deadfront @ <?php echo $df_times[5]; ?></td>
        <td align="center"><?php echo date("H:i"); ?></td>
        <td align="center"><?php echo date('H:i', $time);?></td>
        <td align="center">&nbsp;</td>
    </tr>


</table>
