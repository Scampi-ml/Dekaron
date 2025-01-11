<?php
require('../../../modules/register/controllers/captcha.php');
$captcha = new Captcha();
$captcha->generate($_GET['length']);
$captcha->output($_GET['width'], $_GET['height'], $_GET['distortionLevel']);