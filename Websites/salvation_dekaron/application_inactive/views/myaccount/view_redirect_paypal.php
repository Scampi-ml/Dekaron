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

                    <div class="account-form account-change-password clearfix">
					<?php 
                    if($template['paypal_form'] == 'ERROR')
                    {
                        echo '<br><div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>There seems to be an error. <br><br><b>Reason:</b> <code>INVALID PACKAGE</code> <br><br>Please try again later.</p></div></div></div><br>';	
                    }
                    else
                    {
                        ?>
                            <center>
                                <h2>We are redirecting you to PayPal for payment</h2><br />
                                <div class="spinner"><img src="<?php echo base_url('assets/images/donate/spinner-large.gif'); ?>"/></div>
                                <br /><br />
                                <br /><br />
                                <small>If you are not redirected in the next 5 seconds please click the button below to be transferred to the payment page.</small>               
                        		<?php echo $template['paypal_form']; ?>
                                    <span class="input-row-button">
                                        <button tabindex="8" name="commit" type="submit" class="button"> <span class="button"> <span class="button-inner">Continue...</span> </span> </button>
                                    </span>
                            </center>                
                                                                       
                        <?php
                    }
                    ?>                   

                    </div> 
                </div>
                <div class="account-content clearfix account-characters"> </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>
<script type="text/javascript">
	$(document).ready(function()
	{
		setTimeout(function()
		{
			$("#paypal-form").submit();
		},2000);								
	});
</script>  