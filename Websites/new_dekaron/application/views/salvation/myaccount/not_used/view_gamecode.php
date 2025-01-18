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
            <h2>Settings</h2>            
          </div>
          <div class="account-form account-change-mail clearfix">
            <div class="info">
                <span class="info-text">
                    Sorry, there are no settings available.<?php echo $template['test']; ?>
                </span>
            </div>

          </div>
        </div>
        <div class="account-content clearfix account-characters"> </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./inc/footer.php'); ?>