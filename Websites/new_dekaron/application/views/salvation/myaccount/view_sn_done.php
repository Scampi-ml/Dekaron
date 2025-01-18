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
                	<h3><?php echo $template['msg']; ?></h3>
                </span>
                <br />
                <br />
                <div class="form-row form-row-button">
                	<span class="input-row-button"><button tabindex="4" button="" onclick="window.location.href='<?php echo site_url('myaccount/overview'); ?>'" class="button"><span class="button"><span class="button-inner">Continue...</span></span></button></span>
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
