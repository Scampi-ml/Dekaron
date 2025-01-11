{form_open('register', 'class="page_form"')}
{if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if}
	<table style="width:80%">
		<tr>
			<td><label for="register_username">{lang("username", "register")}</label></td>
			<td><input type="text" name="register_username" id="register_username" value="{set_value('register_username')}" /></td>
		</tr>
		<tr>
			<td><label for="register_email">{lang("email", "register")}</label></td>
			<td><input type="email" name="register_email" id="register_email" value="{set_value('register_email')}" /></td>
		</tr>
		<tr>
			<td><label for="register_password">{lang("password", "register")}</label></td>
			<td><input type="password" name="register_password" id="register_password" value="{set_value('register_password')}" /></td>
		</tr>
		<tr>
			<td><label for="register_password_confirm">{lang("confirm", "register")}</label></td>
			<td><input type="password" name="register_password_confirm" id="register_password_confirm" value="{set_value('register_password_confirm')}" /></td>
		</tr>
		{if $use_captcha}
			<tr>
				<td><label for="captcha"><img src="{$url}application/modules/register/controllers/getCaptcha.php?{uniqid()}" /></label></td>
				<td><input type="text" name="register_captcha" id="register_captcha" autocomplete="off" /></td>
			</tr>
		{/if}
	</table>
	<center style="margin-bottom:10px;">
		<input type="submit" name="login_submit" value="{lang("submit", "register")}" />
	</center>
{form_close()}