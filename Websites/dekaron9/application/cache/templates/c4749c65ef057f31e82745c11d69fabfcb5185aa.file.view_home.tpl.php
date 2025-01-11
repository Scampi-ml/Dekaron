<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 06:39:31
         compiled from "application\views\view_home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15715533fa5017b06b8-41657483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4749c65ef057f31e82745c11d69fabfcb5185aa' => 
    array (
      0 => 'application\\views\\view_home.tpl',
      1 => 1396679969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15715533fa5017b06b8-41657483',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533fa5018fb8a1_24410793',
  'variables' => 
  array (
    'nivoSlider' => 0,
    'articles' => 0,
    'article' => 0,
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533fa5018fb8a1_24410793')) {function content_533fa5018fb8a1_24410793($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("inc/view_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<aside id="right">
    <section id="slider_bg" >
        <div class="slider-overlay"></div>
        <div id="slider" class="nivoSlider"><?php echo $_smarty_tpl->tpl_vars['nivoSlider']->value;?>
</div> 
    </section>
    
    
    <?php if ($_smarty_tpl->tpl_vars['articles']->value=='nonews') {?>
    	<div id="news_pagination">No News</div>
    <?php } else { ?>
        <?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
            <article>
                <h1 class="news-head"><a class="top" href="<?php echo $_smarty_tpl->tpl_vars['article']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['headline'];?>
</a><p><?php echo $_smarty_tpl->tpl_vars['article']->value['date'];?>
</p></h1>
                <section class="body">
                    <?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>

                    <div class="clear"></div>
                </section>
                <div class="news_bottom"> Posted by <a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
community/profile/<?php echo $_smarty_tpl->tpl_vars['article']->value['author'];?>
" data-tip="View profile"><?php echo $_smarty_tpl->tpl_vars['article']->value['author'];?>
</a> </div>
            </article>    
        <?php } ?>  
    <?php }?>
    
</aside>
<?php echo $_smarty_tpl->getSubTemplate ("inc/view_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
