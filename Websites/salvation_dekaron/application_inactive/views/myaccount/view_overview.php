<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
	<?php 
    if (! empty($template['validated_notice']))
    { 
        echo $template['validated_notice'];
    } 
    ?>    
    <div id="account-index" class="pages-inner">
      <div class="wrapper clearfix">
		<?php $this->load->view('./inc/u_navigation.php'); ?>
        <div class="account-content clearfix">
          <div class="container-1 overview-headline clearfix">
            <h2>Account Overview</h2>            
          </div>
          <div class="account-form account-change-mail clearfix">
           
            <table width="100%">
              <tbody>
                <tr>
                  <td width="50%"><strong>Characters</strong> </td>
                  <td width="50%"><?php echo $template['CountCharacters']; ?> <small style="float:right;"><a href="account/characters">[View Characters]</a></small></td>
                </tr>
                <tr>
                  <td><strong>Username</strong></td>
                  <td><?php echo $this->session->userdata('user_id'); ?></td>
                </tr>
                <tr>
                  <td><strong>User Number</strong></td>
                  <td><?php echo $this->session->userdata('user_no'); ?></td>
                </tr>  
                <tr>
                  <td><strong>Account Age</strong></td>
                  <td><?php echo $template['lifetime']; ?> (<?php echo $template['reg_on']; ?>)</td>
                </tr>                                 
                <tr>
                  <td><strong>E-Mail Address</strong></td>
                  <td><?php echo $template['email']; ?> <?php echo $template['validated']; ?> </td>
                </tr>
                <tr>
                  <td><strong>D-Shop Coins</strong></td>
                  <td><?php echo number_format($this->session->userdata('coins')); ?> <small style="float:right;"><a href="account/characters">[Buy Coins]</a></small></td>
                </tr> 
                <!-- NOT IN USE
                <tr>
                  <td><strong>Infraction(s) </strong></td>
                  <td><small style="float:right;"><a href="">[View]</a></small></td>
                </tr>
                -->
              </tbody>
            </table>                 
            <br />
            <table width="100%">
              <tbody>                
                <tr>
                  <td width="50%"><strong>Online Status</strong></td>
                  <td width="50%"><?php echo $template['login_flag']; ?></td>
                </tr>               
                <tr>
                  <td><strong>Last Game Login</strong></td>
                  <td><?php echo $template['login_time']; ?></td>
                </tr> 
                <tr>
                  <td><strong>Last Game Logout</strong></td>
                  <td><?php echo $template['logout_time']; ?></td>
                </tr>                        
                <tr>
                  <td><strong>Last known IP</strong></td>
                  <td><?php echo $template['user_ip_addr']; ?></td>
                </tr>                                                                                              
              </tbody>
            </table>
            <br />
          </div>
          <div class="account-form account-change-mail clearfix">
          <p>If you didnt get your SN by email, you can send it again to your email address.</p>
          <p><font color="#FF0000">NOTE: You can only send this ONCE!</font></p>
          <a href="<?php echo site_url('myaccount/overview/SendSNOnce'); ?>"><u>Click here</u></a> to send your SN to: <?php echo $template['email']; ?>
          </div>
        </div>
        <div class="account-content clearfix account-characters"> </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./inc/footer.php'); ?>