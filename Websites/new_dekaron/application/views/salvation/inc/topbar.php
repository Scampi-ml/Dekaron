<?php
if(!$this->session->userdata('user_id'))
{
?>
<div id="topbar" class="clearfix">
  <div class="container offline">
    <div class="topbar-inner englishtopbar">
      <ul>
        <li><a href="<?php echo site_url('home'); ?>">Home</a></li>
        <li><a href="<?php echo site_url('login'); ?>">Log in</a> or <a href="<?php echo site_url('register'); ?>">Register</a></li>
        <li><a href="<?php echo $template['faq_url']; ?>">FAQ</a></li>
        <li><a href="<?php echo $template['support_url']; ?>">Support</a></li>
      </ul>
    </div>
  </div>
</div>
<?php
} else {
?>
<div id="topbar" class="clearfix">
  <div class="container online">
    <div class="topbar-inner">
      <ul>
        <li class="no-link"> <?php echo $template['welcome_time']; ?>, <?php echo $this->session->userdata('user_id'); ?></li>
        <li><a href="<?php echo site_url('myaccount/donate'); ?>"><img src="<?php echo base_url('assets/images/coin_single_gold.png'); ?>" alt="Coins"> &nbsp;<?php echo number_format($this->session->userdata('coins')); ?></a></li>        
        <li><a href="<?php echo site_url('myaccount'); ?>">My Account</a></li>
        <li><a href="<?php echo $template['faq_url']; ?>">FAQ</a></li>
        <li><a href="<?php echo $template['support_url']; ?>">Support</a></li>
        <li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</div>
<?php
}
?>



