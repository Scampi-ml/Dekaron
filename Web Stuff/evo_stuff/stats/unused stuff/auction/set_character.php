<br>
<?php
if(@$_POST['submit'])
{
	$name_no = explode("-", $_POST['character']);
	$_SESSION['NICKNAME'] = $name_no[1];
	$_SESSION['AUCTION_ACTION_CHARACTER_NO'] = $name_no[0];
	echo "<center><b>You are using ".$_SESSION['NICKNAME']." as your auction character.</b><br>You can now use the auction house.</center><br><br>";
}
else
{
?>

<form action="auction.php?action=set_character" method="POST">
    <b>Select your character to use in the auction house:</b>
    <br>
    <br>
    <?php
    foreach($_SESSION['CHARACTERS'] as $character)
    {
        $name_no = explode("-", $character);
        echo '<input type="radio" name="character" value="'.$character.'">&nbsp;&nbsp;&nbsp; '.$name_no[1].'<br>';	
    }
    ?>
    <br>
    <input type="submit" name="submit" value="Use auction character">
</form>
    
<?php
}
?>
