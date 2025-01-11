<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 06:38:57
         compiled from "application\views\inc\view_side.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21017533fa501a89798-83118482%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1bdaba62d1945f69b5ae2bd738ddf95649d13d5' => 
    array (
      0 => 'application\\views\\inc\\view_side.tpl',
      1 => 1396508817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21017533fa501a89798-83118482',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SITE_URL' => 0,
    'form_side_login' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533fa501b1d198_81678026',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533fa501b1d198_81678026')) {function content_533fa501b1d198_81678026($_smarty_tpl) {?><div class="top-menu-holder">
    <ul id="top_menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
home" direct="0">Home</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
register" direct="0">Register</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
download" direct="0">Download</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
server_info" direct="0">Server Info</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
vote" direct="1">Vote</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
community" direct="1">Forums</a></li>
    </ul>
    <div class="menu-image"></div>
</div> 
<div id="main">
    <aside id="left">
    	<a class="sidebar-banner register" href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
register" title="Create new Account"><h1>CREATE NEW ACCOUNT</h1><h2>Become a part of our community!</h2></a>
        <a class="sidebar-banner register" href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
donate" title="Donate and get coins!"><h1>DONATE</h1><h2>Donate and get coins!</h2></a>
        <!--
        <article>
            <h1 class="top">Login</h1>
            <section class="body">
            	<?php echo $_smarty_tpl->tpl_vars['form_side_login']->value;?>

                    <center id="sidebox_login">
                        <input tabindex="9" required="required" maxlength="32" id="login_username" name="Username" value="" placeholder="Enter Username" type="text">
                        <input tabindex="10" required="required" maxlength="30" id="login_password" name="Password" value="" placeholder="Enter Password" type="password">
                        <input tabindex="11" type="submit" name="login_submit" value="Login">
                    </center>
               </form>
            </section>
        </article> 
        -->  
        <a class="sidebar-banner teamspeak" href="#" title="Teamspeak"><h1>TEAMSPEAK</h1><h2>Talk with other members!</h2></a>
        <?php echo $_smarty_tpl->getSubTemplate ("inc/view_left_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </aside><?php }} ?>
