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
                        	<div class="form-row input">
                            	<span class="input-row-text">
                        			<label for="accountname">Username:<span style="color:#FF0000">*</span></label>
                        		</span>
                                <span class="input-row-left">
                        			<input tabindex="1" size="30" maxlength="16" id="Username" required="required" name="Username" class="input" autocomplete="off" value="<?php echo set_value('Username'); ?>" placeholder="Enter Username" type="text">
                        		</span>
                                <span class="input-row-notice"> <small>3-14 characters. Letters and numbers only.</small> <?php echo form_error('Username'); ?></span> 
                            </div>
                            <div class="form-row input">
                                <span class="input-row-text">
                                    <label for="password">Password: <span style="color:#FF0000">*</span></label>
                                </span>
                                <span class="input-row-left">
                                    <input tabindex="2" size="30" maxlength="16" id="Password" required="required" name="Password" class="input" autocomplete="off" value="" placeholder="Enter Password" type="password">
                                </span>
                                <span class="input-row-right">
                                    <input tabindex="3" size="30" maxlength="16" id="rePassword" required="required" name="rePassword" class="input" autocomplete="off" value="" placeholder="Re-enter Password" type="password">
                                </span>
                                <span class="input-row-notice"> <small>6-16 characters. Letters and numbers only.</small> <?php echo form_error('Password'); ?> <?php echo form_error('rePassword'); ?></span>
                            </div>
                            <div class="form-row input">
                                <span class="input-row-text">
                                    <label for="emailAddress">E-Mail Address: <span style="color:#FF0000">*</span></label>
                                </span>
                                <span class="input-row-left">
                                    <input tabindex="4" size="30" maxlength="320" id="emailAddress" required="required" name="emailAddress" class="input" autocomplete="on" value="<?php echo set_value('emailAddress'); ?>" placeholder="Enter E-Mail Address" type="email">
                                </span>
                                <span class="input-row-right">
                                    <input tabindex="5" size="30" maxlength="320" id="reEmailAddress" required="required" name="reEmailAddress" class="input" autocomplete="on" value="<?php echo set_value('reEmailAddress'); ?>" placeholder="Re-enter E-Mail Address" type="email">
                                </span>
                                <span class="input-row-notice"> <small>Your E-Mail Address is important for example to reset your password.</small> <?php echo form_error('emailAddress'); ?> <?php echo form_error('reEmailAddress'); ?></span>
                            </div>
                            <?php
							if($this->config->item('reffer_active')) {
							?>
                        	<div class="form-row input">
                            	<span class="input-row-text">
                        			<label for="accountname">Reffer:</label>
                        		</span>
                                <span class="input-row-left">
                        			<input tabindex="6" size="30" maxlength="18" id="reffer" name="reffer" class="input" autocomplete="off" placeholder="Enter refferal ID" type="text" value="<?php echo @$template['reffer']; ?><?php echo set_value('reffer'); ?>">
                        		</span>
                                <span class="input-row-notice"> <small>18 characters. Numbers only.</small> <?php echo form_error('reffer'); ?></span> 
                            </div> 
                            <?php
							}
							?>                                                      
                            <div class="form-row">
                                <span class="form-row-checkbox">
                                    <input tabindex="7" id="rules" name="rules" required="required" value="2" type="checkbox">
                                </span>
                                <span class="form-row-checkbox-text">
                                    <label for="rules">I understand and agree with the <a rel="nofollow" href="<?php echo $template['tos_url']; ?>">Terms of Use</a>.</label>
                                </span>
                                <span class="input-row-notice"><?php echo form_error('rules'); ?></span>
                            </div>
                            <div class="form-row form-row-button">
                                <span class="input-row-button">
                                    <button tabindex="8" name="registerButton" type="submit" class="button"> <span class="button"> <span class="button-inner">Create Account</span> </span> </button>
                                </span>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>