<?php
include "bancheck.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-2" />
<meta name="Distribution" content="Global" />
<link rel='Stylesheet' type='text/css' href='default.css' />
<script type='text/javascript' src='scripts.js'></script>
<title>Dead : Dekaron</title>
</head>

<body>
<table width='100%' height='100%' style='background: url(img/bg_dk.jpg); background-repeat: no-repeat;' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr>
 <td height='100%' valign='top'>
        <div id='header'>
		<img src='img/vitality_gaming.png' style='margin-left: 326px; margin-top: 56px;'>
	</div>

	<div id='top-menu'></div>

	<div id='menu'>
		<a href='index.php?dk=news'><img src='img/home.jpg' style='margin-left: 29px; margin-top: 17px;' border='0'></a>
		<a href='index.php?dk=top'><img src='img/portal.jpg' style='margin-left: 48px; margin-top: 17px;' border='0'></a>
		<a href='index.php?dk=register'><img src='img/register.jpg' style='margin-left: 48px; margin-top: 17px;' border='0'></a>
		<a href='index.php?dk=download'><img src='img/download.jpg' style='margin-left: 48px; margin-top: 17px;' border='0'></a>
		<a href='forums'><img src='img/forum.jpg' style='margin-left: 48px; margin-top: 17px;' border='0'></a>
		<a href='index.php?dk=contact'><img src='img/contact.jpg' style='margin-left: 48px; margin-top: 17px;' border='0'></a>
	</div>

	<div id='line'>
	    <div id='line2'></div>
	</div>

	<div id='center'>
	  <div id='right'>

	    <div id='last-update'>
<?php include ("last-update.php");?>
	    </div>

	    <div id='info'></div>

	    <div id='info-txt'>


<?php
switch($_GET[dk])
{
  case "top":
     include "top.php"; break;

  case "register":
     include "register.php"; break;

  case "download":
     include "download.php"; break;

  case "contact":
     include "contact.php"; break;

  case "2";
     include "server-status.php"; break;

  case "3";
     include "user-panel.php"; break;

  case "4";
     include "server-time.php"; break;

  case "votenow";
     include "votenow.php"; break;

  case "donations";
     include "donations.php"; break;

  case "7";
     include "dead-front.php"; break;

  case "update";
     include "last-update.php"; break;

  case "9";
     include "advertisement.php"; break;

  case "10";
     include "footer.php"; break;

  case "11";
     include "follow-us.php"; break;

  case "news";
     include "news.php"; break;
  
  default:
     include "news.php"; break;


}
?>
	    </div>

	    <div id='advertisement'>
<?php include ("advertisement.php");?>
	    </div>

	  </div>

	  <div id='left'>

	    <div id='server-status'>
<?php include ("server-status.php");?>
	    </div>

	    <div id='user-panel'>
<?php include ("user-panel.php");?>
	    </div>

	    <div id='timer'>
<?php include ("server-time.php");?>
	    </div>

	    <div id='coins'>
		<a href='index.php?dk=votenow'><img src='img/vote.jpg' style='margin-left: 4px; margin-top: 1px;' border='0'></a>
		<a href='index.php?dk=donations'><img src='img/donations.jpg' style='margin-left: 4px;' border='0'></a>
	    </div>


	    <div id='df'>
<?php include ("dead-front.php");?>
	    </div>

                  <div id='free-box'>
<?php include ("video.php");?>
	</div>
	 
	  </div>
	  </div>

	<div id='footer'>
<?php include ("footer.php");?>
	</div>

  </td>
 </tr>
</table>
</body>
</html>