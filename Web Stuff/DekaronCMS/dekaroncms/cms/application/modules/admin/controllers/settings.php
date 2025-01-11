<?php
class Settings extends MX_Controller
{
	
	private $websiteMatches;
	private $templateMatches;
	private $data;

	public function __construct()
	{	
		parent::__construct();
		$this->data = array();
		$this->websiteMatches = array("*.cache");
		$this->templateMatches = array("*.php");		
		$this->load->library('administrator');	
		$this->load->model('settings_model');	
		require_once('application/libraries/configeditor.php');
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Settings");

		$this->getSettings();

		$this->data['url'] = $this->template->page_url;
		$output = $this->template->loadPage("settings/settings.tpl", $this->data);
		$content = $this->administrator->box('Settings', $output);
		$this->administrator->view($content, false, "modules/admin/js/settings.js");
	}

	//-----------------------------------------
	// 				GET SETTINGS
	//-----------------------------------------	

	private function getSettings()
	{
			
		$themes = glob("application/themes/*");
		$themesArr = array();

		foreach($themes as $key => $value)
		{
			$value = preg_replace("/application\/themes\/([A-Za-z_-]*)/", "$1", $value);

			if($value == "index.html"){continue;}
			if($value == "admin"){continue;}

			if(file_exists("application/themes/".$value."/manifest.json"))
			{
				$manifest = json_decode(file_get_contents("application/themes/".$value."/manifest.json"), true);
				$manifest['folderName'] = $value;
				array_push($themesArr, $manifest);
			}
		}

		$this->data['themes'] 			= $themesArr;

		//website
		$website 						= $this->countWebsiteCache();
		$template 						= $this->countTemplateCache();
		$total['files'] 				= $website['files'] + $template['files'];
		$total['size'] 					= $this->formatSize($website['size'] + $template['size']);
		$this->data['website'] 			= $website;
		$this->data['template'] 		= $template;
		$this->data['total'] 			= $total;

		$settings = $this->settings_model->getSetting();
		
		foreach ($settings as $setting)
		{		
			if($setting['value'] === NULL)
			{
				$this->data[$setting['key']] = $setting['default'];
			}
			else
			{
				$this->data[$setting['key']] = $setting['value'];
			}
		}
	}

	//-----------------------------------------
	// 				SAVE SETTINGS
	//-----------------------------------------
	private function setConfig()
	{
		$write = "<?php if (!defined('BASEPATH')) exit('No direct script access allowed');\n";
		$db_config = $this->settings_model->getModuleConfig();	

		foreach ($db_config as $conf)
		{	
			if($conf['value'] === null || $conf['value'] == '')
			{
				if($conf['default'] == 'true' || $conf['default'] == 'false')
				{
					$write .= "\$config['".$conf['key']."'] = ".$conf['default'].";\n";
				}
				else
				{
					$write .= "\$config['".$conf['key']."'] = '".$conf['default']."';\n";	
				}	
			}
			else
			{
				if($conf['value'] == 'true' || $conf['value'] == 'false')
				{
					$write .= "\$config['".$conf['key']."'] = ".$conf['value'].";\n";
				}
				else
				{
					$write .= "\$config['".$conf['key']."'] = '".$conf['value']."';\n";	
				}	
			}
		}				
		file_put_contents('application/config/cms.php', $write);
	}

	public function deleteCache($type = false)
	{
		adminPerm();
		switch($type)
		{
			case "website":
				foreach($this->websiteMatches as $match)
				{
					$this->cache->delete($match);
				}
			break;
			
			case "template":
				foreach($this->templateMatches as $match)
				{
					$this->cache->delete($match, true);
				}
			break;				
		}
	}

