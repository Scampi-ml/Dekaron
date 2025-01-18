<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div id="vault" class="pages-inner">
      <div class="wrapper clearfix">
		<?php $this->load->view('./inc/u_navigation.php'); ?>
        <div class="account-content clearfix">
          <div class="container-1 overview-headline clearfix">
            <h2>Mailbox</h2>
          </div>
          <div id="account-table-view" class="tokenshop clearfix players-table-container">
            <div class="info" style="padding-top: 17px; margin-left: 10px;">
                <form method="post" accept-charset="utf-8" class="large" name="searchbox" >
                    <select onchange="location.href=this.options[this.selectedIndex].value;" class="select" required="required" id="selectsearch" name="selectsearch">
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
								if($this->uri->segment(4) == $character['character_no'])
								{
									echo '<option value="'.site_url().'/myaccount/mailbox/view/'.$character['character_no'].'" selected="selected">'.$character['character_name'].'</option>';
								}
								else
								{
									echo '<option value="'.site_url().'/myaccount/mailbox/view/'.$character['character_no'].'">'.$character['character_name'].'</option>';
								}
							}
                        ?>
                    </select>
                </form>
                </span>
            </div>            
            <div class="line">&nbsp;</div>     
            <table id="mailbox-id" class="players-table">
              <thead>
                <tr>
                  <th class="players-cell players-align-left">From</th>
                  <th class="players-cell players-align-left">Title</th>
                  <th class="players-cell players-align-left">Date</th>
                  <th class="players-cell players-align-right">Recieved Date</th>
                </tr>
              </thead>
              <tbody>
				<?php
					$mailbox_items = $template['viewall'];
					if($mailbox_items)
					{
						foreach($mailbox_items as $item)
						{
							?>
							<tr>
								<td class="players-cell players-cell-no-border players-align-left"><?php echo $item['from_char_nm']; ?></td>
								<td class="players-cell players-cell-no-border players-align-left"><?php echo $item['post_title']; ?></td>
								<td class="players-cell players-cell-no-border players-align-left"></td>
								<td class="players-cell players-cell-no-border players-align-right"><?php echo $item['ipt_time']; ?></td>
							</tr>					
							<?php
						}					
					}
				?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>