<?php
class Cache
{
	private $runtimeCache;
	private $enabled;
	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->runtimeCache = array();
	}

	public function get($name)
	{
		if(array_key_exists($name, $this->runtimeCache))
		{
			return $this->runtimeCache[$name];
		}
		else
		{
			$fileName = "application/cache/".$name.".cache";
			if($name == "dashboard")
			{
				$content = @file_get_contents("application/modules/admin/dashboard.notes");
				$data = json_decode($content, true);
				$this->runtimeCache[$name] = $data['content'];
				return $data['content'];				
			}

			if(file_exists($fileName))
			{
				$content = file_get_contents("application/cache/".$name.".cache");
				$data = json_decode($content, true);
				if(isset($data['expiration']))
				{
					if($data['expiration'] > time())
					{
						$this->runtimeCache[$name] = $data['content'];
						return $data['content'];
					}
					else
					{
						$this->runtimeCache[$name] = false;
						return false;
					}
				}
				else
				{
					$this->runtimeCache[$name] = false;
					return false;
				}
			}
			else
			{
				$this->runtimeCache[$name] = false;
				return false;
			}
		}
	}

	public function save($name, $data, $expiration = 31536000)
	{

		if($name == "dashboard")
		{
			$cache = array("content" => $data);
			$json = json_encode($cache);
			$fileName = "application/modules/admin/dashboard.notes";
			$file = fopen($fileName, 'w');
			fwrite($file, $json);
			fclose($file);			
		}
		else
		{
			$cache = array("expiration" => time() + $expiration,"content" => $data);
			$json = json_encode($cache);
			$fileName = "application/cache/".$name.".cache";
			$file = fopen($fileName, 'w');
			fwrite($file, $json);
			fclose($file);	
		}
	}

	public function delete($name, $templates = false)
	{
		if($templates){
			$matches = glob("application/cache/templates/".$name);
		}else{
			$matches = glob("application/cache/".$name);
		}
		
		if($matches)
		{
			foreach($matches as $file)
			{			
				$dont_delete = array('dashboard.notes','index.html', 'license.cache');

				if (array_key_exists($file, $dont_delete))
				{
				    continue;
				}
				if(is_dir($file))
				{
					$this->delete(preg_replace("/application\/cache\//", "", $file)."/*");
				}
				else
				{
					@unlink($file);
				}
			}
		}
	}

	public function deleteNews()
	{
		@unlink("application/cache/news.cache");
	}

	public function deleteAll()
	{
		$this->delete('*');
	}

	public function hasExpired($name, $matchRegex = false)
	{
		if(preg_match("/\*/", $name))
		{
			$matches = glob("application/cache/".$name);

			if(count($matches) && is_array($matches))
			{
				if($matchRegex)
				{
					foreach($matches as $file)
					{
						if(preg_match($matchRegex, $file))
						{
							$name = preg_replace("/application\/cache\/([A-Za-z0-9_-]*)\.cache/", "$1", $file);
						}
					}
				}
				else
				{
					$name = preg_replace("/application\/cache\/([A-Za-z0-9_-]*)\.cache/", "$1", $matches[0]);
				}
			}
			else
			{
				return true;
			}
		}

		if($this->get($name) !== false)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
