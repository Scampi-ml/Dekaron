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
          <!--<div class="register-info"> <span class="register-info-text">Your password was successfully sent!</span>-->
            <div class="success-info-text">
              <p>
				<?php 
                if (! empty($template['result']))
                { 
                    echo $template['result'];
                } 
                ?> 
                <br /><br /> 
                If you have any questions or problems, please visit our <a href="<?php echo $template['support_url']; ?>" target="_blank">support page</a>.<br />
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

