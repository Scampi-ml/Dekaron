<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
	<?php 
    if (! empty($template['message']))
    { 
        echo $template['message'];
    } 
    ?>   
    <div id="vote" class="pages-inner">
      <div class="wrapper clearfix">
		<?php $this->load->view('./inc/u_navigation.php'); ?>
        <div class="account-content clearfix">
            <div class="container-1 overview-headline clearfix">
            	<h2>Vote for Coins</h2>
            </div>
            <div class="account-form account-vote clearfix">
            	<?php
				if(isset($template['error']) && $template['error'] != '')
				{
					echo '<div class="notice-container"><div class="success clearfix" id="notice"><div class="notice-inner"><p>'.$template['error'].'</p></div></div></div>';
				}
				
				if($template['suspended'])
				{
					echo '<br><div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Your account has been suspended from voting!<br>Please contact <a href="'.$template['support_url'].'">support</a> for more information</p></div></div></div><br>';
				}				
				else
				{
					echo form_open('myaccount/vote/PostVote', array('class'=>"normal"));
					
					if (! empty($template['vote_site_1'])) { echo $template['vote_site_1'];} 	
					if (! empty($template['vote_site_2'])) { echo $template['vote_site_2'];} 	
					if (! empty($template['vote_site_3'])) { echo $template['vote_site_3'];} 	
					if (! empty($template['vote_site_4'])) { echo $template['vote_site_4'];} 	
					if (! empty($template['vote_site_5'])) { echo $template['vote_site_5'];} 					
					
					echo '<section class="buttons">';
					echo '<button name="send" type="submit" class="button" value="True" > <span class="button"> <span class="button-inner">Vote Now</span> </span> </button>';
					echo '</section>';					
					echo form_close();
				}				
				
				?>          
            </div>        
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./inc/footer.php'); ?>