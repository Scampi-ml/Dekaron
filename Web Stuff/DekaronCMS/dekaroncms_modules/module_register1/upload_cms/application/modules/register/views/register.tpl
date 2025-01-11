{form_open('register', 'class="page_form"')}
{if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if}
	<table style="width:80%">
		<tr>
			<td><label for="register_username">Username</label></td>
			<td><input type="text" name="register_username" id="register_username" value="{set_value('register_username')}" /></td>
		</tr>
		<tr>
			<td><label for="register_email">Email</label></td>
			<td><input type="email" name="register_email" id="register_email" value="{set_value('register_email')}" /></td>
		</tr>
		<tr>
			<td><label for="register_password">Password</label></td>
			<td><input type="password" name="register_password" id="register_password" value="{set_value('register_password')}" /></td>
		</tr>
		<tr>
			<td><label for="register_password_confirm">Confirm password</label></td>
			<td><input type="password" name="register_password_confirm" id="register_password_confirm" value="{set_value('register_password_confirm')}" /></td>
		</tr>
		{if $use_captcha === 'true'}
			<tr>
				<td><label for="captcha"><img src="{$base_url}application/modules/register/controllers/getCaptcha.php?{uniqid()}&length={$length}&width={$width}&height={$height}&distortionLevel={$distortionLevel}" /></label></td>
				<td><input type="text" name="register_captcha" id="register_captcha" autocomplete="off" /></td>
			</tr>
		{/if}
	</table>
	<center style="margin-bottom:10px;margin-top:10px;">
		<input type="submit" name="login_submit" value="Create account" />
	</center>
{form_close()}