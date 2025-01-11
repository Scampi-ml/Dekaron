<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:35:23
         compiled from "application/modules/admin/views/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63190389053facb1b57a874-04013626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7fc4f7b3f303ba6dd99deb74edd8ba6a2a2af9c' => 
    array (
      0 => 'application/modules/admin/views/dashboard.tpl',
      1 => 1407219425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63190389053facb1b57a874-04013626',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'php_version' => 0,
    'version' => 0,
    'url' => 0,
    'theme' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb1b61a122_07696415',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb1b61a122_07696415')) {function content_53facb1b61a122_07696415($_smarty_tpl) {?><div class="block block-tiles block-tiles-animated clearfix">
    <a href="javascript:void(0)" class="tile tile-width tile-themed themed-background-default">
        <i class="fa fa-gears"></i>
        <div class="tile-info">
            <div class="pull-left">PHP version</div>
            <div class="pull-right"><strong><?php echo $_smarty_tpl->tpl_vars['php_version']->value;?>
</strong></div>
        </div>
    </a>
    <a href="javascript:void(0)" class="tile tile-width tile-themed themed-background-leaf">
        <i class="fa fa-check"></i>
        <div class="tile-info">
            <div class="pull-left">CMS version</div>
            <div class="pull-right"><strong><?php echo $_smarty_tpl->tpl_vars['version']->value;?>
</strong></div>
        </div>
    </a> 
    <a <?php if (hasPermission("changeTheme")) {?>href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/theme"<?php } else { ?>href="javascript:void(0)"<?php }?> class="tile tile-width tile-themed themed-background-city">
        <i class="fa fa-picture-o"></i>
        <div class="tile-info">
            <div class="pull-left">Theme</div>
            <div class="pull-right"><strong><?php echo $_smarty_tpl->tpl_vars['theme']->value['name'];?>
</strong></div>
        </div>
    </a>     
</div><?php }} ?>
