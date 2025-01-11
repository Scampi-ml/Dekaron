<?php
class Update extends MX_Controller
{
	private $data;

	public $currentVersion;
	public $latestVersion;
	public $updates;
	public $db;
	private $password;


	public function __construct()
	{
		$this->load->library('administrator');
		$this->load->model('update_model');
		parent::__construct();
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Update");

		$this->getAvailableUpdates();

		$this->data['updates'] = $this->updates;
		$this->data['current_version'] = $this->administrator->getVersion();
		$this->data['url'] = $this->template->page_url;

		$output = $this->template->loadPage("update/update.tpl", $this->data);
		$content = $this->administrator->box('Update', $output);
		$this->administrator->view($content, false, "modules/admin/js/update.js");
	}

	private function getAvailableUpdates()
	{
		$this->updates = array();

		$updates = glob("application/updates/*/");

		if($updates)
		{
			foreach($updates as $path)
			{
				if(is_dir($path))
				{
					$version = preg_replace("/[a-z\/]*/i", "", $path);
					$version = preg_replace("/_/", ".", $version);

					$this->updates[$version] = array(
						"version" => $version,
						"sql" => $this->getSqls($path),
						"tools" => $this->getTools($path),
						"zip" => $this->getZips($path),
						"changelog" => (file_exists($path."index.html")) ? file_get_contents($path."index.html") : "",
						"instructions" => (file_exists($path."instructions.html")) ? file_get_contents($path."instructions.html") : ""
					);
				}
			}

			$this->updates = array_reverse($this->updates);
		}
	}
	
	private function getSqls($path)
	{
		if(file_exists($path."sql/"))
		{
			return glob($path."sql/*.sql");
		}
		else
		{
			return array();
		}
	}
	
	private function getTools($path)
	{
		if(file_exists($path."tools/"))
		{
			$tools = array();

			$found = glob($path."tools/*/");

			foreach($found as $toolPath)
			{
				if(is_dir($toolPath))
				{
					$name = preg_replace("/application\/updates\/[0-9_]+\/tools\/([a-z0-9-_]*)\//i", "$1", $toolPath);
					$tools[$toolPath] = $name;
				}
			}

			return $tools;
		}
		else
		{
			return array();
		}
	}
	
	private function getZips($path)
	{	
		if(file_exists($path."zip/"))
		{
			$zip = array();

			$found = glob($path."zip/*.zip");

			foreach($found as $zipPath)
			{
				$name = preg_replace("/application\/updates\/[0-9_]+\/zip\//i", "$1", $zipPath);
				$zip[$zipPath] = $name;		
			}

			return $zip;
		}
		else
		{
			return array();
		}
	}

	public function UpdateSql($version)
	{
		$this->administrator->setTitle("SQL Updates");
		
		$version = str_replace('.', '_', $version);
		$sqls = glob("application/updates/".$version."/sql/*.sql");

		$run = array();
		foreach($sqls as $sql)
		{
			$run[] = $this->update_model->DoSqlUpdates($sql);
		}

	
		$this->data['url'] = $this->template->page_url;
		$this->data['return'] = $run;

		$output = $this->template->loadPage("update/update_sql.tpl", $this->data);
		$content = $this->administrator->box('Updates -> SQL Updates', $output);
		$this->administrator->view($content, false, false);
	}	

	public function UpdateTool($version, $toolName)
	{
		adminPerm();
		$this->administrator->setTitle("Tool Updates");

		$version = preg_replace("/\./", "_", $version);
		require_once("application/updates/".$version."/tools/".$toolName."/".$toolName.".php");
		$toolName = ucfirst($toolName);
		$tool = new $toolName();

		$this->data['url'] = $this->template->page_url;
		$this->data['tool'] = $tool->run();

		$output = $this->template->loadPage("update/update_tool.tpl", $this->data);
		$content = $this->administrator->box('Updates -> Tool Updates', $output);
		$this->administrator->view($content, false, false);
	}

	public function UpdateZip($version, $zip)
	{
		
		adminPerm();
		$this->administrator->setTitle("Zip Updates");

		$path = 'application/updates/'.str_replace('.', '_', $version).'/';

		// remove deleted files
		if (file_exists($path.'delete_files.txt')) 
		{
			$files = file($path.'delete_files.txt');
			
			foreach ($files as $file) {
				@unlink(getcwd().$file);
			}
		}
		
		$file = $path . 'zip/' . $zip;

		$zip = new ZipArchive();
		if ($zip->open($file) !== true)
		{
			show_error('Could not open zip file: '.$file);
		}

		if ($zip->extractTo(getcwd()) !== true)
		{
			show_error('Zip extraction failed: '.$file);
		}
	
		$zip->close();

		$this->data['url'] = $this->template->page_url;


		$output = $this->template->loadPage("update/update_zip.tpl", $this->data);
		$content = $this->administrator->box('Updates -> Zip Updates', $output);
		$this->administrator->view($content, false, false);			
	}

	public function deleteUpdate($version)
	{
		$version = str_replace('.', '_', $version);
		$this->remove_directory('application/updates/' . $version);
		die("ok");
	}

    private function remove_directory($directory, $empty=FALSE)
    {
        if(substr($directory,-1) == '/') {
            $directory = substr($directory,0,-1);
        }

        if(!file_exists($directory) || !is_dir($directory)) {
            return FALSE;
        } elseif(!is_readable($directory)) {

        return FALSE;

        } else {

            $handle = opendir($directory);
            while (FALSE !== ($item = readdir($handle)))
            {
                if($item != '.' && $item != '..') {
                    $path = $directory.'/'.$item;
                    if(is_dir($path)) {
                        $this->remove_directory($path);
                    }else{
                        unlink($path);
                    }
                }
            }
            closedir($handle);
            if($empty == FALSE)
            {
                if(!rmdir($directory))
                {
                    return FALSE;
                }
            }
        return TRUE;
        }	
    }	

}