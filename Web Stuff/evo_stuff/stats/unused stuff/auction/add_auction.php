<?php

// Hours - Seconds
// http://www.unitconversion.org/time/hours-to-seconds-conversion.html
$hour_to_sec = array(
'2' => "7200",
'4' => "14400",
'8' => "28800",
'12' => "43200",
'16' => "57600",
'24' => "86400",
'48' => "172800",
'72' => "259200"
);

$closing_date =  $hour_to_sec[$_POST['product_duration']] + time();

$query1 = $dekaron->SQLquery("SELECT * FROM items WHERE Id = '".$_POST['item_index']."' ");
$getItemOptions = $dekaron->SQLfetchArray($query1);

$query2 = $dekaron->SQLquery("
INSERT INTO 
	auction_products 
(
product_name,
product_categories,
seller_username,
minimum_bid,
buyout_price,
product_duration,
created_date,
closing_date,
item_index,
job,
reqlv,
width,
height
)
	VALUES
(
'".$_POST['product_name']."', 
'".$_POST['category']."',
'".$_SESSION['NICKNAME']."',
'".$_POST['minimum_bid']."', 
'".$_POST['buyout_price']."',
'".$_POST['product_duration']."', 
'".time()."',
'".$closing_date."',
'".$_POST['item_index']."', 
'".$getItemOptions['Job']."', 
'".$getItemOptions['ReqLv']."', 
'".$getItemOptions['Width']."', 
'".$getItemOptions['Height']."'
)

");	

$query3 = $dekaron->SQLquery("

INSERT INTO auction_storage (character_no, line_no, byHeader, wIndex, dwSerialNumber, info, upt_time, reg_bindate, exp_bindate) SELECT character_no, line_no, byHeader, wIndex, dwSerialNumber, info, upt_time, reg_bindate, exp_bindate FROM ".$_POST['source']." WHERE wIndex = '".$_POST['item_index']."' AND line_no = '".$_POST['line_no']."' AND character_no = '".$_SESSION['NICKNAME']."'

");
// < delete sql command to remove item from character >


if(!$query3)
{
	echo "Failed to move item";	
}
else
{
	echo "Successfuly moved item";	
}

?>
<br>
<center><b>Your <?php echo $_POST['product_name']; ?> has been placed on the auction house!</b></center>
<br>
<center><a href="auction.php?action=get_auctions" >Go to the auction house</a></center>
<br>