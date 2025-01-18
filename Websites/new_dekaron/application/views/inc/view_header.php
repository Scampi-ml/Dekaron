<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $template['title']; ?></title>
        <meta name="description" content="<?php echo $template['description'] ?>">
        <meta name="keywords" content="<?php echo $template['keywords'] ?>">
        <meta name="author" content="<?php echo $template['author'] ?>">
        <meta name="robots" content="index,follow"/>
        <meta name="googlebot" content="index,follow"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <?php echo put_css(); ?>
        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
        <![endif]-->  
        <script type="text/javascript">
        countdown_x1500 = '<?php print $this->config->item('deadfront_time'); ?>';
        var config2 = { baseUrl: '<?php echo base_url(); ?>' };
        var config = { siteUrl: '<?php echo site_url(); ?>/' };
        </script>  
        <link rel="shortcut icon" href="application/themes/ironwow/images/favicon.gif'); ?>" />
    </head>
    <body>
    	<section id="wrapper">
		<?php
			if(!$this->session->userdata('user_id'))
			{
				$this->load->view('inc/view_side_out.php'); 
			}
			else
			{
				$this->load->view('inc/view_side_in.php');
			}
        ?> 