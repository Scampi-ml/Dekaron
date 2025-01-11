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
            <h2>Refer a Friend</h2>
          </div>
          <?php
		  	if($this->config->item('reffer_active')) {
		  ?>
          <div class="account-form account-vote clearfix">
            <div class="info"> <span class="info-text"> How it works! </span> </div>
            <form class="normal">
              <span class="refer-info">Send your own <strong>Ref-Link</strong> to a friend.</span>
              <div id="main-character-form">
                <div class="form-row input"> <span class="input-row-text">
                  <label for="link">Your Ref-Link:</label>
                  </span> <span class="input-row-left">
                  <input id="link" value="<?php echo site_url('ref/id/'.$this->session->userdata('user_no')); ?>" class="input" size="63" type="text">
                  </span> <span class="input-row-notice"> </span> </div>
              </div>
            </form>
            <div class="info"> <span class="info-text"> Rewards </span> </div>
            <span class="refer-info"> When a character of the referred player has reaches level <b><?php echo $this->config->item('reffer_min_level'); ?></b>, you will get the following rewards:<br>
            <ul>
            	<?php
					echo '<li>'.$this->config->item('reffer_reward').'</li>';
				?>
            </ul>
            </span> </div>
          <div id="account-table-view" class="tokenshop clearfix players-table-container">
            <table class="players-table">
              <thead>
                <tr>
                  <th class="players-cell players-align-left">Refferal Name</th>
                  <th class="players-cell players-align-left">Date</th>
                  <th class="players-cell players-align-right">Status</th>
                </tr>
              </thead>
              <tbody>
              		<?php
					$reffer_list = $template['reffer_list'];
					if($reffer_list)
					{
						foreach($reffer_list as $reffer)
						{
							?>
							<tr>
								<td class="players-cell players-cell-no-border players-align-left"><?php echo $reffer['ref_name']; ?></td>
								<td class="players-cell players-cell-no-border players-align-left"><?php echo date(DATE_RFC822, $reffer['datetime']); ?></td>
								<td class="players-cell players-cell-no-border players-align-right">
								<?php
                                if($reffer['ref_done'] == '1')
								{
									echo '<font style="color:green">Completed</font>';
								}
								else
								{
									echo '<font style="color:orange"><i>Waiting ...</i></font>';
								}
								?>
                                </td>
							</tr>					
							<?php
						}					
					}              
              		?>
              </tbody>
            </table>
          </div>
          <?php
		  } else { echo '<font color="#FF0000">Refer has been disabled.</font>'; }
		  ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./inc/footer.php'); ?>