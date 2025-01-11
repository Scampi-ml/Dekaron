{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>Account Management</p></h1>
    </article> 
    {if isset($message)}<div class="boxsuccess">{$message}</div>{/if}    
    {if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if}   

    <article>
        <h1 class="news-head"><a class="top" href="#">Forgot Password</a></h1>
        <section class="body">           
            {$form_open1}
                    
            <table style="width:100%" cellspacing="10">
                <tr>
                    <td width="30%"><label for="register_email">Account Name</label></td>
                    <td width="70%"><input required="required" placeholder="Enter Account Name" type="text" name="accname" autocomplete="off" />
                    <br />
                    Enter your username here and a reset link will be sent to your registered email address
                    </td>
                </tr>                                            
            </table>
            <center style="margin-bottom:10px;">
                <input type="submit" name="submit" value="Forgot Password" />
            </center>  
            </form>                  
    		<div class="clear"></div>
    	</section>
    </article>	    

    <article>
        <h1 class="news-head"><a class="top" href="#">Forgot Account Name</a></h1>
        <section class="body">         
            {$form_open2}
            <table style="width:100%" cellspacing="10">
                <tr>
                    <td width="30%"><label for="register_email">Email</label></td>
                    <td width="70%"><input required="required" placeholder="Enter Email" type="text" name="emailAddress" autocomplete="off"/>
                    <br />
                    Enter your email here and you will receive an email with your username and a link to reset your password
                    </td>
                </tr>                                            
            </table>  
            <center style="margin-bottom:10px;">
                <input type="submit" name="submit" value="Forgot Account Name" />
            </center>
            </form>                    
        	<div class="clear"></div>
        </section>
    </article>	    
        
    <article>
        <h1 class="news-head"><a class="top" href="#">Change Password</a></h1>
        <section class="body">         
            {$form_open3}
            <table style="width:100%" cellspacing="10">
                <tr>
                    <td width="30%"><label for="register_email">Account Name</label></td>
                    <td width="70%"><input required="required" placeholder="Enter Account Name" type="text" name="accname" autocomplete="off" /></td>
                </tr> 
                <tr>
                    <td width="30%"><label for="register_password">Current Password</label></td>
                    <td width="70%"><input required="required" placeholder="Enter Current Password" type="password" name="OldPassword" autocomplete="off" /></td>
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
    
    <article>
        <h1 class="news-head"><a class="top" href="#">Change Email</a></h1>
        <section class="body">         
            {$form_open4}
            <table style="width:100%" cellspacing="10">
                <tr>
                    <td width="30%"><label for="register_email">Account Name</label></td>
                    <td width="70%"><input required="required" placeholder="Enter Account Name" type="text" name="accname" autocomplete="off" /></td>
                </tr> 
                <tr>
                    <td width="30%"><label for="register_password">Password</label></td>
                    <td width="70%"><input required="required" placeholder="Enter Password" type="password" name="Password" autocomplete="off" /></td>
                </tr>                
                <tr>
                    <td width="30%"><label for="register_password">New Email</label></td>
                    <td width="70%"><input required="required" placeholder="Enter New Email" type="text" name="NewEmail" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td width="30%"><label for="register_password_confirm">Confirm New Email</label></td>
                    <td width="70%"><input required="required" placeholder="Confirm New Email" type="text" name="reNewEmail" autocomplete="off" /></td>
                </tr>                 
            </table> 
            <center style="margin-bottom:10px;">
                <input type="submit" name="submit" value="Change Email" />
            </center> 
            </form>                    
        	<div class="clear"></div>
        </section>
    </article>	    
    
        
</aside>
{include file="inc/view_footer.tpl"}