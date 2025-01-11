<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="how-to-connect">
        <div class="container-top"> 
			<h2 id="title">Item Shop</h2>
Click the drop down menu to select a larger amount of D-Shop Coins.
Please make sure you type your character name correctly.
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PFULPKHT2Q44J">
<table>
<tr><td><input type="hidden" name="on0" value="D-Shop Coins">D-Shop Coins</td></tr><tr><td><select name="os0">
	<option value="13,250 D-Shop Coins">13,250 D-Shop Coins $10.00 USD</option>
	<option value="36,000 D-Shop Coins">36,000 D-Shop Coins $20.00 USD</option>
	<option value="43,000 D-Shop Coins">43,000 D-Shop Coins $25.00 USD</option>
	<option value="50,000 D-Shop Coins">50,000 D-Shop Coins $30.00 USD</option>
	<option value="64,000 D-Shop Coins">64,000 D-Shop Coins $40.00 USD</option>
	<option value="77,000 D-Shop Coins">77,000 D-Shop Coins $50.00 USD</option>
	<option value="110,000 D-Shop Coins">110,000 D-Shop Coins $75.00 USD</option>
	<option value="155,000 D-Shop Coins">155,000 D-Shop Coins $100.00 USD</option>
	<option value="385,000 D-Shop Coins">385,000 D-Shop Coins $200.00 USD</option>
	<option value="800,000 D-Shop Coins">800,000 D-Shop Coins $300.00 USD</option>
</select> </td></tr>
<tr><td><input type="hidden" name="on1" value="Enter Your Character Name">Enter Your Character Name</td></tr><tr><td><input type="text" name="os1" maxlength="200"></td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
