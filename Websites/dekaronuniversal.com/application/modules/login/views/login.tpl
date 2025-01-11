{form_open('login', $class)}
{if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if}
	<table>
		<tr>
			<td><label for="login_username">{lang("username", "login")}</label></td>
			<td><input type="text" name="login_username" id="login_username" value="{$username}" placeholder="Username..." /></td>
		</tr>
		<tr>
			<td><label for="login_password">{lang("password", "login")}</label></td>
			<td><input type="password" name="login_password" id="login_password" value="" placeholder="Password..."/></td>
		</tr>
	</table>

	<center>
		<div id="remember_me">
			<label for="login_remember" data-tip="{lang("remember_me", "login")}">{lang("remember_me_short", "login")}</label>
			<input type="checkbox" name="login_remember" id="login_remember"/>
		</div>

		<input type="submit" name="login_submit" value="{lang("log_in", "login")}!" />
		<section id="forgot"><a href="{$url}password_recovery">{lang("lost_your_password", "login")}</a></section>

	</center>
</form>
