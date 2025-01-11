<?php

$query_cash = $dekaron->SQLquery("SELECT * FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
$getCash = $dekaron->SQLfetchArray($query_cash);
$cash_dshop_check = $dekaron->SQLfetchNum($query_cash);
if ($cash_dshop_check == 0)
{
	$serv_code = '01';
	$rand_code = $dekaron->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
	$date = date("ymd");
	$o_id_code = $serv_code.$date.$rand_code;
	$amount = '0';
	$free_amount = '0';
	
	$insert_coinsid = $dekaron->SQLquery("
	INSERT INTO cash.dbo.user_cash
		(
			id,
			user_no,
			group_id,
			amount,
			free_amount
		) 
	VALUES 
		(
			 '".$o_id_code."',
			 '".$GET_ACCOUNT_NO."',
			 '".$serv_code."',
			 '".$amount."',
			 '".$free_amount."'
		)  
	");
	echo "You didnt have a coins id, but i fixed it for ya :)";
}
if ($getCash == 0)
{
	echo '<br><br><center><b>Sorry, you dont have enough coins to place a bid of '.$_POST['bid'].' coins.</b></center><br><br>';
}
else
{
	$insert_bid = $dekaron->SQLquery("
	INSERT INTO auction_bids
		(
			product_id,
			username,
			time_of_bid,
			bid_amount
		) 
	VALUES 
		(
			 '".$_POST['auction']."',
			 '".$_SESSION['NICKNAME']."',
			 '".time()."',
			 '".$_POST['bid']."'
		)  
	");
	echo '<br><br><center><b>Success, you have placed a bid of '.$_POST['bid'].' coins.</b><br><a href="auction.php?action=get_auction_detail&auction='.$_POST['auction'].'">Click here</a> to return to the auction.</center><br><br>';

}

?>