<?php
include 'do_not_auction_this.php';
include 'items.php';
echo '<h2>You are not allowed to auction the following items</h2>';
echo '<ul>';
foreach ($not_allowed_to_auction as $not_allowed_item)
{
	echo '<li>'.$items[$not_allowed_item].'</li>';
}
echo '</ul>';
?>