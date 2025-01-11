<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:52:08
         compiled from "application/modules/slider/views/slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171911266753facf08bc7336-13220377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab7c9715ef1b6b9386ceed3cb544b816fc873677' => 
    array (
      0 => 'application/modules/slider/views/slider.tpl',
      1 => 1361725228,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171911266753facf08bc7336-13220377',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'slider' => 0,
    'slider_home' => 0,
    'slider_interval' => 0,
    'slider_style' => 0,
    'slides' => 0,
    'slide' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facf08d6d763_28795447',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facf08d6d763_28795447')) {function content_53facf08d6d763_28795447($_smarty_tpl) {?><?php if (hasPermission("editSlider")) {?>
<section class="box big">
	<h2><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_settings.png"/> Slider settings</h2>

	<form onSubmit="Slider.saveSettings(this); return false">
		<label for="show_slider">Visibility</label>
		<select name="show_slider" id="show_slider">
			<option value="home" <?php if ($_smarty_tpl->tpl_vars['slider']->value&&$_smarty_tpl->tpl_vars['slider_home']->value) {?>selected<?php }?>>Only on homepage</option>
			<option value="always" <?php if ($_smarty_tpl->tpl_vars['slider']->value&&!$_smarty_tpl->tpl_vars['slider_home']->value) {?>selected<?php }?>>Always</option>
			<option value="never" <?php if (!$_smarty_tpl->tpl_vars['slider']->value) {?>selected<?php }?>>Never</option>
		</select>

		<label for="slider_interval">Slider interval (in seconds)</label>
		<input type="text" name="slider_interval" id="slider_interval" value="<?php echo $_smarty_tpl->tpl_vars['slider_interval']->value/1000;?>
"/>

		<label for="slider_style">Slider transition style</label>
		<select name="slider_style" id="slider_style">
			<option value="" <?php if (!$_smarty_tpl->tpl_vars['slider_style']->value) {?>selected<?php }?>>Random (all)</option>
			<option value="bars" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="bars") {?>selected<?php }?>>Bars</option>
			<option value="blinds" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="blinds") {?>selected<?php }?>>Blinds</option>
			<option value="blocks" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="blocks") {?>selected<?php }?>>Blocks</option>
			<option value="blocks2" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="blocks2") {?>selected<?php }?>>Blocks2</option>
			<option value="concentric" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="concentric") {?>selected<?php }?>>Concentric</option>
			<option value="dissolve" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="dissolve") {?>selected<?php }?>>Dissolve</option>
			<option value="slide" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="slide") {?>selected<?php }?>>Slide</option>
			<option value="warp" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="warp") {?>selected<?php }?>>Warp</option>
			<option value="zip" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="zip") {?>selected<?php }?>>Zip</option>
			<option value="bars3d" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="bars3d") {?>selected<?php }?>>Bars3d</option>
			<option value="blinds3d" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="blinds3d") {?>selected<?php }?>>Blinds3d</option>
			<option value="cube" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="cube") {?>selected<?php }?>>Cube</option>
			<option value="tiles3d" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="tiles3d") {?>selected<?php }?>>Tiles3d</option>
			<option value="turn" <?php if ($_smarty_tpl->tpl_vars['slider_style']->value=="turn") {?>selected<?php }?>>Turn</option>
		</select>

		<input type="submit" value="Save settings" />
	</form>
</section>
<?php }?>

<section class="box big" id="main_slider">
	<h2>
		<img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_picture.png"/>
		Slides (<div style="display:inline;" id="slides_count"><?php if (!$_smarty_tpl->tpl_vars['slides']->value) {?>0<?php } else { ?><?php echo count($_smarty_tpl->tpl_vars['slides']->value);?>
<?php }?></div>)
	</h2>

	<?php if (hasPermission("addSlider")) {?>
	<span>
		<a class="nice_button" href="javascript:void(0)" onClick="Slider.add()">Create slide</a>
	</span>
	<?php }?>

	<ul id="slider_list">
		<?php if ($_smarty_tpl->tpl_vars['slides']->value) {?>
		<?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
?>
			<li>
				<table width="100%">
					<tr>
						<td width="10%">
							<?php if (hasPermission("editSlider")) {?>
								<a href="javascript:void(0)" onClick="Slider.move('up', <?php echo $_smarty_tpl->tpl_vars['slide']->value['id'];?>
, this)" data-tip="Move up"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_up.png" /></a>
								<a href="javascript:void(0)" onClick="Slider.move('down', <?php echo $_smarty_tpl->tpl_vars['slide']->value['id'];?>
, this)" data-tip="Move down"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_down.png" /></a>
							<?php }?>
						</td>
						<td width="25%"><b><?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
</b></td>
						<td width="30%"><?php echo $_smarty_tpl->tpl_vars['slide']->value['text'];?>
</td>
						<td width="20%"><a href="<?php echo $_smarty_tpl->tpl_vars['slide']->value['link'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['slide']->value['link_short'];?>
</a></td>
						<td style="text-align:right;">
							<?php if (hasPermission("editSlider")) {?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/slider/edit/<?php echo $_smarty_tpl->tpl_vars['slide']->value['id'];?>
" data-tip="Edit"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_edit.png" /></a>
							<?php }?>
							&nbsp;
							<?php if (hasPermission("deleteSlider")) {?>
							<a href="javascript:void(0)" onClick="Slider.remove(<?php echo $_smarty_tpl->tpl_vars['slide']->value['id'];?>
, this)" data-tip="Delete"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_minus.png" /></a>
							<?php }?>
						</td>
					</tr>
				</table>
			</li>
		<?php } ?>
		<?php }?>
	</ul>
</section>

<section class="box big" id="add_slider" style="display:none;">
	<h2><a href='javascript:void(0)' onClick="Slider.add()" data-tip="Return to slides">Slides</a> &rarr; New slide</h2>

	<form onSubmit="Slider.create(this); return false" id="submit_form">
		<label for="image">Image URL</label>
		<input type="text" name="image" id="image" placeholder="http://"/>

		<label for="link">Link (optional)</label>
		<input type="text" name="link" id="link" placeholder="http://"/>

		<label for="text">Image text (optional)</label>
		<input type="text" name="text" id="text"/>

		<input type="submit" value="Submit slide" />
	</form>
</section><?php }} ?>
