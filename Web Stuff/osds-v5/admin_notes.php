<?php
include ('osdscore.php');

if(isset($_GET['adminnotes']))
{
	$text = trim($_GET['admin_notes']);
	$text_encode = base64_encode($text);
	exo_setglobalvariable('adminnotes', $text_encode, true);
	JavaAlert(LAN_updated, 'admin_notes.php');
}


$encode_text = exo_getglobalvariable('adminnotes', '');
if($encode_text == '')
{
	$text_decode = 'Admin Notes';
}
else
{
	$text_decode = base64_decode($encode_text);
}
?>


        <form method="get">
            <div id="serverinfo">Admin Notes<span><input type="submit" name="adminnotes" value="Save" ></span></div>
            <textarea name="admin_notes" style="width:99%; height:450px;"><?php echo $text_decode; ?></textarea>
        </form>
    </body>
</html>