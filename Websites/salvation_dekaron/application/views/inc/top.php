<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title><?php echo $template['title'] ?></title>
        <meta name="description" content="<?php echo $template['description'] ?>">
        <meta name="keywords" content="<?php echo $template['keywords'] ?>">
        <meta name="author" content="<?php echo $template['author'] ?>">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link type="image/x-icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" rel="Shortcut Icon">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/pages.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/nivo-slider.css'); ?>"  media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.tablesorter.pager.css'); ?>"  media="screen">
        <script>var config2 = { baseUrl: '<?php echo base_url(); ?>' };</script>
        <script>var config = { siteUrl: '<?php echo site_url(); ?>/' };</script>
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body id="<?php echo $template['body_id']; ?>" oncontextmenu="return false">