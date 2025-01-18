<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
	<?php 
    if (! empty($template['message']))
    { 
        echo $template['message'];
    } 
    ?>  
    <div id="account-index" class="pages-inner">
      <div class="wrapper clearfix">
		<?php $this->load->view('./inc/u_navigation.php'); ?>
        <div class="account-content clearfix">
            <div class="container-1 overview-headline clearfix">
                <h2>E-Mail Address</h2>
            </div>
            <div class="account-form account-change-password clearfix">
                <?php echo form_open('myaccount/emailadress/ChangeEmailCheck', array('class'=>"normal")); ?>
                <div id="password-form">
                	<?php if($template['missing_email'])
					{
						echo '<input type="hidden" name="SecretNum" value="'.$template['sn'].'">';
					}
					else
					{
						?>
                        <div class="form-row input">
                            <span class="input-row-text"><label for="oldPassword">Secret Number:</label></span>
                            <span class="input-row-left"><input tabindex="1" size="25" maxlength="12" id="SecretNum" required="required" name="SecretNum" class="input" autocomplete="off" value="" placeholder="Enter Secret Number" type="text"></span> 
                            <span class="input-row-notice"> <small>12 Characters. Letters and numbers only. Example: BREPAXERA2UT</small> <?php echo form_error('SecretNum'); ?> </span>
                        </div>
                    <?php } ?>
                	<div class="form-row input">
                        <span class="input-row-text"><label for="emailAddress">New E-Mail:</label></span> 
                        <span class="input-row-left"><input tabindex="2" size="25" maxlength="320" id="emailAddress" required="required" name="emailAddress" class="input" autocomplete="off" placeholder="Enter E-Mail Address" type="email"></span> 
                        <span class="input-row-right"><input tabindex="3" size="25" maxlength="320" id="reEmailAddress" required="required" name="reEmailAddress" class="input" autocomplete="off" placeholder="Re-enter E-Mail Address" type="email"></span>
                        <span class="input-row-notice"> <small>Enter your new E-Mail Address.</small> <?php echo form_error('emailAddress'); ?> <?php echo form_error('reEmailAddress'); ?></span>
                    </div>
                    <div class="form-row form-row-button">
                        <span class="input-row-button"><button tabindex="4" name="mailButton" type="submit" class="button"> <span class="button"> <span class="button-inner">Edit E-Mail Address</span> </span> </button></span>
                    </div>
                <?php echo form_close(); ?>
				</div>
            </div>
        </div>        
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>