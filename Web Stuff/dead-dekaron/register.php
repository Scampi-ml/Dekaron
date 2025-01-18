	  <?php
include "bancheck.php";
if (!extension_loaded('mssql'))
{
	echo '<b>ERROR!</b> You didnt load the <b>php_mssql.dll</b> in the <b>php.ini</b> file!';
	die();
}

?>



<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="captcha/captcha.css" />
<script type="text/javascript" src="latest-jquery/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="latest-jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="captcha/jquery.captcha.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".ajax-fc-container").captcha({
			borderColor: "silver",
			text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
		});
	});
</script>


</head>

<body>

<div id="div-regForm">

<div class="form-title">Dead Dekaron</div>
<div class="form-sub-title">Sign up now!</div>

<form id="regForm"  method="post">

<table>
  <tbody>
  <tr>
    <td><label for="fname">Account:</label></td>
    <td><div class="input-container"><input name="fname" id="fname" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="email">Email:</label></td>
    <td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="pass">Password:</label></td>
    <td><div class="input-container"><input name="pass" id="pass" type="password" /></div></td>
  </tr>
    <tr>
    <td><label for="pass2">Password Again:</label></td>
    <td><div class="input-container"><input name="pass2" id="pass2" type="password" /></div></td>
  </tr>
    </tbody>
  </table>

  <div class="ajax-fc-container">You must enable javascript to see captcha here!</div>


  <table>
  <tbody>
  <tr>
  <td>&nbsp;</td>
  <td><input type="submit" class="greenButton" value="Create Account" /><img id="loading" src="img/ajax-loader.gif" alt="working.." />
</td>
  </tr>
  </tbody>
</table>

</form>

<div id="error">
&nbsp;
</div>

</div>

</body>