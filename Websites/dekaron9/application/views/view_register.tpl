{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>Account creation</p></h1>
        <section class="body">
            	{$form_open}
                {if isset($validation_errors)}{$validation_errors}{/if}
                {if isset($errors)}{$errors}{/if}
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
                        <td><span style="color:#FF0000">*</span> I understand and agree with the <a rel="nofollow" href="{$SITE_URL}tos_url">Terms of Use</a>.</td>
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
{include file="inc/view_footer.tpl"}