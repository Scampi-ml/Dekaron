<?php /* Smarty version Smarty-3.1.13, created on 2013-08-24 07:48:19
         compiled from ".\templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:281895218c7b30efe96-63640079%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0390f83576cc40b989c12a7362afcba143967e43' => 
    array (
      0 => '.\\templates\\login.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281895218c7b30efe96-63640079',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ERROR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5218c7b316a602_84127707',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5218c7b316a602_84127707')) {function content_5218c7b316a602_84127707($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DAC Login</title>
<link rel="stylesheet" type="text/css" href="style/login.css" />
</head>
<body>
<div align="center">
<div class="login" style="margin-top: 100px;">
<div class="login_title" align="left">Login</div>
<div class="login_reason" align="left">
<?php echo $_smarty_tpl->tpl_vars['ERROR']->value;?>

<form action="login.php" method="post" name="loginform" >
<table width="100%">                                
<tr>
<td>Username:</td>
<td><input class="text" name="sqlusername" type="text" /></td>
</tr>
<tr>
<td>Password:</td>
<td><input class="text" name="sqlpassword" type="password" /></td>
</tr>
<tr>
<td colspan="2" align="left">
<br>
<input class="text" type="submit" name="submitBtn" value="Login" />
</td>
</tr>
</table>
</form>  
</div>
</div>
</div>
</body>
</html>                                                                                                  <?php }} ?>