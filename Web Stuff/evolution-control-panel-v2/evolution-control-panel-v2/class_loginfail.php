<?php

class LoginFail {

	public static function LoginCheck($failed_attempt = false)
	{
		$deny_login = false;
	
		if(!file_exists(MM_LOGIN_FILE)) touch(MM_LOGIN_FILE);
		$cache = unserialize(LoginFail::fileToString(MM_LOGIN_FILE));
		if(!$cache) $cache = array();
	
		if($failed_attempt)
		{
			if(!isset($cache[$_SERVER['REMOTE_ADDR']]))
			{
				$cache[$_SERVER['REMOTE_ADDR']] = array();
			}
			$cache[$_SERVER['REMOTE_ADDR']][] = time();
			if(count($cache[$_SERVER['REMOTE_ADDR']]) > MM_LOGIN_ATTEMPTS) array_shift($cache[$_SERVER['REMOTE_ADDR']]);
		}
	
		//get the number of failed attempts in the last 15 minutes
		if(!isset($cache[$_SERVER['REMOTE_ADDR']]))
		{
			$deny_login = false;
		}
		else
		{
			$attempts = $cache[$_SERVER['REMOTE_ADDR']];
			if(count($attempts) < MM_LOGIN_ATTEMPTS)
			{
				$deny_login = false;
			}
			else
			{
				if($attempts[0] + MM_LOGIN_WINDOW > time())
				{ 
					$deny_login = true;
				}
				else
				{
					$deny_login = false;
				}
			}
		}
	
		foreach($cache as $ip=>$attempts)
		{
			if($attempts)
			{
				if($attempts[count($attempts)-1] + MM_LOGIN_WINDOW < time())
				{
					unset($cache[$ip]);
				}
			}
		}
	
		LoginFail::stringToFile(MM_LOGIN_FILE, serialize($cache));
	
		return $deny_login;
	}
	
	public static function fileToString($filename)
	{
		return file_get_contents($filename);
	}
	
	public static function stringToFile($filename, $data)
	{
		$file = fopen ($filename, "w");
		fwrite($file, $data);
		fclose ($file);
		return true;
	}
}
?>
