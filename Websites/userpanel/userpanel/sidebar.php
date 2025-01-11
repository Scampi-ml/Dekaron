<aside class="grid_1">
    <nav class="global">
        <ul class="clearfix">
        <?php
        if ( preg_match ( '/overview.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-house" href="overview.php">Overview</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-house" href="overview.php">Overview</a></li>';
        }
        
        if ( preg_match ( '/account.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-vcard" href="account.php">Account</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-vcard" href="account.php">Account</a></li>';
        }
		
        if ( preg_match ( '/characters.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-group" href="characters.php">Characters</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-group" href="characters.php">Characters</a></li>';
        }

        if ( preg_match ( '/friends.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-group" href="friends.php">Friends</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-group" href="friends.php">Friends</a></li>';
        }
		
				
        if ( preg_match ( '/unstuck.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-arrow_refresh" href="unstuck.php">Unstuck</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-arrow_refresh" href="unstuck.php">Unstuck</a></li>';
        }
		
		if ( preg_match ( '/buy_coins.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-coins_icon" href="buy_coins.php">Buy Coins</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-coins_icon" href="buy_coins.php">Buy Coins</a></li>';
        }
		
		if ( preg_match ( '/buy_coins_friend.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-coins_icon" href="buy_coins_friend.php">Gift Coins</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-coins_icon" href="buy_coins_friend.php">Gift Coins</a></li>';
        }
		
		if ( preg_match ( '/send_coins.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-coins_icon" href="send_coins.php">Transfer Coins</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-coins_icon" href="send_coins.php">Transfer Coins</a></li>';
        }
		
		
		
		if ( preg_match ( '/bank.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-database_refresh" href="bank.php">Bank</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-database_refresh" href="bank.php">Bank</a></li>';
        }
		
		if ( preg_match ( '/send_tokens.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-token_send" href="send_tokens.php">Send Tokens</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-token_send" href="send_tokens.php">Send Tokens</a></li>';
        }
		
		if ( preg_match ( '/exchange_tokens.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-token_exchange" href="exchange_tokens.php">Exchange Tokens</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-token_exchange" href="exchange_tokens.php">Exchange Tokens</a></li>';
        }

		if ( preg_match ( '/buy_tokens.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-buy_token" href="buy_tokens.php">Buy Tokens</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-buy_token" href="buy_tokens.php">Buy Tokens</a></li>';
        }
		
				
		if ( preg_match ( '/pvp.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-emoticon_grin" href="pvp.php">PVP</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-emoticon_grin" href="pvp.php">PVP</a></li>';
        }
		
		if ( preg_match ( '/log_account.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-book" href="log_account.php">Account Logs</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-book" href="log_account.php">Account Logs</a></li>';
        }
		
		if ( preg_match ( '/log_coins.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-book" href="log_coins.php">Coins Logs</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-book" href="log_coins.php">Coins Logs</a></li>';
        }
		
        echo '<li><a class="nav-icon icon-cross" href="logout.php">Logout</a></li>';
		
        ?>
        </ul>
    </nav>
</aside>