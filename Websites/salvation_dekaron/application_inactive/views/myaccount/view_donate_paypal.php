<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
    <div id="pages">
        <div id="account-index" class="pages-inner">
            <div class="wrapper clearfix">
				<?php $this->load->view('./inc/u_navigation.php'); ?>
                <div class="account-content clearfix">
                    <div class="container-1 overview-headline clearfix">
                    	<h2>Donate With PayPal</h2>            
                    </div>
                    <div class="account-form account-change-password clearfix">
                    	
                            <?php echo form_open('myaccount/donate/GeneratePayPalForm', array('class'=>"normal")); ?>
                                <div class="form-row input">
                                    <span class="input-row-text">
                                        <label for="accountname">Buy <?php echo $this->config->item('paypal_item_name'); ?></label>
                                    </span>
                                    <span class="input-row-left">
                                        <select name="paypal" id="selectsearch" required="required" class="select">
                                            <option selected="selected" value="">Please select an option ...</option>
                                            <?php
                                            $paypal_packages = $template['paypal_packages'];
                                            for($i = 0; $i < count($paypal_packages); ++$i)
                                            {
                                                $price = $paypal_packages[$i][0];
                                                $coins = $paypal_packages[$i][1];
                                                
                                                
                                                if($this->config->item('paypal_custom_list'))
                                                {
                                                    $name = $paypal_packages[$i][2];
                                                    echo '<option value="'.$coins.'">'.$name.'</option>';
                                                }
                                                else
                                                {
                                                    $name = $this->config->item('paypal_item_name');
                                                    $currency = $this->config->item('paypal_currency_code');
                                                    $symbol = $this->config->item('paypal_symbole');
                                                    echo '<option value="'.$coins.'">'.$coins.' '.$name.' for '.$symbol.''.$price.' '.$currency.'</option>';
                                                }										
                                            }						
                                            ?>                                    
                                        </select>                                    
                                    </span>
                                    <span class="input-row-notice"> <?php echo form_error('Username'); ?></span> 
                                </div>
                                
                                <div class="form-row form-row-button">
                                    <span class="input-row-button">
                                        <button tabindex="8" name="registerButton" type="submit" class="button"> <span class="button"> <span class="button-inner"><?php echo $this->config->item('paypal_button'); ?></span> </span> </button>
                                    </span>
                                </div>                                
                            <?php echo form_close(); ?>

                    </div> 
                </div>
                <div class="account-content clearfix account-characters"> </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>