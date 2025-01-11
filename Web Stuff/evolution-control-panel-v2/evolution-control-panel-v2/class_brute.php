<?php

class Brute {

	public static function bruteCheck($failed_attempt = false)
	{
		$deny_login = false;
	
		if(!file_exists(MM_BRUTE_FILE)) touch(MM_BRUTE_FILE);
		$cache = unserialize(Brute::fileToString(MM_BRUTE_FILE));
		if(!$cache) $cache = array();
	
		if($failed_attempt)
		{
			if(!isset($cache[$_SERVER['REMOTE_ADDR']]))
			{
				$cache[$_SERVER['REMOTE_ADDR']] = array();
			}
			$cache[$_SERVER['REMOTE_ADDR']][] = time();
			if(count($cache[$_SERVER['REMOTE_ADDR']]) > MM_BRUTE_ATTEMPTS) array_shift($cache[$_SERVER['REMOTE_ADDR']]);
		}
	
		//get the number of failed attempts in the last 15 minutes
		if(!isset($cache[$_SERVER['REMOTE_ADDR']]))
		{
			$deny_login = false;
		}
		else
		{
			$attempts = $cache[$_SERVER['REMOTE_ADDR']];
			if(count($attempts) < MM_BRUTE_ATTEMPTS)
			{
				$deny_login = false;
			}
			else
			{
				if($attempts[0] + MM_BRUTE_WINDOW > time())
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
				if($attempts[count($attempts)-1] + MM_BRUTE_WINDOW < time())
				{
					unset($cache[$ip]);
				}
			}
		}
	
		Brute::stringToFile(MM_BRUTE_FILE, serialize($cache));
	
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
