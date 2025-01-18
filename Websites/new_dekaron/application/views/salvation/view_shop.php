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
          <h2 id="title">Shop</h2>
          <div class="sub-description2">
          	<!-- BEGIN BLOCK 1 -->
            <div class="arsenal-searcharea"> <br />
              <table align="center" border="0"  width="100%">
                <tr>
                  <th scope="col" align="center"><img src="<?php echo base_url('assets/images/class/10.png'); ?>" /></th>
                  <th scope="col" align="center"><img src="<?php echo base_url('assets/images/class/10.png'); ?>" /></th>
                  <th scope="col" align="center"><img src="<?php echo base_url('assets/images/class/10.png'); ?>" /></th>
                </tr>
                <tr>
                  <td align="" width="33%" style="padding-left: 15px; padding-right:15px;">This is a very long desc </td>
                  <td align="" width="33%" style="padding-left: 15px; padding-right:15px;">This is a very long desc that does not make any send, but its something</td>
                  <td align="" width="33%" style="padding-left: 15px; padding-right:15px;">This is a very long desc that does not make any send</td>
                </tr>
                <tr>
                  <td align="center" width="33%"><br />
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="business" value="<?php echo $this->config->item('paypal_email'); ?>">
                      <input type="hidden" name="lc" value="<?php echo $this->config->item('paypal_lc'); ?>">
                      <input type="hidden" name="item_name" value="+10 staff">
                      <input type="hidden" name="amount" value="656.00">
                      <input type="hidden" value="Enter Your Character Name" name="on1" class="input">
                      <input type="text" maxlength="200" name="os1"  placeholder="Enter Character Name">
                      <br />
                      <br />
                      <input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_currency_code'); ?>">
                      <input type="hidden" name="button_subtype" value="products">
                      <input type="hidden" name="no_note" value="0">
                      <input type="hidden" name="add" value="1">
                      <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form></td>
                  <td align="center" width="33%"><br />
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="business" value="<?php echo $this->config->item('paypal_email'); ?>">
                      <input type="hidden" name="lc" value="<?php echo $this->config->item('paypal_lc'); ?>">
                      <input type="hidden" name="item_name" value="+10 staff">
                      <input type="hidden" name="amount" value="656.00">
                      <input type="hidden" value="Enter Your Character Name" name="on1" class="input">
                      <input type="text" maxlength="200" name="os1"  placeholder="Enter Character Name">
                      <br />
                      <br />
                      <input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_currency_code'); ?>">
                      <input type="hidden" name="button_subtype" value="products">
                      <input type="hidden" name="no_note" value="0">
                      <input type="hidden" name="add" value="1">
                      <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form></td>
                  <td align="center" width="33%"><br />
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="business" value="<?php echo $this->config->item('paypal_email'); ?>">
                      <input type="hidden" name="lc" value="US">
                      <input type="hidden" name="item_name" value="+10 staff">
                      <input type="hidden" name="amount" value="656.00">
                      <input type="hidden" value="Enter Your Character Name" name="on1" class="input">
                      <input type="text" maxlength="200" name="os1"  placeholder="Enter Character Name">
                      <br />
                      <br />
                      <input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_currency_code'); ?>">
                      <input type="hidden" name="button_subtype" value="products">
                      <input type="hidden" name="no_note" value="0">
                      <input type="hidden" name="add" value="1">
                      <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form></td>
                </tr>
              </table>
              <br />
            </div>
            <!-- END BLOCK 1 -->
            <!-- BEGIN BLOCK 2 -->
            <div class="arsenal-searcharea"> <br />
              <table align="center" border="0"  width="100%">
                <tr>
                  <th scope="col" align="center"><img src="<?php echo base_url('assets/images/class/10.png'); ?>" /></th>
                  <th scope="col" align="center"><img src="<?php echo base_url('assets/images/class/10.png'); ?>" /></th>
                  <th scope="col" align="center"><img src="<?php echo base_url('assets/images/class/10.png'); ?>" /></th>
                </tr>
                <tr>
                  <td align="" width="33%" style="padding-left: 15px; padding-right:15px;">This is a very long desc </td>
                  <td align="" width="33%" style="padding-left: 15px; padding-right:15px;">This is a very long desc that does not make any send, but its something</td>
                  <td align="" width="33%" style="padding-left: 15px; padding-right:15px;">This is a very long desc that does not make any send</td>
                </tr>
                <tr>
                  <td align="center" width="33%"><br />
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="business" value="<?php echo $this->config->item('paypal_email'); ?>">
                      <input type="hidden" name="lc" value="<?php echo $this->config->item('paypal_lc'); ?>">
                      <input type="hidden" name="item_name" value="+10 staff">
                      <input type="hidden" name="amount" value="656.00">
                      <input type="hidden" value="Enter Your Character Name" name="on1" class="input">
                      <input type="text" maxlength="200" name="os1"  placeholder="Enter Character Name">
                      <br />
                      <br />
                      <input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_currency_code'); ?>">
                      <input type="hidden" name="button_subtype" value="products">
                      <input type="hidden" name="no_note" value="0">
                      <input type="hidden" name="add" value="1">
                      <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form></td>
                  <td align="center" width="33%"><br />
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="business" value="<?php echo $this->config->item('paypal_email'); ?>">
                      <input type="hidden" name="lc" value="<?php echo $this->config->item('paypal_lc'); ?>">
                      <input type="hidden" name="item_name" value="+10 staff">
                      <input type="hidden" name="amount" value="656.00">
                      <input type="hidden" value="Enter Your Character Name" name="on1" class="input">
                      <input type="text" maxlength="200" name="os1"  placeholder="Enter Character Name">
                      <br />
                      <br />
                      <input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_currency_code'); ?>">
                      <input type="hidden" name="button_subtype" value="products">
                      <input type="hidden" name="no_note" value="0">
                      <input type="hidden" name="add" value="1">
                      <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form></td>
                  <td align="center" width="33%"><br />
                    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="business" value="<?php echo $this->config->item('paypal_email'); ?>">
                      <input type="hidden" name="lc" value="US">
                      <input type="hidden" name="item_name" value="+10 staff">
                      <input type="hidden" name="amount" value="656.00">
                      <input type="hidden" value="Enter Your Character Name" name="on1" class="input">
                      <input type="text" maxlength="200" name="os1"  placeholder="Enter Character Name">
                      <br />
                      <br />
                      <input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_currency_code'); ?>">
                      <input type="hidden" name="button_subtype" value="products">
                      <input type="hidden" name="no_note" value="0">
                      <input type="hidden" name="add" value="1">
                      <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    </form></td>
                </tr>
              </table>
              <br />
            </div>
            <!-- END BLOCK 2 -->
            
                        
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
