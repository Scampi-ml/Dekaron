<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 06:38:57
         compiled from "application\views\inc\view_footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19647533fa501c6a6f6-03822725%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38a59f26e2b9734add981ac278b9651b19458307' => 
    array (
      0 => 'application\\views\\inc\\view_footer.tpl',
      1 => 1395383203,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19647533fa501c6a6f6-03822725',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BASE_URL' => 0,
    'push_js' => 0,
    'foo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533fa501ce6463_66593763',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533fa501ce6463_66593763')) {function content_533fa501ce6463_66593763($_smarty_tpl) {?>            	<div class="clear"></div>
            </div>            
            <footer>
                <div class="left-side">
                    <p>All righs reserved &copy; <a href="http://www.janvier123.be">Janvier123.be</a> <br/></p>
                    <!--
                    <div class="site-credits"> 
                        <a href="#" rel="nofollow" target="_blank" ></a>
                	</div>
                    -->
                </div>
                <div class="right-side">
                    <ul>
                        <li><a href="#">Footer Link 1</a></li>
                        <li><a href="#">Footer Link 2</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 3</a></li>
                        <li><a href="#">Footer Link 4</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 5</a></li>
                        <li><a href="#">Footer Link 6</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 7</a></li>
                        <li><a href="#">Footer Link 8</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 9</a></li>
                        <li><a href="#">Footer Link 10</a></li>
                    </ul>                                                                                                   
                </div>
            </footer>
        </section>
    </body>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/js/ui.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/js/main.js"></script>          

    <?php if (isset($_smarty_tpl->tpl_vars['push_js']->value)) {?> 
        <?php  $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['foo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['push_js']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->key => $_smarty_tpl->tpl_vars['foo']->value) {
$_smarty_tpl->tpl_vars['foo']->_loop = true;
?>
             <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/js/<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
"></script>
        <?php } ?>  
    <?php }?>      
</html>
<?php }} ?>
