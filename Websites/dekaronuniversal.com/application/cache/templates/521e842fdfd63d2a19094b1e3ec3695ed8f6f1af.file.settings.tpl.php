<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:37:45
         compiled from "application/modules/admin/views/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150375463053facba9ac8cb6-01968448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '521e842fdfd63d2a19094b1e3ec3695ed8f6f1af' => 
    array (
      0 => 'application/modules/admin/views/settings.tpl',
      1 => 1407301170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150375463053facba9ac8cb6-01968448',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facba9b3dce5_66129112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facba9b3dce5_66129112')) {function content_53facba9b3dce5_66129112($_smarty_tpl) {?><h4 class="page-header">Website</h4>
<form onSubmit="Settings.saveWebsiteSettings(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Website title</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="title" placeholder="MyServer" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['title'];?>
" />
        </div>
    </div>        
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Server name</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="server_name" placeholder="MyServer" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['server_name'];?>
" />
        </div>
    </div>         
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Search engine: keywords (separated by comma)</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="keywords" placeholder="dekaron,private server,pvp" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['keywords'];?>
" />
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Search engine: description</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="description" placeholder="Best private server in the entire world!" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['description'];?>
" />
        </div>
    </div>            
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
        </div>
    </div>
</form><?php }} ?>
