<?php /* Smarty version Smarty-3.1.16, created on 2014-09-13 09:43:16
         compiled from "application/themes/dkuniversal/modules/news/articles.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64341703853facad989f416-02402465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3edff598c6cf9bac631351ca4702f52298db843' => 
    array (
      0 => 'application/themes/dkuniversal/modules/news/articles.tpl',
      1 => 1410596232,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64341703853facad989f416-02402465',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facad99238e5_75275999',
  'variables' => 
  array (
    'articles' => 0,
    'article' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facad99238e5_75275999')) {function content_53facad99238e5_75275999($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>

	<article>
		<h1 class="news-head">
        	<a href="<?php echo $_smarty_tpl->tpl_vars['article']->value['link'];?>
" class="top"><?php echo $_smarty_tpl->tpl_vars['article']->value['headline'];?>
</a>
            <p><?php echo $_smarty_tpl->tpl_vars['article']->value['date'];?>
</p>
        </h1>
		<section class="body">
			<?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>

			<div class="clear"></div>
			<div class="news_bottom">
			</div>
		</section>
	</article>

<?php } ?>
<?php }} ?>
