<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="arsenal">
      <h2 id="title">Deadfront Times</h2>
      <?php
	  	$deadfront = $template['deadfront'];
		foreach($deadfront as $df)
		{
			//$downloads = read_file('application/cache/hitcounters/'.$download_list[$i][3].'.txt');	
			
			echo '
			<div class="arsenal-searcharea">
				<h2>'.$df['sort_nm'].'</h2>
			</div>
			';
			
		}
		?>	  
    </div>
  </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>