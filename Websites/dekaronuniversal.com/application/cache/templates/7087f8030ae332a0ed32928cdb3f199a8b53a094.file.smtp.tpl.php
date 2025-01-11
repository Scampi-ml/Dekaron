<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:37:42
         compiled from "application/modules/admin/views/smtp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186201799653facba69f1b63-35036267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7087f8030ae332a0ed32928cdb3f199a8b53a094' => 
    array (
      0 => 'application/modules/admin/views/smtp.tpl',
      1 => 1407301031,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186201799653facba69f1b63-35036267',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'smtp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facba6a69a08_68245748',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facba6a69a08_68245748')) {function content_53facba6a69a08_68245748($_smarty_tpl) {?><form onSubmit="Smtp.saveSmtpSettings(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP hostname</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_host" value="<?php echo $_smarty_tpl->tpl_vars['smtp']->value['smtp_host'];?>
" />
        </div>
    </div>  
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP username</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_user" value="<?php echo $_smarty_tpl->tpl_vars['smtp']->value['smtp_user'];?>
" />
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP password</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_pass" value="<?php echo $_smarty_tpl->tpl_vars['smtp']->value['smtp_pass'];?>
" />
        </div>
    </div>   
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP port</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_port" value="<?php echo $_smarty_tpl->tpl_vars['smtp']->value['smtp_port'];?>
" />
        </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
        </div>
    </div>                                                                    
</form><?php }} ?>
