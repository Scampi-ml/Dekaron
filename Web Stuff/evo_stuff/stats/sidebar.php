<aside class="grid_1">
    <nav class="global">
        <ul class="clearfix">
        <?php
        if ( preg_match ( '/index.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-house" href="index.php">Overview</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-house" href="index.php">Overview</a></li>';
        }

		if ( preg_match ( '/pvp_win.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-book" href="pvp_win.php">PVP Win</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-book" href="pvp_win.php">PVP Win</a></li>';
        }
		
   		if ( preg_match ( '/pvp_lose.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-book" href="pvp_lose.php">PVP Lose</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-book" href="pvp_lose.php">PVP Lose</a></li>';
        }
		
   		if ( preg_match ( '/cache.php/', $_SERVER["REQUEST_URI"] ) )
        {
            echo '<li class="active"><a class="nav-icon icon-book" href="cache.php">Cache</a></li>';
        }
        else
        {
            echo '<li><a class="nav-icon icon-book" href="cache.php">Cache</a></li>';
        }
		
		
        ?>
        </ul>
    </nav>
</aside>