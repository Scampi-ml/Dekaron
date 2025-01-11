	    <div style='padding: 20px 20px 20px 20px; text-align: justify;'>
If you have any questions, problems, want to report GM abuse, game bugs, please write them on Email:<br>
<br>
<div id='quote'>
<b>Rocker820</b><br>
Contact: <a href='mailto:rocker@vitalitygaming.info'>rocker@vitalitygaming.info</a><br>
<br>
<b>Darksmasher820</b><br>
Contact: <a href='mailto:darksmasher@vitalitygaming.info'>darksmasher@vitalitygaming.info</a><br>
<br>
<b>Raven</b><br>
Contact: <a href='mailto:raven@vitalitygaming.info'>raven@vitalitygaming.info</a><br>
</div>
<br>
- <u>You can send message to game post box:</u><br>
<br>
<?php

include "config.php";
if(empty($_POST['username'])) {
?>
<head>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/settings.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
pic1 = new Image(32, 32); 
pic1.src = "loading.gif";

$(document).ready(function(){

$("#username").change(function() { 

var usr = $("#username").val();

if(usr.length >= 3)
{
$("#status").html('<img src="img/loading.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check.php",  
    data: "username="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#username").removeClass('object_error'); // if necessary
		$("#username").addClass("object_ok");
		$(this).html('&nbsp;<img src="img/accepted.png" align="absmiddle"> <font color="Green"> Available </font>  ');
	}  
	else  
	{  
		$("#username").removeClass('object_ok'); // if necessary
		$("#username").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>3</strong> characters.</font>');
	$("#username").removeClass('object_ok'); // if necessary
	$("#username").addClass("object_error");
	}

});

});

</SCRIPT>
                      </head>
 

                    <center><br><form action='sendmail.php' method='POST'>
			<table width='565' class='innertab'>
  <tr>
					<td colspan='2' align='left'><b>Character Post Box</b><br><br></td>
				</tr>
				<tr>
					<td colspan='2' align='left'><table width='557' >
                      <tr>
                        <td width='153' id='abc2'>To:</td>
                        <td width='392'><input id='username'  type='text' name='username' />
                          <input type='button' value='Check Name' />
                          &nbsp;</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td align='left' valign='bottom' height='20px'><div id='status'></div></td>
                      </tr>
                    </table></td>
				</tr>
				<tr>
					<td width='155' align='left'>From:</td>
					<td width='398'><input type="text" name="from" maxlength="50"></td>
				</tr>
				<tr>
                  <td align='left'>Subject:</td>
				  <td><input type='text' name='subject' maxlength='50' /></td>
			  </tr>
				<tr>
                  <td align='left'>Message:</td>
				  <td><label>
                    <textarea name='message' cols='45' rows='5'></textarea>
                  </label></td>
			  </tr>
				<tr>
				  <td align='left' colspan='2'>&nbsp;</td>
				</tr>
				<tr>
				  <td align='left' colspan='2'>
				  <input type='hidden' name='select' value='1' />
                    <input type='submit' value='Send' /></td>
			  </tr>
			</table>
		</form></center>
	<p>

	  <script type='text/javascript'>
      $( function () {
  twitter.screenNameKeyUp();
  $('#user_screen_name').focus();
      });
      </script>
<?php
	} elseif($_POST['select']) {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['username']."'",$ms_con);

			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE character_name = '".$_POST['username']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			

			mssql_query("EXEC character.dbo.SP_POST_SEND_OP '".$row2[0]."','".$_POST['from']."',1,'".$_POST['subject']."','".$_POST['message']."','0','0',0",$ms_con);

			echo "<br><center><br>The mail has been sent successfully.</center>";
			echo "<br><center><br><b>Note:</b> It may take up to 5min to send</center>";
}
?>
	    </div>