<?php
if (!@$_SESSION['NICKNAME'])
{
	echo '<br><br><center><b>Sorry, you didnt select a auction character.</b><br><a href="auction.php?action=set_character">Click here</a> to select a character.</center><br><br>';	
}
else
{
?>
</div>
<div class="clear"></div>
<div class="grid_2">
    <dl>
    	<dt>General</dt>
        <dd><a href="auction.php?action=get_auctions&category=all">All</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Etc">Etc</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Necklace">Necklace</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Ring">Ring</a></dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
    </dl>
</div>
<div class="grid_2">
    <dl>
    	<dt>Armor</dt>
        <dd><a href="auction.php?action=get_auctions&category=Helmet">Helmet</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Glove">Glove</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Armor">Armor</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Pants">Pants</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Boots">Boots</a></dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
        <dd>&nbsp;</dd>
    </dl>
</div>
<div class="grid_2">
    <dl>
    	<dt>Weapons</dt>
        <dd><a href="auction.php?action=get_auctions&category=Bloopwhip">Bloopwhip</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Bow">Bow</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Crossbow">Crossbow</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Dagger">Dagger</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Gauntlet">Gauntlet</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Great_Axe">Great Axe</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Great_Mace">Great Mace</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Great Sword">Great Sword</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Shield">Shield</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Staff">Staff</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Twinsword">Twinsword</a></dd>
        <dd><a href="auction.php?action=get_auctions&category=Wand">Wand</a></dd>
    </dl>
</div>
<div class="grid_6">
	<hr />
</div>
<?php
	$SQL_where = "";
	if (isset($_GET['category']))
	{
		if ($_GET['category'] == 'all')
		{
			$SQL_where = "";
		}
		else
		{
			$SQL_where = "WHERE product_categories = '".$_GET['category']."' ";
		}
	}
	
	$query1 = $dekaron->SQLquery("SELECT * FROM auction.dbo.auction_products ".$SQL_where." ORDER BY closing_date DESC");
	


	?>		
	  <table class="datatable paginate sortable full" align="center">
		<thead>
			<tr>
				<th>Item</th>
				<th>Bid</th>
				<th>Buyout</th>
				<th>Time Remmaining</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($getAuction = $dekaron->SQLfetchArray($query1))
		{
			$query2 = $dekaron->SQLquery("SELECT * FROM auction.dbo.auction_bids WHERE product_id = '".$getAuction['product_id']."' ");
			$getAuctionBidNum = $dekaron->SQLfetchNum($query2);
			
			if($getAuctionBidNum == '0')
			{
				$bids = '';
			}
			else
			{
				$bids = ' ('.$getAuctionBidNum.') ';
			}
		
			echo "<tr>";
				echo '<td ><a href="auction.php?action=get_auction_detail&auction='.$getAuction['product_id'].'">'.$getAuction['product_name'].'</a></td>';
				echo '<td align="center" >'.$getAuction['minimum_bid'].' '.$bids.'</td>';
				if ($getAuction['buyout_price'] ==  '')
				{
					echo '<td align="center" >&nbsp;<div style="widdh:54px;"></td>';	
				}
				else
				{
					echo '<td align="center" ><img src="images/buyout.gif" /></td>';	
				}
				
				if ($getAuction['closing_date'] < time())
				{
					echo '<td align="center" >Ended!</td>';
				}
				else
				{
					$diff = $getAuction['closing_date'] - time();
					echo '<td align="center" >'.$dekaron->convertTime($diff).'</td>';
				}
			echo "</tr>";

		}
	echo '</tbody>';
	echo '</table>';
}
?>
