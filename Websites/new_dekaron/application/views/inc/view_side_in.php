<div class="top-menu-holder">
    <ul id="top_menu">
        <li><a href="<?php echo site_url('home'); ?>" direct="0">Home</a></li>
        <li><a href="<?php echo site_url('connect'); ?>" direct="0">How to connect</a></li>
        <li><a href="<?php echo site_url('myaccount'); ?>" direct="0">User panel</a></li>
        <li><a href="<?php echo site_url('community'); ?>" direct="0">Community</a></li>
        <li><a href="<?php echo site_url('forum'); ?>" direct="0">Forums</a></li>
        <li><a href="<?php echo site_url('logout'); ?>" direct="0">Log out</a></li>
    </ul>
    <div class="menu-image"></div>
</div> 
<div id="main">
    <aside id="left">
        <a class="sidebar-banner vote" href="<?php echo site_url('register'); ?>" title="Vote"><h1>Vote Now</h1><h2>Vote 4 us and get coins!</h2></a>
        <article>
            <h1 class="top">My Account</h1>
            <section class="body">
                <section class="sidebox_info">
                    <h3><?php echo $template['welcome_time']; ?>, <?php echo $this->session->userdata('user_id'); ?></h3>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td><img src="<?php echo base_url('assets/images/icons/computer_error.png'); ?>" align="absmiddle"> Last IP</td>
                                <td>78.22.23.26</td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo base_url('assets/images/icons/computer.png'); ?>" align="absmiddle"> Current IP</td>
                                <td><?php echo $this->session->userdata('ip_address'); ?></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo base_url('assets/images/icons/lightning.png'); ?>" align="absmiddle"> Coins</td>
                                <td id="info_vp"><?php echo number_format($this->session->userdata('coins')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <a href="<?php echo site_url('myaccount'); ?>" class="nice_button">User panel</a>
                        <a href="<?php echo site_url('logout'); ?>" class="nice_button">Log out</a>
                    </center>
                </section>
            </section>
        </article>
        <a class="sidebar-banner teamspeak" href="login.htm" title="IRONWOW Teamspeak"><h1>TEAMSPEAK</h1><h2>Talk with other members!</h2></a>
        <?php $this->load->view('inc/view_left_menu.php'); ?>
    </aside>