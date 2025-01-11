<?php
function fetch_ip()
{
	if(isset($_SERVER['HTTP_CF_CONNECTING_IP']))
	{
		return $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	else
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}
?>	