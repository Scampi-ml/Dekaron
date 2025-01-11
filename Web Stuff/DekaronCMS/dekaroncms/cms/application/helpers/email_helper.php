<?php
function sendMail($receiver, $sender, $subject, $message)
{
	static $CI;

	if(!$CI)
	{
		$CI = &get_instance();
	}

	$config['protocol'] = "smtp";
	$config['smtp_host'] = $CI->config->item('smtp_host');
	$config['smtp_user'] = $CI->config->item('smtp_user');
	$config['smtp_pass'] = $CI->config->item('smtp_pass');
	$config['smtp_port'] = $CI->config->item('smtp_port');
	$config['crlf'] = "\r\n";
	$config['newline'] = "\r\n";
	

	// Configuration
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';

	$CI->load->library('email', $config);

	// Set email data
	$CI->email->from($sender, $CI->config->item('server_name'));
	$CI->email->to($receiver);
	$CI->email->subject($subject);
	$CI->email->message($message);

	// Send the email
	if(!$CI->email->send())
	{
		return false;
	}
	else 
	{
		return true;
	}
}