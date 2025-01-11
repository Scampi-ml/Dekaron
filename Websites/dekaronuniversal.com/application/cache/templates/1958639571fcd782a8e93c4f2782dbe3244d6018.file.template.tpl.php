<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:34:01
         compiled from "application/themes/dkuniversal/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85266343653facac996a5b9-55467649%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1958639571fcd782a8e93c4f2782dbe3244d6018' => 
    array (
      0 => 'application/themes/dkuniversal/template.tpl',
      1 => 1408685374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85266343653facac996a5b9-55467649',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'head' => 0,
    'menu_top' => 0,
    'menu_1' => 0,
    'sideboxes' => 0,
    'sidebox' => 0,
    'menu_side' => 0,
    'menu_2' => 0,
    'image_path' => 0,
    'show_slider' => 0,
    'slider' => 0,
    'image' => 0,
    'page' => 0,
    'serverName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facac9a54581_19515938',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facac9a54581_19515938')) {function content_53facac9a54581_19515938($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['head']->value;?>

	<body>
		<!--[if lte IE 8]>
			<style type="text/css">
				body {
					background-image:url(images/bg.jpg);
					background-position:top center;
				}
			</style>
		<![endif]-->
		<div id="popup_bg"></div>
		<div id="confirm" class="popup">
			<h1 class="popup_question" id="confirm_question"></h1>
			<div class="popup_links">
				<a href="javascript:void(0)" class="popup_button" id="confirm_button"></a>
				<a href="javascript:void(0)" class="popup_hide" id="confirm_hide" onClick="UI.hidePopup()">Cancel</a>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div id="alert" class="popup">
			<h1 class="popup_message" id="alert_message"></h1>
		
			<div class="popup_links">
				<a href="javascript:void(0)" class="popup_button" id="alert_button">Ok</a>
				<div style="clear:both;"></div>
			</div>
		</div>		
		<section id="wrapper">
            <div class="top-menu-holder">
                <ul id="top_menu">
                    <?php  $_smarty_tpl->tpl_vars['menu_1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu_1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_top']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu_1']->key => $_smarty_tpl->tpl_vars['menu_1']->value) {
$_smarty_tpl->tpl_vars['menu_1']->_loop = true;
?>
                        <li><a <?php echo $_smarty_tpl->tpl_vars['menu_1']->value['link'];?>
><?php echo $_smarty_tpl->tpl_vars['menu_1']->value['name'];?>
</a></li>
                    <?php } ?>
                </ul>
                <div class="menu-image"></div>
            </div>
			<div id="main">
				<aside id="left">
                                    
                    <a class="sidebar-banner register" href="/register/" title="Create new Account">
                    	<h1>CREATE NEW ACCOUNT</h1>
                        <h2>Become a part of our community!</h2>
                    </a>

					<?php  $_smarty_tpl->tpl_vars['sidebox'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sidebox']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sideboxes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sidebox']->key => $_smarty_tpl->tpl_vars['sidebox']->value) {
$_smarty_tpl->tpl_vars['sidebox']->_loop = true;
?>
						<article>
							<h1 class="top"><?php echo $_smarty_tpl->tpl_vars['sidebox']->value['name'];?>
</h1>
							<section class="body">
								<?php echo $_smarty_tpl->tpl_vars['sidebox']->value['data'];?>

							</section>
						</article>
					<?php } ?>

                    <a class="sidebar-banner teamspeak" href="/page/ts/" title="Teamspeak">
                    	<h1>TEAMSPEAK</h1>
                        <h2>Talk with other members!</h2>
                    </a>

					<article>
						<h1 class="top">Main menu</h1>
						<ul id="left_menu">
							<?php  $_smarty_tpl->tpl_vars['menu_2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu_2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_side']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu_2']->key => $_smarty_tpl->tpl_vars['menu_2']->value) {
$_smarty_tpl->tpl_vars['menu_2']->_loop = true;
?>
								<li><a <?php echo $_smarty_tpl->tpl_vars['menu_2']->value['link'];?>
><img src="<?php echo $_smarty_tpl->tpl_vars['image_path']->value;?>
bullet.png"><?php echo $_smarty_tpl->tpl_vars['menu_2']->value['name'];?>
</a></li>
							<?php } ?>
						</ul>
					</article>
					
				</aside>

				<aside id="right">
					<section id="slider_bg" <?php if (!$_smarty_tpl->tpl_vars['show_slider']->value) {?>style="display:none;"<?php }?>>
                    	<div class="slider-overlay"></div>
						<div id="slider">
							<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slider']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
								<a href="<?php echo $_smarty_tpl->tpl_vars['image']->value['link'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['image']->value['image'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['image']->value['text'];?>
"/></a>
							<?php } ?>
						</div>
					</section>
					<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

				</aside>

				<div class="clear"></div>
			</div>
			<footer>
                <div class="center">
                	<p>All righs reserved &copy;  Copyright <?php echo date("Y");?>
 <a href="/"><?php echo $_smarty_tpl->tpl_vars['serverName']->value;?>
</a></p>
                </div>
			</footer>
		</section>
	</body>
</html><?php }} ?>
