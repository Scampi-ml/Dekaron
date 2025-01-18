<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<div class="container content">
    <div id="pages">
        <div id="account-index" class="pages-inner">
            <div class="wrapper clearfix">

					<?php 
                    if($template['message'] != '')
                    {
                        echo $template['message'];	
                    }
                    else
                    {
                        ?>
                            <center>
                                <h2>We are redirecting you to <?php echo $template['redirect_name']; ?></h2><br />
                                <div class="spinner"><img src="<?php echo base_url('assets/images/donate/spinner-large.gif'); ?>"/></div>
                                <br /><br />
                                <br /><br />
                                <small>If you are not redirected in the next 5 seconds please click <a href="<?php echo $template['redirect_url']; ?>" target="_blank">here</a>.</small>               
                            </center>                
                        <?php
                    }
                    ?>                   
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