	public function saveSlider()
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'slider', $this->input->post('slider'));
		$this->settings_model->updateSetting('core', 'slider_home', $this->input->post('slider_home'));
		$this->settings_model->updateSetting('core', 'slider_interval', (int)$this->input->post('slider_interval'));
		$this->settings_model->updateSetting('core', 'slider_style', $this->input->post('slider_style'));
		$this->setConfig();
	}	

	public function saveWebsite()
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'title', $this->input->post('title'));
		$this->settings_model->updateSetting('core', 'server_name', $this->input->post('server_name'));
		$this->settings_model->updateSetting('core', 'keywords', $this->input->post('keywords'));
		$this->settings_model->updateSetting('core', 'description', $this->input->post('description'));
		$this->settings_model->updateSetting('core', 'news_limit', $this->input->post('news_limit'));
		$this->settings_model->updateSetting('core', 'connection_type', $this->input->post('connection_type'));	
		$this->setConfig();
	}

	public function saveSmtp()
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'smtp_host', $this->input->post('smtp_host'));
		$this->settings_model->updateSetting('core', 'smtp_user', $this->input->post('smtp_user'));
		$this->settings_model->updateSetting('core', 'smtp_pass', $this->input->post('smtp_pass'));
		$this->settings_model->updateSetting('core', 'smtp_port', $this->input->post('smtp_port'));	
		$this->setConfig();
	}
	
	public function saveApi()
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'api_server', $this->input->post('api_server'));
		$this->settings_model->updateSetting('core', 'api_http_user', $this->input->post('api_http_user'));
		$this->settings_model->updateSetting('core', 'api_http_pass', $this->input->post('api_http_pass'));
		$this->settings_model->updateSetting('core', 'api_http_auth', $this->input->post('api_http_auth'));
		$this->settings_model->updateSetting('core', 'api_ssl_verify_peer', $this->input->post('api_ssl_verify_peer'));
		$this->settings_model->updateSetting('core', 'api_send_cookies', $this->input->post('api_send_cookies'));
		$this->settings_model->updateSetting('core', 'api_api_name', $this->input->post('api_api_name'));
		$this->settings_model->updateSetting('core', 'api_api_key', $this->input->post('api_api_key'));
		$this->settings_model->updateSetting('core', 'api_ssl_cainfo', $this->input->post('api_ssl_cainfo'));
		$this->settings_model->updateSetting('core', 'api_debug', $this->input->post('api_debug'));
		$this->setConfig();
	}	

	public function saveMssql()
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'mssql_host', $this->input->post('mssql_host'));
		$this->settings_model->updateSetting('core', 'mssql_username', $this->input->post('mssql_username'));
		$this->settings_model->updateSetting('core', 'mssql_password', $this->input->post('mssql_password'));
		$this->settings_model->updateSetting('core', 'mssql_driver', $this->input->post('mssql_driver'));
		$this->setConfig();
	}	

	public function saveTheme($theme = false)
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'theme', $theme);
		$this->cache->deleteAll();
		$this->setConfig();
	}


	public function saveLogin()
	{
		adminPerm();
		$this->settings_model->updateSetting('core', 'admin_nickname', $this->input->post('admin_nickname'));
		$this->settings_model->updateSetting('core', 'admin_username', $this->input->post('admin_username'));
		$this->settings_model->updateSetting('core', 'admin_password', $this->input->post('admin_password'));
		$this->setConfig();
	}	

	public function testEmail()
	{	
		adminPerm();
		$this->load->helper('email_helper');

		$test_email = sendMail($this->input->post('to'), $this->input->post('from'), $this->input->post('subject'), $this->input->post('message'));
		if($test_email)
		{
			die("yes");
		}
		else
		{
			die("Failed sending the email, please check the settings again.");
		}
	}

	//-----------------------------------------
	// 				FUNCTION SETTINGS
	//-----------------------------------------
	private function countWebsiteCache()
	{
		$result = array("files" => 0,"size" => 0);
		$matches = $this->websiteMatches;
		foreach($matches as $search)
		{
			$matches = glob("application/cache/data/".$search);
			if($matches)
			{
				foreach($matches as $file)
				{
					if(!preg_match("/index\.html/", $file))
					{
						$result['files']++;
						$result['size'] += filesize($file);
					}
				}
			}
		}
		$result['sizeString'] = $this->formatSize($result['size']);
		return $result;
	}
	
	private function countTemplateCache()
	{
		$result = array("files" => 0,"size" => 0);
		$matches = $this->templateMatches;
		foreach($matches as $search)
		{
			$matches = glob("application/cache/templates/".$search);

			if($matches)
			{
				foreach($matches as $file)
				{
					if(!preg_match("/index\.html/", $file))
					{
						$result['files']++;
						$result['size'] += filesize($file);
					}
				}
			}
		}
		$result['sizeString'] = $this->formatSize($result['size']);
		return $result;
	}

	private function formatSize($size)
	{
		if($size < 1024){
			return $size." byte";
		}elseif($size < 1024 * 1024){
			return round($size / 1024)." kilobyte";
		}elseif($size < 1024 * 1024 * 1024){
			return round($size / (1024 * 1024))." megabyte";
		}else {
			return round($size / (1024 * 1024 * 1024))." gigabyte";
		}
	}
}