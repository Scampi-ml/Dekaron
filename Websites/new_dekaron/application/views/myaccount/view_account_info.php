<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Account Info</p></h1>
            <section class="body">
                <table width="100%" cellspacing="10">
                    <tbody>
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/user.png'); ?>"></td>
                            <td width="40%">Account Name Name</td>
                            <td width="55%"><a href="/profile/<?php echo $this->session->userdata('user_no'); ?>" data-tip="View profile"><?php echo $this->session->userdata('user_id'); ?></a> </td>
                        </tr>
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/user.png'); ?>"></td>
                            <td width="40%">Account Type</td>
                            <td width="55%">Player</td>
                        </tr> 
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/user.png'); ?>"></td>
                            <td width="40%">Account status</td>
                            <td width="55%">Active</td>
                        </tr> 
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/user.png'); ?>"></td>
                            <td width="40%">User Number</td>
                            <td width="55%"><?php echo $this->session->userdata('user_no'); ?></td>
                        </tr> 
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/date.png'); ?>"></td>
                            <td width="40%">Account Age</td>
                            <td width="55%"><?php echo $template['lifetime']; ?> (<?php echo $template['reg_on']; ?>)</td>
                        </tr> 
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/email.png'); ?>"></td>
                            <td width="40%">E-Mail Address</td>
                            <td width="55%"><?php echo $template['email']; ?> <?php echo $template['validated']; ?></td>
                        </tr>  
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/coins.png'); ?>"></td>
                            <td width="40%">D-Shop Coins</td>
                            <td width="55%"><?php echo number_format($this->session->userdata('coins')); ?></td>
                        </tr>                            
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/world_add.png'); ?>"></td>
                            <td width="40%">Online status</td>
                            <td width="55%"><?php echo $template['login_flag']; ?></td>
                        </tr>
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/world_add.png'); ?>"></td>
                            <td width="40%">Last Game Login</td>
                            <td width="55%"><?php echo $template['login_time']; ?></td>
                        </tr>  
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/world_add.png'); ?>"></td>
                            <td width="40%">Last Game Logout</td>
                            <td width="55%"><?php echo $template['logout_time']; ?></td>
                        </tr>  
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/world_add.png'); ?>"></td>
                            <td width="40%">Last known IP</td>
                            <td width="55%"><?php echo $template['user_ip_addr']; ?></td>
                        </tr>   
                        <tr>
                            <td width="5%"><img src="<?php echo base_url('assets/images/icons/world_add.png'); ?>"></td>
                            <td width="40%">Current IP</td>
                            <td width="55%"><?php echo $this->session->userdata('ip_address'); ?></td>
                        </tr>                                                                       
                    </tbody>
                </table>
            </section>
        </article>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      