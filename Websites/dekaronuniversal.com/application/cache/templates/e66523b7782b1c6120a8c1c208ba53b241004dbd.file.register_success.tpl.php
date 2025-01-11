<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 06:55:17
         compiled from "application/modules/register/views/register_success.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131055276353faddd59351b6-28568825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e66523b7782b1c6120a8c1c208ba53b241004dbd' => 
    array (
      0 => 'application/modules/register/views/register_success.tpl',
      1 => 1407761923,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131055276353faddd59351b6-28568825',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'account' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53faddd5a578e7_38920517',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53faddd5a578e7_38920517')) {function content_53faddd5a578e7_38920517($_smarty_tpl) {?><script type="text/javascript">
        setTimeout(function(){
            window.location = "<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
ucp";
        }, 5000);
</script>

<span id="success">
    <?php echo lang("the_account","register");?>
 <b><?php echo $_smarty_tpl->tpl_vars['account']->value;?>
</b> <?php echo lang("has_been_created_redirecting","register");?>
 <?php echo anchor("ucp",lang("user_panel","register"));?>
...
</span>
<?php }} ?>
