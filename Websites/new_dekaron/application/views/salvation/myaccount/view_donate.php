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
                    	<h2>Donate</h2>            
                    </div>
                    <div class="account-form account-change-mail clearfix">
                    	<div class="info">
                        	<center>
                            	<a href="<?php echo site_url('myaccount/donate/paypal'); ?>"><img src="<?php echo base_url('assets/images/donate/paypal-secure-payments.png'); ?>" /></a>
                            </center>
                        </div>
                    </div> 
                    <?php if($this->config->item('paymentwall_active')) { ?>
                    <div class="account-form account-change-mail clearfix">
                    	<div class="info">
                        	<center>
                            	<a href="<?php echo site_url('myaccount/donate/paymentwall'); ?>"><img src="<?php echo base_url('assets/images/donate/Paymentwall.png'); ?>" /></a>
                            </center>
                        </div>
                    </div> 
                    <?php } ?>     
                </div>
                <div class="account-content clearfix account-characters"> </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>