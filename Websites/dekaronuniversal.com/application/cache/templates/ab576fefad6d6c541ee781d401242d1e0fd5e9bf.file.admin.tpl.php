<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:35:41
         compiled from "application/modules/news/views/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45374103153facb2d986f24-99519469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab576fefad6d6c541ee781d401242d1e0fd5e9bf' => 
    array (
      0 => 'application/modules/news/views/admin.tpl',
      1 => 1407223012,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45374103153facb2d986f24-99519469',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'news' => 0,
    'article' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb2da724b1_32526335',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb2da724b1_32526335')) {function content_53facb2da724b1_32526335($_smarty_tpl) {?><?php echo TinyMCE();?>

<div class="block block-themed">
    <div class="block-title">
        <div class="block-options">
            <?php if (hasPermission("canAddArticle")) {?>
                <a class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create article"  onClick="News.show()"><i class="fa fa-plus"></i></a>
            <?php }?>                
        </div>
        <h4>Articles (<?php if (!$_smarty_tpl->tpl_vars['news']->value) {?>0<?php } else { ?><?php echo count($_smarty_tpl->tpl_vars['news']->value);?>
<?php }?>)</h4>
    </div>
    <div class="block-content">
		<?php if ($_smarty_tpl->tpl_vars['news']->value) {?>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Headline</th>
                    <th>Author</th>
                    <th>Posted on</th>
                    <th></th>
                </tr>
            </thead>        
            <tbody>          
            <?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
            	<tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['article']->value['headline'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['article']->value['nickname'];?>
</td>
                    <td><?php echo date("Y/m/d H:i:s",$_smarty_tpl->tpl_vars['article']->value['timestamp']);?>
</td>
                    <td class="text-right">
                        <div class="btn-group">
                            <?php if (hasPermission("canEditArticle")) {?>
                            	<a class="btn btn-sm btn-success" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
news/admin/edit/<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
">Edit</a>
                            <?php }?>
                            &nbsp;
                            <?php if (hasPermission("canRemoveArticle")) {?>
                            	<a class="btn btn-sm btn-danger" onClick="News.remove(<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
, this)">Delete</a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>        
		<?php }?>
    </div>
</div>

<div id="add_news" style="display:none;">
	<section class="box big">
		<h2><a href='javascript:void(0)' onClick="News.show()" data-tip="Return to articles">Articles</a> &rarr; New article</h2>

		<form onSubmit="News.send(); return false">
			<label for="headline">Headline</label>
			<input type="hidden" id="headline" />
			
			<label for="news_content">
				Content
			</label>
		</form>
			<div style="padding:10px;">
				<textarea name="news_content" class="tinymce" id="news_content" cols="30" rows="10"></textarea>
			</div>
		<form onSubmit="News.send(); return false">
			<input type="submit" value="Submit article" />
		</form>
	</section>
</div><?php }} ?>
