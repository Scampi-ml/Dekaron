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
            <h2>Account Password</h2>
          </div>
          <div class="account-form account-change-password clearfix">
          <?php echo form_open('myaccount/password/ChangePasswordCheck', array('class'=>"normal")); ?>
              <div id="password-form">
                <div class="form-row input"> 
                	<span class="input-row-text"><label for="oldPassword">Secret Number:</label></span>
                    <span class="input-row-left"><input tabindex="1" size="25" maxlength="12" id="SecretNum" required="required" name="SecretNum" class="input" autocomplete="off" value="" placeholder="Enter Secret Number" type="text"></span>
                    <span class="input-row-notice"> <small>12 Characters. Letters and numbers only. Example: BREPAXERA2UT</small> <?php echo form_error('SecretNum'); ?> </span>
                </div>                
                <div class="form-row input">
                	<span class="input-row-text"><label for="newPassword">New Password:</label></span>
                    <span class="input-row-left"><input tabindex="2" size="25" maxlength="16" id="newPassword" required="required" name="newPassword" class="input" autocomplete="off" value="" placeholder="Enter Password" type="password"></span>
                    <span class="input-row-right"><input tabindex="3" size="25" maxlength="16" id="rePassword" required="required" name="rePassword" class="input" autocomplete="off" value="" placeholder="Re-enter Password" type="password"></span>
                    <span class="input-row-notice"><small>4-16 characters. Letters and numbers only.</small> <?php echo form_error('Password'); ?> <?php echo form_error('rePassword'); ?></span>
                </div>
                <div class="form-row form-row-button">
                	<span class="input-row-button"><button tabindex="4" name="register" button="" type="submit" class="button"><span class="button"><span class="button-inner">Edit Password</span></span></button></span>
              	</div>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./inc/footer.php'); ?>