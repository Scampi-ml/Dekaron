<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 07:00:35
         compiled from "application\views\view_register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20943533faa1313b1b9-25047073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16ab40de6136747587fa16202ead06f25596d2bf' => 
    array (
      0 => 'application\\views\\view_register.tpl',
      1 => 1396589072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20943533faa1313b1b9-25047073',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form_open' => 0,
    'validation_errors' => 0,
    'errors' => 0,
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533faa132430e0_03004230',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533faa132430e0_03004230')) {function content_533faa132430e0_03004230($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("inc/view_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>Account creation</p></h1>
        <section class="body">
            	<?php echo $_smarty_tpl->tpl_vars['form_open']->value;?>

                <?php if (isset($_smarty_tpl->tpl_vars['validation_errors']->value)) {?><?php echo $_smarty_tpl->tpl_vars['validation_errors']->value;?>
<?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['errors']->value)) {?><?php echo $_smarty_tpl->tpl_vars['errors']->value;?>
<?php }?>
                <table style="width:100%" cellspacing="10">
                    <tr>
                        <td><label for="register_username"><span style="color:#FF0000">*</span> Account Name </label></td>
                        <td>
                            <input required="required" placeholder="Enter Username" tabindex="1" type="text" name="Username" id="Username" value=""/>
                            <br />
                            &nbsp;&nbsp;4-16 characters. Letters and numbers only.
                        </td>
                    </tr>
                    <tr>
                        <td><label for="register_password"><span style="color:#FF0000">*</span> Password </label></td>
                        <td>
                            <input required="required" placeholder="Enter Password" tabindex="2" type="password" name="Password" id="Password" value="" />
                            <br />
                            &nbsp;&nbsp;4-16 characters. Letters and numbers only.
                        </td>
                    </tr>
                    <tr>
                        <td><label for="register_password_confirm"><span style="color:#FF0000">*</span> Confirm password </label></td>
                        <td>
                            <input required="required" placeholder="Re-enter Password" tabindex="3" type="password" name="rePassword" id="rePassword" value="" />
                            <br />
                            &nbsp;&nbsp;Your password again.
                        </td>
                    </tr>                        
                    <tr>
                        <td><label for="register_email"> <span style="color:#FF0000">*</span>Email </label></td>
                        <td>
                            <input required="required" placeholder="Enter Email" tabindex="4" type="email" name="emailAddress" id="emailAddress" value=""/>
                            <br />
                            &nbsp;&nbsp;Your E-Mail Address is important! Ex: Reset your password.
                         </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>                        
                    <tr>
                        <td><input tabindex="7" id="rules" name="rules" required="required" value="2" type="checkbox"></td>
                        <td><span style="color:#FF0000">*</span> I understand and agree with the <a rel="nofollow" href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
tos_url">Terms of Use</a>.</td>
                    </tr>                        
                </table>
                <center style="margin-bottom:10px;">
                    <input type="submit" value="Create account!" />
                </center>
            </form>
            <p>&nbsp;&nbsp;<span style="color:#FF0000">*</span> Required information</p>
        </section>
    </article>
</aside>
<?php echo $_smarty_tpl->getSubTemplate ("inc/view_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
