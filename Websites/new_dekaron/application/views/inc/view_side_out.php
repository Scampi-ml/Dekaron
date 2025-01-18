<div class="top-menu-holder">
    <ul id="top_menu">
        <li><a href="<?php echo site_url('home'); ?>" direct="0">Home</a></li>
        <li><a href="<?php echo site_url('register'); ?>" direct="0">Register</a></li>
        <li><a href="<?php echo site_url('page'); ?>" direct="0">How to connect</a></li>
        <li><a href="<?php echo site_url('login'); ?>" direct="0">Sign in</a></li>
        <li><a href="<?php echo site_url('vote'); ?>" direct="1">Vote</a></li>
        <li><a href="<?php echo site_url('community'); ?>" direct="1">Community</a></li>
    </ul>
    <div class="menu-image"></div>
</div> 
<div id="main">
    <aside id="left">
    	<a class="sidebar-banner register" href="<?php echo site_url('register'); ?>" title="Create new Account"><h1>CREATE NEW ACCOUNT</h1><h2>Become a part of our community!</h2></a>
        <article>
            <h1 class="top">Login</h1>
            <section class="body">
                <?php echo form_open('login/CheckLogin'); ?>
                    <center id="sidebox_login">
                        <input tabindex="9" required="required" maxlength="32" id="login_username" name="Username" value="" placeholder="Enter Username" type="text">
                        <input tabindex="10" required="required" maxlength="30" id="login_password" name="Password" value="" placeholder="Enter Password" type="password">
                        <input tabindex="11" type="submit" name="login_submit" value="Login">
                    </center>
                <?php echo form_close(); ?>
            </section>
        </article>   
        <a class="sidebar-banner teamspeak" href="login.htm" title="IRONWOW Teamspeak"><h1>TEAMSPEAK</h1><h2>Talk with other members!</h2></a>
        <?php $this->load->view('inc/view_left_menu.php'); ?>
    </aside>