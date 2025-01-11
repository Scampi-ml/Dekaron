<?php
$file = 'login';
include("config/lang.conf.php");
if(file_exists("config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("config/language/english/controlpanel/".$file.".php");
}

echo "<link href='config/stylesheet.css' type='text/css' rel='stylesheet'>";
$rechner1 = rand(1,49);
$rechner2 = rand(1,49);
$ergebnis1 = $rechner1+$rechner2;
?>
<center>
<form action='controlpanel/index.php' method='POST'>
	<table class='innertab'>
		<tr>
			<td align="center"><?php echo $language['split1']; ?></td>
			<td><input type="text" name="accname" maxlength="12"></td>
		</tr>
		<tr>
			<td align="center"><?php echo $language['split2']; ?></td>
			<td><input type="password" name="accpass" maxlength="12"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><?php echo $language['split3']; ?></td>
		</tr>
		<tr>
			<td align="center"><?php echo $rechner1." + ".$rechner2; ?></td>
			<td><input type="text" name="ergebnis2" maxlength="2"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type='hidden' name='ergebnis1' value='<?php echo $ergebnis1; ?>'>
				<input type='hidden' name='log' value='login'>
				<input type='submit' value='<?php echo $language['button1']; ?>'>
			</td>
		</tr>
</table>
</form>
</center>