<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Account creation</p></h1>
            <section class="body">
            	<?php echo form_open('register/CheckRegister', array('class'=>"page_form")); ?>
                	<?php echo validation_errors(); ?>
                    <table style="width:100%" cellspacing="10">
                        <tr>
                            <td><label for="register_username">Username <span style="color:#FF0000">*</span></label></td>
                            <td>
                            	<input required="required" placeholder="Enter Username" tabindex="1" type="text" name="Username" id="Username" value=""/>
                                <br />
                                &nbsp;&nbsp;3-14 characters. Letters and numbers only.
                            </td>
                        </tr>
                        <tr>
                            <td><label for="register_password">Password <span style="color:#FF0000">*</span></label></td>
                            <td>
                            	<input required="required" placeholder="Enter Password" tabindex="2" type="password" name="Password" id="Password" value="" />
                                <br />
                                &nbsp;&nbsp;6-16 characters. Letters and numbers only.
                            </td>
                        </tr>
                        <tr>
                            <td><label for="register_password_confirm">Confirm password <span style="color:#FF0000">*</span></label></td>
                            <td>
                            	<input required="required" placeholder="Re-enter Password" tabindex="3" type="password" name="rePassword" id="rePassword" value="" />
                                <br />
                                &nbsp;&nbsp;Your password again.
                            </td>
                        </tr>                        
                        <tr>
                            <td><label for="register_email">Email <span style="color:#FF0000">*</span></label></td>
                            <td>
                            	<input required="required" placeholder="Enter Email" tabindex="4" type="email" name="emailAddress" id="emailAddress" value=""/>
                                <br />
                                &nbsp;&nbsp;Your E-Mail Address is important! Ex: Reset your password.
                             </td>
                        </tr>
                        <tr>
                            <td><label for="register_email">Confirm Email <span style="color:#FF0000">*</span></label></td>
                            <td>
                            	<input required="required" placeholder="Re-enter E-Mail Address" tabindex="5" type="email" name="reEmailAddress" id="reEmailAddress" value=""/>
                                <br />
                                &nbsp;&nbsp;Your E-Mail Address is important! Ex: Reset your password.
                             </td>
                        </tr>                        
                        <?php if($this->config->item('reffer_active')) { ?>
                            <tr>
                                <td><label for="register_password_confirm">Refferal ID</label></td>
                                <td>
                                    <input type="text" placeholder="Enter Refferal ID" tabindex="6" name="reffer" id="reffer" value="<?php echo @$template['reffer']; ?><?php echo set_value('reffer'); ?>"/>
                                    <br />
                                    &nbsp;&nbsp;14 characters. Numbers only.
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>                        
                        <tr>
                            <td><input tabindex="7" id="rules" name="rules" required="required" value="2" type="checkbox"></td>
                            <td>I understand and agree with the <a rel="nofollow" href="<?php echo $template['tos_url']; ?>">Terms of Use</a>.</td>
                        </tr>                        
                    </table>
                    <center style="margin-bottom:10px;">
                    	<input type="submit" name="login_submit" value="Create account!" />
                    </center>
                </form>
                <p>&nbsp;&nbsp;<span style="color:#FF0000">*</span> Required information</span></p>
            </section>
        </article>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>