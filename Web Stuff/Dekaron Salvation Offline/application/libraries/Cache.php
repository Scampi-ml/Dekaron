<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cache
{
	private $runtimeCache;
	private $enabled;
	private $CI;

	public function __construct(){
		$this->CI = &get_instance();
		$this->runtimeCache = array();
		$this->enabled = true;
		$this->createFolders();
	}

	private function createFolders(){
		if(!file_exists("application/cache")){
			mkdir("application/cache");
			fopen("application/cache/index.html", "w");
		}

		if(!file_exists("application/cache/data")){
			mkdir("application/cache/data");
			fopen("application/cache/data/index.html", "w");
		}

		if(!file_exists("application/cache/templates")){
			mkdir("application/cache/templates");
			fopen("application/cache/templates/index.html", "w");
		}
	}

	public function get($name){
		if(strlen($name) > 100){
			die('Cache name is too long');
		}

		if(array_key_exists($name, $this->runtimeCache)){
			return $this->runtimeCache[$name];
		}else{
			$fileName = "application/cache/data/".$name.".cache";

			if(file_exists($fileName)){
				$content = file_get_contents("application/cache/data/".$name.".cache");
				$data = json_decode($content, true);

					$this->runtimeCache[$name] = false;
					return false;
				
			}else{
				$this->runtimeCache[$name] = false;
				return false;
			}
		}
	}

	public function save($name, $data, $expiration = 31536000){
		$cache = array(
					"expiration" => time() + $expiration,
					"content" => $data
				);

		$json = json_encode($cache);

		$fileName = "application/cache/data/".$name.".cache";

		$file = fopen($fileName, 'w');
		fwrite($file, $json);
		fclose($file);
	}

	public function delete($name){
		$matches = glob("application/cache/data/".$name);
		
		if($matches){
			foreach($matches as $file){
				if(is_dir($file)){
					$this->delete(preg_replace("/application\/cache\/data\//", "", $file)."/*");
				}else{
					unlink($file);
				}
			}
		}
	}

	public function hasExpired($name, $matchRegex = false){
		if(preg_match("/\*/", $name)){
			$matches = glob("application/cache/data/".$name);
			if(count($matches) && is_array($matches)){
				if($matchRegex){
					foreach($matches as $file){
						if(preg_match($matchRegex, $file)){
							$name = preg_replace("/application\/cache\/data\/([A-Za-z0-9_-]*)\.cache/", "$1", $file);
						}
					}
				}else{
					$name = preg_replace("/application\/cache\/data\/([A-Za-z0-9_-]*)\.cache/", "$1", $matches[0]);
				}
			}else{
				return true;
			}
		}

		if($this->get($name) !== false){
			return false;
		}else{
			return true;
		}
	}
}
