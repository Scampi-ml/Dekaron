<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
    <div id="pages">
        <div class="pages-inner">
            <div class="container-box">
                <div class="registration">
                	<div class="register-info"> <span class="register-info-text"> <span style="color:#FF0000">*</span> Required information</span> </div>
                    <?php echo form_open('register/CheckRegister', array('class'=>"normal")); ?>
                        <div id="register-form">
							<?php echo validation_errors(); ?>
                            <?php 
                            if(isset($template['errors']))
                            {
                                echo $template['errors'];
                            }
                            ?>
                        	<div class="form-row input">
                            	<span class="input-row-text">
                        			<label for="accountname">Username:<span style="color:#FF0000">*</span></label>
                        		</span>
                                <span class="input-row-left">
                        			<input tabindex="1" size="30" id="Username" required="required" name="Username" class="input" placeholder="Enter Username" type="text">
                        		</span>
                                <span class="input-row-notice"><small>4-12 characters. Letters and numbers only.</small></span>
                            </div>
                            <div class="form-row input">
                                <span class="input-row-text">
                                    <label for="password">Password: <span style="color:#FF0000">*</span></label>
                                </span>
                                <span class="input-row-left">
                                    <input tabindex="2" size="30" id="Password" required="required" name="Password" class="input" placeholder="Enter Password" type="password">
                                </span>
                                <span class="input-row-right">
                                    <input tabindex="3" size="30" id="rePassword" required="required" name="rePassword" class="input" placeholder="Re-enter Password" type="password">
                                </span>
                            </div>
                            <div class="form-row input">
                                <span class="input-row-text">
                                    <label for="emailAddress">E-Mail Address: <span style="color:#FF0000">*</span></label>
                                </span>
                                <span class="input-row-left">
                                    <input tabindex="4" size="30" id="emailAddress" required="required" name="emailAddress" class="input" placeholder="Enter E-Mail Address" type="email">
                                </span>
                                <span class="input-row-notice"><small>Your E-Mail Address is important for example to reset your password.</small></span>
                            </div>
                            <div class="form-row">
                                <span class="form-row-checkbox">
                                    <input tabindex="5" id="rules" name="rules" required="required" value="2" type="checkbox">
                                </span>
                                <span class="form-row-checkbox-text">
                                    <label for="rules">I understand and agree with the <a rel="nofollow" href="<?php echo $template['tos_url']; ?>">Terms of Use</a>.</label>
                                </span>
                            </div>
                            <div class="form-row form-row-button">
                                <span class="input-row-button">
                                    <button tabindex="8" name="registerButton" type="submit" class="button"> <span class="button"> <span class="button-inner">Create Account</span> </span> </button>
                                </span>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    <p>If the register page does not work, please <a href="http://50.115.121.228/salvation/reg.html"><u>click here.</u></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>