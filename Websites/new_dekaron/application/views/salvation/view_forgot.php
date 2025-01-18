<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="container-box">
        <div class="registration">
          <div class="register-info"> <span class="register-info-text"> Get a new Password to your Mailbox! </span> </div>
          <?php echo form_open('forgot/CheckForgot', array('class'=>"normal")); ?>
            <div id="register-form">
              <div class="form-row input"> <span class="input-row-text">
                <label for="emailAddress">E-Mail Address:</label>
                </span> <span class="input-row-left">
                <input tabindex="2" size="30" maxlength="320" id="emailAddress" required="required" name="emailAddress" class="input" autocomplete="on" placeholder="Enter E-Mail Address" type="email">
                </span> <span class="input-row-notice"> <small><a href="<?php echo $template['support_url']; ?>">Forgot E-Mail Address?</a></small> </span> 
                    <?php echo validation_errors(); ?>
                    <?php 
                    if (! empty($template['result']))
                    { 
                        echo '<span class="input-row-notice">'.$template['result'].'</span> ';
                    } 
                    ?>  
                </div>
              <div class="form-row form-row-button"> <span class="input-row-button">
                <button name="registerButton" type="submit" class="button"> <span class="button"> <span class="button-inner">Send a new Password</span> </span> </button>
                </span> </div>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>