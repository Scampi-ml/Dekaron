<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
    <div id="pages">
        <div class="pages-inner">
            <div class="container-box">
                <div class="login">
					<?php echo form_open('login/CheckLogin', array('class'=>"normal")); ?>
                        <div id="login-form">
                            <div class="form-row input">
                            	<span class="input-row-text">
                                	<label for="accountname">Username:</label>
                                </span>
                                <span class="input-row-left">
                                	<input tabindex="1" required="required" size="30" maxlength="32" id="Username" name="Username" class="input" value="" placeholder="Enter Username" type="text">
                                </span>
                                <span class="input-row-notice"> </span> 
                            </div>
                            <div class="form-row input">
                            	<span class="input-row-text">
                            		<label for="password">Password:</label>
                            	</span>
                                <span class="input-row-left">
                            		<input tabindex="2" required="required" size="30" maxlength="30" id="Password" name="Password" class="input" value="" placeholder="Enter Password" type="password">
                            	</span>
									<?php echo validation_errors(); ?>
									<?php 
									if (! empty($template['result']))
									{ 
                                    	echo ' <span class="input-row-notice">'.$template['result'].'</span>';
                                    } 
									?>                                                                   	 
                            </div>
                            <div class="form-row form-row-button">
                            	<span class="input-row-button">
                                	<button tabindex="4" name="loginButton" type="submit" class="button"> <span class="button"> <span class="button-inner">Log in</span> </span> </button>
                                </span>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    <div class="login-info"> <span class="login-info-text"> <a href="<?php echo site_url('forgot'); ?>">Forgot Password?</a> <br>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('inc/footer.php'); ?>