<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<?php

if($template['error'])
{
?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="container-box">
        <div class="registration registration-success">
          <div class="register-info"> <span class="register-info-text">Your account was successfully validated! </span>
            <div class="success-info-text">
              <p>
                If you have any questions or problems, please visit our <a href="<?php echo $template['support_url']; ?>" target="_blank">support page</a>.<br />
                <br />
                We hope you'll enjoy your stay on our server!
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
else
{
?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="container-box">
        <div class="registration registration-success">
          <div class="register-info"> <span class="register-info-text2">VALIDATION ERROR!</span>
            <div class="success-info-text">
              <p>
              	<br />
              	<?php echo '<b>Reason:</b> <code>'.$template['error_message'].'</code>'; ?><br />
                <br />
                If you have any questions or problems, please visit our <a href="<?php echo $template['support_url']; ?>" target="_blank">support page</a>.<br />
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>


<?php $this->load->view('inc/footer.php'); ?>

