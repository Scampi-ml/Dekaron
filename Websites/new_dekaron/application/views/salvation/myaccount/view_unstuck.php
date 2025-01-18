<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">  
    <div id="vote" class="pages-inner">
      <div class="wrapper clearfix">
		<?php $this->load->view('./inc/u_navigation.php'); ?>
        <div class="account-content clearfix">
            <div class="container-1 overview-headline clearfix">
            	<h2>Unstuck</h2>
            </div>
			<?php 
            if (! empty($template['message']))
            { 
                echo $template['message'];
            } 
            ?>                
            <?php echo validation_errors(); ?>
            <div class="account-form account-vote clearfix">
            	<?php				
				if(isset($template['online']))
				{
					echo '<br><div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Your account is online, you cannot use this while online.<br>Please logout!</p></div></div></div><br>';
				}	
				elseif(isset($template['no_chars']))
				{
					echo '<br><div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Your account has no character(s).</p></div></div></div><br>';
				}								
				else
				{
					echo form_open('myaccount/unstuck/DoUnstuck', array('class'=>"normal"));	
					foreach($template['ListCharacters'] as $char)
					{
						if(in_array($char['wLevel'], $this->config->item('unstuck_no_move')))
						{
							echo '<div class="vote-row">';
								echo '<label>';
									echo '<img src="'.base_url('assets/images/class/'.$char['byPCClass'].'_0.png').'">';
									echo '<br>';
									echo $char['character_name'];
									echo '<br>';
								echo '</label>';
								echo '<font color="#FF0000">Jailed</font>';
								echo '<br>';
							echo '</div>';	
						}
						else
						{
							echo '<div class="vote-row">';
								echo '<label>';
									echo '<img src="'.base_url('assets/images/class/'.$char['byPCClass'].'_0.png').'">';
									echo '<br>';
									echo $char['character_name'];
									echo '<br>';
								echo '</label>';
								echo '<input type="radio" value="'.$char['character_no'].'" name="character">';
								echo '<br>';
							echo '</div>';							
						}

						
					}
		
					
					echo '<section class="buttons">';
					echo '<button name="send" type="submit" class="button" value="True" > <span class="button"> <span class="button-inner">Set to home base</span> </span> </button>';
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