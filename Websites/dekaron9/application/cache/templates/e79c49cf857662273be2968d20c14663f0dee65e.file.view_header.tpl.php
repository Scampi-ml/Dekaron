<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 06:38:57
         compiled from "application\views\inc\view_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32096533fa501915341-53540750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e79c49cf857662273be2968d20c14663f0dee65e' => 
    array (
      0 => 'application\\views\\inc\\view_header.tpl',
      1 => 1396678190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32096533fa501915341-53540750',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'name' => 0,
    'description' => 0,
    'keywords' => 0,
    'author' => 0,
    'BASE_URL' => 0,
    'push_css' => 0,
    'css' => 0,
    'SITE_URL' => 0,
    'newsCat' => 0,
    'newsTotal' => 0,
    'changelogCat' => 0,
    'changelogTotal' => 0,
    'show_social' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533fa501a737a3_46517264',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533fa501a737a3_46517264')) {function content_533fa501a737a3_46517264($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<?php }?> - <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</title>
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">
        <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
        <meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['author']->value;?>
">
        <meta name="robots" content="index,follow"/>
        <meta name="googlebot" content="index,follow"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/css/default.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/css/cms.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/css/main.css" type="text/css" />
        <?php if (isset($_smarty_tpl->tpl_vars['push_css']->value)) {?> 
            <?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['push_css']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value) {
$_smarty_tpl->tpl_vars['css']->_loop = true;
?>
                <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/css/<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" type="text/css" />
            <?php } ?> 
        <?php }?>  
        <script type="text/javascript">
			var Config = {
				URL: "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
",			
				UseTooltip: 1,
				newsCat:"<?php echo $_smarty_tpl->tpl_vars['newsCat']->value;?>
",
				newsTotal:"<?php echo $_smarty_tpl->tpl_vars['newsTotal']->value;?>
",
				changelogCat:"<?php echo $_smarty_tpl->tpl_vars['changelogCat']->value;?>
",
				changelogTotal:"<?php echo $_smarty_tpl->tpl_vars['changelogTotal']->value;?>
"				
			};
        </script>
        <!--[if lt IE 9]>
            <script type="text/javascript" src=<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/js/html5shiv.js"></script>
        <![endif]-->  
        <link rel="shortcut icon" href="assets/images/favicon.gif" />
    </head>
    <body>
        <section id="socialNetworks"> 
			<?php echo $_smarty_tpl->tpl_vars['show_social']->value;?>

        </section>    
    	<section id="wrapper">
        <?php echo $_smarty_tpl->getSubTemplate ("inc/view_side.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
