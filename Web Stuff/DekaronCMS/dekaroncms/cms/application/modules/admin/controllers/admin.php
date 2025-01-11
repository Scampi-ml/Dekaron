<?php
class Admin extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Dashboard");
		$data = array(
			'url' => $this->template->page_url,
			'theme' => $this->template->theme_data,
			'version' => $this->administrator->getVersion(),
			'php_version' => phpversion(),
			'header_url' => $this->config->item('header_url'),
			'theme_value' => $this->config->item('theme'),
			'notes' => $this->getNotes(),
			'checkVersion' => $this->checkVersion(),
			'checkUpdates' => $this->checkUpdates()
		);
		$output = $this->template->loadPage("admin/admin.tpl", $data);
		$content = $this->administrator->box('Dashboard', $output);
		$this->administrator->view($content, false, "modules/admin/js/admin.js");
	}

	
	private function getNotes()
	{
		$cache = $this->cache->get("dashboard");
		if(!$cache)
		{
			return '';
		}
		else
		{	
			return $cache['notes'];	
		}
	}	
	
	public function SaveNotes()
	{
		adminPerm();
		$data = array(
			'notes' => $this->input->post('notes'),
		);
		$this->cache->save("dashboard", $data, 99999999);
		die("yes");
	}
	
    private function checkUpdates()
    {
    	$updates = glob("application/updates/*/", GLOB_ONLYDIR);
    	return count($updates);
    }

	public function checkVersion()
	{	
		try
		{
			$remote_version = file_get_contents("http://dekaroncms.com/cmsversion.php");
			$local_version =  $this->administrator->getVersion();

			if (version_compare($remote_version, $local_version, '>'))
			{
			   return 'false';
			}
		}
		catch(Exception $e)
		{
			return 'true';
		}
		return 'true';
	}		
}