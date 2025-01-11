<?php
$CI =& get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $heading; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cms.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.gif" />
</head>
<body>
<section id="wrapper">
  <div id="main" style="padding: 30px 30px 30px 30px;">
    <h1 class="top sub-header2"><?php echo $heading; ?></h1>
    <div class="boxerror"><?php echo $message; ?></div>
    <br>
    <a href="#" class="nice_button" onClick="history.go(-1);">Go back</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo site_url('home'); ?>" class="nice_button">Homepage</a>
  </div>
</section>
</body>
</html>
