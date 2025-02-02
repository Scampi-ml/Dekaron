<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="container-box">
        <div class="registration registration-success">
          <div class="register-info"> <span class="register-info-text">Your account was successfully created! </span>
            <div class="success-info-text">
              <p>
                The community administrator has chosen to require validation for all email addresses. <br />
                Within the next 10 minutes (usually instantly) you'll receive an email with instructions on the next step. <br />
                Don't worry, it won't take long !<br />
                <br />
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
<?php $this->load->view('inc/footer.php'); ?>

