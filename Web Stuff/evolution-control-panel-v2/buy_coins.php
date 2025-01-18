<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Buy Coins</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            <?php
				$query4 = $dekaron->SQLquery("SELECT user_no,amount FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
				if ( !$query4 )
				{
					$getCash = 0;
					// insert D-Shop Fix
					$dekaron->dshopfix($_SESSION['USERNO']);
				}
				else
				{
					$getCash_query = $dekaron->SQLfetchArray($query4);
					$getCash = $getCash_query['amount'];
				}
				?>
                <div class="message info ac">
                    <h3>You currently have <?php echo $getCash; ?> coin(s).</h3>
                    Click <a href="log_coins.php">here</a> to view your coins Logs
                </div>
                <br />
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="form" class="form grid_6">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="PDXNY8DBJMB4L">            
                        <input type="hidden" name="on0" value="Evolution Games Coins (EvoCoins)">
                        <input type="hidden" name="on1" value="user_id">
                        <input type="hidden" name="os1" value="<?php echo $_SESSION['USERNO']; ?>" maxlength="60">
                        <input type="hidden" name="currency_code" value="USD">
                    <fieldset>
                        <legend>Buy Coins</legend>
                        <label>Username<small></small></label><input type="text" DISABLED value="<?php echo $_SESSION['USER']; ?>" />
                        <label>Amount<small></small></label>
                        <select name="os0" size="1"  style="width: 205px;" required="required">
                            <option value="550 EvoCoins">550 EvoCoins $5.00 USD</option>
                            <option value="1110 EvoCoins">1110 EvoCoins $10.00 USD</option>
                            <option value="2230 EvoCoins">2230 EvoCoins $20.00 USD</option>
                            <option value="2785 EvoCoins">2785 EvoCoins $25.00 USD</option>
                            <option value="5600 EvoCoins">5600 EvoCoins $50.00 USD</option>
                            <option value="8400 EvoCoins">8400 EvoCoins $75.00 USD</option>
                            <option value="11250 EvoCoins">11250 EvoCoins $100.00 USD</option>
                            <option value="22700 EvoCoins">22700 EvoCoins $200.00 USD</option>
                            <option value="34000 EvoCoins">34000 EvoCoins $300.00 USD</option>
                            <option value="58000 EvoCoins">58000 EvoCoins $500.00 USD</option>
                        </select>
                        <div class="action">
                            <button class="button button-gray" type="submit">Buy Coins</button>
                        </div>
                    </fieldset>
                </form> 
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>