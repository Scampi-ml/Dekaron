<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="arsenal">
      	<form class="normal">
      	<?php echo $template['server_list']; ?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>