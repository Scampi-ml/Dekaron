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
          <div class="sub-description2">
          	<!-- BEGIN BLOCK 1 -->
            <div class="arsenal-searcharea">
            	<br />
                <span class="success">
                	<h2>Your reffer has been saved!</h2>
                    <br />
                    The reffer number will be filled in for your once you visit the register page!
                	<br />
                    Or you can COPY / PASTE it in the register form.
                </span>
                <br />
                <br />
                <div class="form-row form-row-button">
                	<span class="input-row-button"><button tabindex="4" button="" onclick="window.location.href='<?php echo site_url('home'); ?>'" class="button"><span class="button"><span class="button-inner">Continue...</span></span></button></span>
              	</div>    
                <br />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
