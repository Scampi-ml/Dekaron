<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Unstuck Character</p></h1>
            <section class="body">
            
            	<?php
				if(isset($template['online']))
				{
					echo '<br><div class="boxerror">Your account is online, you cannot use this while online.<br>Please logout!</div><br>';
				}	
				elseif(isset($template['no_chars']))
				{
					echo '<br><div class="boxerror">Your account has no character(s).</div><br>';
				}								
				else
				{ 
					?> 
					<?php echo form_open('myaccount/unstuck/DoUnstuck'); ?>
						<section class="filter_field">
							<label for="sort_by">Character Name</label>
							<select style="width:350px"  id="sort_by" name="character">
								<?php
									if($this->uri->segment(4) == '')
									{
										echo '<option value="" selected="selected">Select Character ...</option>';
									}
									else
									{
										echo '<option value="">Select Character ...</option>';
									}							
								
									$ListCharacters = $template['ListCharacters'];
									foreach($ListCharacters as $character)
									{					
										if(in_array($character['wMapIndex'], $this->config->item('unstuck_no_move')))
										{
											echo '<option class="error">'.$character['character_name'].' (Jailed, Cannot unstuck!)</font></option>';
										}
										else
										{
											echo '<option value="'.$character['character_no'].'">'.$character['character_name'].'</option>';
										}
									}                        
								?>
							</select>
							
							<input type="submit" class="nice_button" name="submit" value="Unstuck" />
						</section>                  
					<?php echo form_close(); ?>  
					<?php 
					if (!empty($template['message']))
					{ 
						echo '<br><div class="boxsuccess">'.$template['message'].'</div>';
					} 
					?>
                <?php 
				}
				?>                  
            </section>
        </article>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      