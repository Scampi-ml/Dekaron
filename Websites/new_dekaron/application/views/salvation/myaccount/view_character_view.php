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
            	<h2>My Characters</h2>
            </div>
            <div class="account-form account-vote clearfix">
            	<?php
				if(!$template['chars'])
				{
					echo '<br><div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Your account does not have any characters. Please create a charater.</p></div></div></div><br>';
				}				
				else
				{
					foreach($template['characters'] as $character)
					{
					?>
                    <div class="vote-row">
                        <label for="vote">
                        <a href="<?php echo site_url('myaccount/characters/view/'.$character['character_no']); ?>"><img src="<?php echo base_url('assets/images/class/'.$character['byPCClass'].'_0.png'); ?>" /></a>
                        <br>
                        </label>
                        <?php echo $character['character_name']; ?>
                    </div>
					<?php
					}
				}				
				?>          
            </div>        
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./inc/footer.php'); ?>