<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:36:26
         compiled from "application/modules/admin/views/cachemanager/cache.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125405671153facb5ad59090-53651983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c09afb1c324d4e9aac4ea8557c846682b11c9664' => 
    array (
      0 => 'application/modules/admin/views/cachemanager/cache.tpl',
      1 => 1407315977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125405671153facb5ad59090-53651983',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb5adce726_90254843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb5adce726_90254843')) {function content_53facb5adce726_90254843($_smarty_tpl) {?><script type="text/javascript">
	$(document).ready(function(){
		function checkIfLoaded(){
			if(typeof Cache != "undefined"){
				Cache.load();
			}else{
				setTimeout(checkIfLoaded, 50);
			}
		}
		checkIfLoaded();
	});
</script>
<p>You can manually clear cache to force database a reload of certain data. To minimize the server load, we recommended you to keep item cache intact no matter how big it becomes.</p>
<div id="cache_data"><span class="loader-01"></span> Loading, please wait</div>
<?php if (hasPermission("emptyCache")) {?>
    <p>
        <a class="btn btn-danger" href="javascript:void(0)" onClick="Cache.clear('website')">Clear website cache</a>&nbsp;
        <a class="btn btn-danger" href="javascript:void(0)" onClick="Cache.clear('template')">Clear Template cache</a>&nbsp;
        <a class="btn btn-danger" href="javascript:void(0)" onClick="Cache.clear('all')">Clear cache</a>
    </p>
<?php }?>
<?php }} ?>
