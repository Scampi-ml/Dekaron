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
                	<div class="register-info"> <span class="register-info-text"> <span style="color:#FF0000">*</span> Action 9 Game Registration</span> </div>
                    <?php echo form_open('register/CheckRegister', array('class'=>"normal")); ?>
                        <div id="register-form">
                        <?php echo validation_errors(); ?>
                        	<div class="form-row input">
                            	<iframe src="http://50.115.121.228/salvation/reg.html"></iframe>
								<span class="input-row-notice"> <small>Your E-Mail Address is important. For example, to reset your password. Please use a valid email!!!</small></span>
								<label for="rules">Please read the Terms of Use before creating your account.<a rel="nofollow" href="<?php echo $template['tos_url']; ?>"> Read them Here</a>.</label>
                     </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>