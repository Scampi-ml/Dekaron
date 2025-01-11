<?php
$goback = 'auction.php?action=auction_item&item='.$_POST['item_index'].'&line_no='.$_POST['line_no'].'&item_name='.base64_encode($_POST['product_name']).'&source='.$_POST['source'].'';


if ($_POST['buyout_price'] > '99999999')
{
	echo '<br><br><center><b>Sorry, your buyout price cannot be higher then <b>99999999</b>.</b><br><a href="'.$goback.'">Click here</a> to go back.</center><br><br>';
}
elseif ($_POST['minimum_bid'] > '99999999')
{
	echo '<br><br><center><b>Sorry, your minimum bid cannot be higher then <b>99999999</b>.</b><br><a href="'.$goback.'">Click here</a> to go back.</center><br><br>';
}
else
{
?>
<script src="js/gotonext.js" language="javascript" type="text/javascript"></script>
<form action="auction.php?action=add_auction" method="post" name="accentForm">
<h2>Please confirm</h2>
<div style="margin-left: 10px; margin-right: 10px;">

<br><br>
<table width="100%">
    <tr>
        <td><strong>Item Name</strong></td>
        <td style='text-align: right'><?php echo $_POST['product_name']; ?></td>
    </tr>
    <tr>
        <td width="30%"><div class="hr2"></div></td>
        <td width="70%"><div class="hr2"></div></td>
    </tr>    
    <tr>
        <td><strong>Item Category</strong></td>
        <td style='text-align: right'><?php echo $_POST['category']; ?></td>
    </tr>
    <tr>
        <td width="30%"><div class="hr2"></div></td>
        <td width="70%"><div class="hr2"></div></td>
    </tr>    
    <tr>
        <td><strong>Auction duration</strong></td>
        <td style='text-align: right'><?php echo $_POST['product_duration']; ?> Hours</td>
    </tr>
    <tr>
        <td width="30%"><div class="hr2"></div></td>
        <td width="70%"><div class="hr2"></div></td>
    </tr>    
    <tr>
        <td><strong>Buyout Price</strong></td>
        <td style='text-align: right'>
		<?php
        if ($_POST['buyout_price'] == '')
		{
			echo 'Players cannot buyout this item';	
		}
		else
		{
			echo $_POST['buyout_price'];	
		}
		?>
        </td>
    </tr>
    <tr>
        <td width="30%"><div class="hr2"></div></td>
        <td width="70%"><div class="hr2"></div></td>
    </tr>    
    <tr>
        <td><strong>Minimum bid price</strong></td>
        <td style='text-align: right'><?php echo $_POST['minimum_bid']; ?></td>
    </tr>     
    <tr>
        <td width="30%"><div class="hr2"></div></td>
        <td width="70%"><div class="hr2"></div></td>
    </tr>    
    <tr>
        <td><b>Auction Fee</b></td>
        <td style='text-align: right'>-<?php echo $dekaron->configget('AUCTION_TAX'); ?>% Coins from the final acution price</td>
    </tr>
</table>
<?php

foreach($_POST as $key=>$val)
{
	 echo '<input type="hidden" name="'.$key.'" value="'.$val.'" />';
}

?>
</form>
<div class="clear-fix"></div>
<div style="float:right;">
<br>
<input type="checkbox" name="confirmchk" value="checkbox"> I have checked the form!

<br><br>
<input type="image" onClick="gotoNext2()" src="img/button_next.png" >
<br><br>
</div>
<?php
}
?>