<table class="datatable paginate sortable full" align="center">
    <thead>
        <tr>
        	<th>Seller</th>
            <th>Item</th>
            <th>Bid</th>
            <th>Buyout</th>
            <th>Time Remmaining</th>
        </tr>
    </thead>
<tbody>
    


<?php
	
foreach($_SESSION['CHARACTERS'] as $character)
{
	$name_no = explode("-", $character);
	$query1 = $dekaron->SQLquery("SELECT * FROM auction.dbo.auction_products WHERE seller_username = '".$name_no[1]."' ORDER BY closing_date DESC");
	$getMyAuctions = $dekaron->SQLfetchNum($query1);
	
	if ($getMyAuctions == '0')
	{
		continue;
	}
	else
	{
		
		  while($getAuction = $dekaron->SQLfetchArray($query1))
		  {
			  echo "<tr>";
			  	echo '<td>'.$name_no[1].'</td>';
				  echo '<td><a href="auction.php?action=get_auction_detail&auction='.$getAuction['product_id'].'">'.$getAuction['product_name'].'</a></td>';
				  echo '<td align="center" >'.$getAuction['minimum_bid'].'</td>';
				  if ($getAuction['buyout_price'] != '')
				  {
					 echo '<td align="center">&nbsp;<div style="width:54px;"></div></td>'; 	
				  }
				  else
				  {
					  echo '<td align="center" ><img src="images/buyout.gif" /></td>';	
				  }
				  
				  if ($getAuction['closing_date'] < time())
				  {
					  echo '<td align="center">Ended</td>';
				  }
				  else
				  {
					  $diff = $getAuction['closing_date'] - time();
					  echo '<td align="center" >'.$dekaron->convertTime($diff).'</td>';
				  }
			  echo "</tr>";
		  }
	}
}

?>
	</tbody>
</table>
