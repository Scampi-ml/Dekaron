<?php
include ('header.php');
include ('sidebar.php');

$auction_path = 'auction/';


?>  

<!-- Main Section -->
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
            </ul>
            <h2>Auction House</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
			<?php
            if(!empty($_GET['action']))
            {
            $incl = $auction_path . $_GET['action'].".php";
            }
            else
            {
            echo '<center><img src="images/auction_header.png"><br></center>';
            $incl = $auction_path . "start.php";
            }
            $dekaron->_flush();	
            if(file_exists($incl))
            {
            include $incl;
            }
            else
            {
            echo "<center><br><br>WUT?</center>";
            }
            ob_end_flush();
            ?>


            </div>
        </section>
    </div>
</section>
<!-- Main Section End -->
<?php
include ('footer.php');
?>
