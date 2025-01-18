
<center>
<style type="text/css">
<!--
.style3 {
	font-weight: bold;
	font-size: 50px;
}
-->
</style>
<img src='images/content/content_check_updates.png' valign='left'><br>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
$version = file_get_contents("../config/version.php");
echo "<center>Check your version !</center><br><br>";
echo "<center><span class='style3'>$version</span></center>";
echo "<form action='?do=update&id=".$id."' method='POST'>";
echo"<center><tr>
		<td align='center' colspan='3'>
			<input type='submit' value='Check your version for updates now!'>
		</td>
	</tr>
	</form>
	</center>";
?>
</center>