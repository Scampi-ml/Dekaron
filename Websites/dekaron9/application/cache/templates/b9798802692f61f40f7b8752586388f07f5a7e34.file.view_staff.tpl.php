<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 06:48:29
         compiled from "application\views\view_staff.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15097533fa73dafb149-33656031%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9798802692f61f40f7b8752586388f07f5a7e34' => 
    array (
      0 => 'application\\views\\view_staff.tpl',
      1 => 1395134454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15097533fa73dafb149-33656031',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'gravatar_img' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533fa73dbc2ae2_30684730',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533fa73dbc2ae2_30684730')) {function content_533fa73dbc2ae2_30684730($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("inc/view_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Staff</p></h1>
            
            <article class="main_box">
                <div class="main_box_body" >
                    <div class="avatar90"><img src="<?php echo $_smarty_tpl->tpl_vars['gravatar_img']->value;?>
"  ></div>
                    	<h2><a href="" data-tip="View Profile">Nickname ~ Leader</a></h2>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin orci nisl, sollicitudin id diam quis, egestas dictum leo. Proin in placerat lorem. In ornare sed arcu vel commodo. Donec cursus sem eros, a pretium velit suscipit vitae. 
                    <div class="clear"></div>
                </div>
            </article>
            <br />
            <article class="main_box">
                <div class="main_box_body" >
                    <div class="avatar90"><img src="<?php echo $_smarty_tpl->tpl_vars['gravatar_img']->value;?>
" ></div>
                    	<h2><a href="" data-tip="View Profile">Nickname ~ Dev</a></h2>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin orci nisl, sollicitudin id diam quis, egestas dictum leo. Proin in placerat lorem. In ornare sed arcu vel commodo. Donec cursus sem eros, a pretium velit suscipit vitae.
                    <div class="clear"></div>
                </div>
            </article> 
            <br />
            <article class="main_box">
                <div class="main_box_body" >
                    <div class="avatar90"><img src="<?php echo $_smarty_tpl->tpl_vars['gravatar_img']->value;?>
" ></div>
                    	<h2><a href="" data-tip="View Profile">Nickname ~ GM</a></h2>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin orci nisl, sollicitudin id diam quis, egestas dictum leo. Proin in placerat lorem. In ornare sed arcu vel commodo. Donec cursus sem eros, a pretium velit suscipit vitae.
                    <div class="clear"></div>
                </div>
            </article>  
            <br />
            <article class="main_box">
                <div class="main_box_body" >
                    <div class="avatar90"><img src="<?php echo $_smarty_tpl->tpl_vars['gravatar_img']->value;?>
"  ></div>
                    	<h2><a href="" data-tip="View Profile">Nickname ~ GM</a></h2>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin orci nisl, sollicitudin id diam quis, egestas dictum leo. Proin in placerat lorem. In ornare sed arcu vel commodo. Donec cursus sem eros, a pretium velit suscipit vitae.
                    <div class="clear"></div>
                </div>
            </article>                                 

        </article>
    </div>
</aside>      
<?php echo $_smarty_tpl->getSubTemplate ("inc/view_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
