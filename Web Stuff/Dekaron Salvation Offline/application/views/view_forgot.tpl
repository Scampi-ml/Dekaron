{include file="inc/view_header.tpl"}
<aside id="right">
    {if isset($start_errors) && !isset($message) && !isset($validation_errors)} 
        <article class="subpage">
            <h1 class="top sub-header"><p class="error">ERROR!</p></h1>
            <section class="body">
                    <div class="boxerror">
                        {$start_errors}
                    </div>
                    <br />
                    If you have any questions or problems, please visit our <a href="{$SITE_URL}forums/" target="_blank">support page</a>.<br />              
            </section>
         </article>
    {else}
        <article>
            <h1 class="news-head"><a class="top" href="#">Enter New Password</a></h1>
            <section class="body">   
                {if isset($message)}<div class="boxsuccess">{$message}</div>{/if} 
                {if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div> {/if}   
                {$form_open}
                <table style="width:100%" cellspacing="10">
                    <tr>
                        <td width="30%"><label for="register_email">Account Name</label></td>
                        <td width="70%"><input required="required" placeholder="Enter Account Name" type="text" name="accname" autocomplete="off" /></td>
                    </tr>               
                    <tr>
                        <td width="30%"><label for="register_password">New Password</label></td>
                        <td width="70%"><input required="required" placeholder="Enter New Password" type="password" name="NewPassword" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td width="30%"><label for="register_password_confirm">Confirm New password</label></td>
                        <td width="70%"><input required="required" placeholder="Confirm New Password" type="password" name="reNewPassword" autocomplete="off" /></td>
                    </tr>                 
                </table> 
                <center style="margin-bottom:10px;">
                    <input type="submit" name="submit" value="Change Password" />
                </center> 
                </form>                    
                <div class="clear"></div>
            </section>
        </article>	 
    {/if}
</aside>
{include file="inc/view_footer.tpl"}