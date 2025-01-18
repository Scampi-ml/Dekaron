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
      <?php
	  	$download_list = $template['download_list'];
		for($i = 0; $i < count($download_list); ++$i)
		{
			?>
            	<div class="arsenal-searcharea" style="width:70%">
                <br />
                    <div class="form-row input">
                		<span class="input-row-left">
                            <button class="button" type="submit" name="loginButton" tabindex="4" onclick="javascript:window.location.href='<?php echo site_url('download/DownloadFile/'.$download_list[$i][3]); ?>'; return false;">
                                <span class="button">
                                    <span class="button-inner">Download Now</span>
                                </span>
                            </button> 
                            <?php echo $download_list[$i][1]; ?>                        
                		</span>
                	</div>
                    <br />
            	</div>
            <?php
		}	  
	  ?>
      </form>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
<?php if($template['redirect_url']) { ?>
<script type="text/javascript">
	$(document).ready(function()
	{
		setTimeout(function()
		{
			window.location.href = '<?php echo $template['redirect_url']; ?>';
		},2000);								
	});
</script> 
<?php } ?>