<form action="auction.php" method="get">
	<select name="character">
        <option value="">Select character</option>
        <?php
        foreach($_SESSION['CHARACTERS'] as $character)
        {
            $name_no = explode("-", $character);
			if ($_GET['character'] == $name_no[0])
			{
				echo '<option value="'.$name_no[0].'" selected>'.$name_no[1].'</option>';
			}
			else
			{
				echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
			}
        }
        ?>
	</select>

	<select name="where">
        <option value="">Select where</option>
        	<?php
				if ($_GET['where'] == 'user_store')
				{
					echo '<option value="user_store" selected>Personal Store</option>';
				}
				else
				{
					echo '<option value="user_store">Personal Store</option>';
				}
				if ($_GET['where'] == 'user_storage')
				{
					echo '<option value="user_storage" selected>Storage</option>';
				}
				else
				{
					echo '<option value="user_storage">Storage</option>';
				}
				if ($_GET['where'] == 'user_bag')
				{
					echo '<option value="user_bag" selected>Inventory</option>';
				}
				else
				{
					echo '<option value="user_bag">Inventory</option>';
				}
				
			?>
	</select>	
    <input type="hidden" name="action" value="get_items"  />
    <button type="submit" class="button button-gray" style="padding-top: 1px;">Get Items</button>
	<div></div>
    
</form>
	<?php
	if(isset($_GET['where']) && isset($_GET['character']))
	{
	?>
    <br />
    <h2>Select an item to auction</h2>
        <table class="datatable paginate sortable full" align="center">
            <thead>
                <tr>
                    <th class="sort-asc">Item Name</th>
                </tr>
            </thead>
        <tbody>
        <?php
        
    
        if ($_GET['where'] == 'user_store')
        {	
	        include 'items.php';
    	    include 'do_not_auction_this.php';

            $query1 = $dekaron->SQLquery("SELECT line_no,wIndex,character_no FROM user_store WHERE character_no = '".$_GET['character']."' ");
            while($getAuction = $dekaron->SQLfetchArray($query1))
            {
                if (in_array($getAuction['wIndex'], $not_allowed_to_auction))
                {
                    continue;
                }
                else
                {
                    echo "<tr>";
                    echo '<td>';
                    echo "<a href='auction.php?action=auction_item&item=".$getAuction['wIndex']."&line_no=".$getAuction['line_no']."&item_name=".base64_encode($items[$getAuction['wIndex']])."&source=".$_GET['where']."'>".$items[$getAuction['wIndex']]."</a>";
                    echo '</td>';
                    echo "</tr>";
                }
            }
            echo '</tbody>';
            echo '</table>';
            
        }
        elseif ($_GET['where'] == 'user_storage')
        {
	        include 'items.php';
    	    include 'do_not_auction_this.php';
		
            $query2 = $dekaron->SQLquery("SELECT line_no,wIndex,character_no FROM user_storage WHERE character_no = '".$_GET['character']."' ");
            while($getAuction = $dekaron->SQLfetchArray($query2))
            {
                if (in_array($getAuction['wIndex'], $not_allowed_to_auction))
                {
                    continue;
                }
                else
                {
                    echo "<tr>";
                    echo '<td>';
                    echo "<a href='auction.php?action=auction_item&item=".$getAuction['wIndex']."&line_no=".$getAuction['line_no']."&item_name=".base64_encode($items[$getAuction['wIndex']])."&source=".$_GET['where']."'>".$items[$getAuction['wIndex']]."</a>";
                    echo '</td>';
                    echo "</tr>";
                }
            }
            echo '</tbody>';
            echo '</table>';
        }
        elseif ($_GET['where'] == 'user_bag')
        {
	        include 'items.php';
    	    include 'do_not_auction_this.php';
		
            $query3 = $dekaron->SQLquery("SELECT line_no,wIndex,character_no FROM user_bag WHERE character_no = '".$_GET['character']."' ");
            while($getAuction = $dekaron->SQLfetchArray($query3))
            {
                if (in_array($getAuction['wIndex'], $not_allowed_to_auction))
                {
                    continue;
                }
                else
                {
                    echo "<tr>";
                    echo '<td>';
                    echo "<a href='auction.php?action=auction_item&item=".$getAuction['wIndex']."&line_no=".$getAuction['line_no']."&item_name=".base64_encode($items[$getAuction['wIndex']])."&source=".$_GET['where']."'>".$items[$getAuction['wIndex']]."</a>";
                    echo '</td>';
                    echo "</tr>";
                }
            }
            echo '</tbody>';
            echo '</table>';
            
        }
        else
        {
        }
	}
    ?>
