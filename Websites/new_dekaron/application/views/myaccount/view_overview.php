<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
      <div id="content_ajax">
        <article class="subpage">
          <h1 class="top sub-header">
            <p>User panel</p>
          </h1>
          <section class="body">
            <section id="ucp_top">
            	<a href="<?php echo site_url('myaccount/avatar'); ?>" id="ucp_avatar"><div>Change avatar</div><img src="<?php echo $this->gravatar->get_gravatar($this->session->userdata('email'), 120); ?>"> </a>
              <section id="ucp_info">
                <aside>
                  <table width="280">
                    <tbody>
                      <tr>
                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/user.png'); ?>"></td>
                        <td width="40%">Acc. Name</td>
                        <td width="50%"><a href="/profile/<?php echo $this->session->userdata('user_no'); ?>" data-tip="View profile"><?php echo $this->session->userdata('user_id'); ?></a> </td>
                      </tr>
                      <tr>
                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/award_star_bronze_1.png'); ?>"></td>
                        <td width="40%">Acc. Type</td>
                        <td width="50%">Player</td>
                      </tr> 
                      <tr>
                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/shield.png'); ?>"></td>
                        <td width="40%">Acc. status</td>
                        <td width="50%">Active</td>
                      </tr>                                           

                    </tbody>
                  </table>
                </aside>
                <aside>
                  <table width="280">
                    <tbody>
                      <tr data-tip="Earn voting points by voting for the server">
                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/lightning.png'); ?>"></td>
                        <td width="40%">Voting points</td>
                        <td width="50%">0</td>
                      </tr>
                      <tr data-tip="Earn donation points by donating money to the server">
                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/coins.png'); ?>"></td>
                        <td width="40%">Donation points</td>
                        <td width="50%">0</td>
                      </tr>

                      <tr>
                        <td width="10%"><img src="<?php echo base_url('assets/images/icons/date.png'); ?>"></td>
                        <td width="40%">Member since</td>
                        <td width="50%">2014-02-19</td>
                      </tr>
                    </tbody>
                  </table>
                </aside>
              </section>
              <div style="clear:both;"></div>
            </section>
            <a href="#" class="nice_button">Settings</a>
            &nbsp;&nbsp;
            <a href="#" class="nice_button">View Profile</a>
            <div class="ucp_divider"></div>
            <section id="ucp_buttons"> <br>
              <br>
              <br>
              <a href="<?php echo site_url('myaccount/account_settings'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/account_settings.png'); ?>)"></a> 
              <a href="<?php echo site_url('myaccount/account_info'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/account_info.png'); ?>)"></a> 
              <a href="<?php echo site_url('myaccount/donate'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/donate.png'); ?>)"></a> 
              <a href="<?php echo site_url('xxxx'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/item_shop.png'); ?>)"></a> 
              <a href="<?php echo site_url('myaccount/mailbox'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/mailbox.png'); ?>)"></a>
              <a href="<?php echo site_url('myaccount/unstuck'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/unstuck.png'); ?>)"></a>
              <a href="<?php echo site_url('myaccount/vote'); ?>" style="background-image:url(<?php echo base_url('assets/images/ucp/vote_4_us.png'); ?>)"></a>

              
              
              <div style="clear:both;"></div>
            </section>
          </section>
        </article>
      </div>
      
      
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      