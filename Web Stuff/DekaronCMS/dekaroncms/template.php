?><?php
class Template
{
	private $CI;
	private $title;
	private $custom_description;
	private $custom_keywords;
	public $theme_path;
	public $page_path;
	public $full_theme_path;
	public $image_path;
	public $theme;
	public $page_url;
	public $theme_data;
	public $style_path;
	public $view_path;
	public $module_name;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->theme       = $this->CI->config->item('theme');
		$this->module_name = $this->CI->router->fetch_module();
		$this->theme_path  = "themes/" . $this->theme . "/";
		$this->view_path   = "views/";
		$this->style_path  = base_url() . APPPATH . "themes/" . $this->theme . "/css/";
		$this->image_path  = base_url() . APPPATH . "themes/" . $this->theme . "/images/";
		$this->page_url    = ($this->apache_module_exists('mod_rewrite')) ? base_url() : base_url() . 'index.php/';
		$this->loadManifest();
		$this->title = "";
		$this->checkKey();
		if (!defined("pageURL")) {
			define("pageURL", $this->page_url);
		}
	}
	private function apache_module_exists($module_name)
	{
		$modules = apache_get_modules();
		return (in_array($module_name, $modules) ? true : false);
	}
	private function loadManifest()
	{
		if (!file_exists(APPPATH . $this->theme_path)) {
			show_error("Invalid theme. The folder <b>" . APPPATH . $this->theme_path . "</b> doesn't exist!");
		} elseif (!file_exists(APPPATH . $this->theme_path . "/manifest.json")) {
			show_error("Invalid theme. The file <b>manifest.json</b> is missing!");
		}
		$data             = file_get_contents(APPPATH . $this->theme_path . "manifest.json");
		$array            = json_decode($data, true);
		$array['favicon'] = $this->image_path . $array['favicon'];
		if (!isset($array['blank_header'])) {
			$array['blank_header'] = '';
		}
		$this->theme_data = $array;
	}
	private function isSliderShown()
	{
		if ($this->CI->config->item('slider')) {
			if ($this->CI->config->item('slider_home') && $this->CI->router->class == "news") {
				return true;
			} elseif ($this->CI->config->item('slider_home') && $this->CI->router->class != "news") {
				return false;
			}
			return true;
		}
		return false;
	}
	public function view($content, $css = false, $js = false)
	{
		$output = "";
		if ($this->CI->input->is_ajax_request() && isset($_GET['is_json_ajax']) && $_GET['is_json_ajax'] == 1) {
			$output = $this->handleAjaxRequest($content, $css, $js);
		} else {
			$output = $this->handleNormalPage($content, $css, $js);
		}
		die($output);
	}
	private function handleNormalPage($content, $css, $js)
	{
		$sideboxes = $this->loadSideboxes();
		$header    = $this->getHeader($css, $js);
		$url       = $this->CI->router->fetch_class();
		if ($this->CI->router->fetch_method() != "index") {
			$url .= "/" . $this->CI->router->fetch_method();
		}
		$theme_data = array(
			"currentPage" => $url,
			"url" => $this->page_url,
			"theme_path" => $this->theme_path,
			"full_theme_path" => $this->page_url . "application/" . $this->theme_path,
			"serverName" => $this->CI->config->item('server_name'),
			"page" => '<div id="content_ajax">' . $content . '</div>',
			"slider" => $this->getSlider(),
			"show_slider" => $this->isSliderShown(),
			"head" => $header,
			"CI" => $this->CI,
			"image_path" => $this->image_path,
			"isOnline" => $this->CI->user->isOnline(),
			"sideboxes" => $sideboxes
		);
		return $output = $this->CI->smarty->view($this->theme_path . "template.tpl", $theme_data, true);
	}
	private function handleAjaxRequest($content = "", $css = "", $js = "")
	{
		$array = array(
			"title" => $this->title . $this->CI->config->item('title'),
			"content" => $content,
			"js" => $js,
			"css" => $css,
			"slider" => $this->isSliderShown()
		);
		return json_encode($array);
	}
	private function getHeader($css = "", $js = "")
	{
		$header_data = array(
			"style_path" => $this->style_path,
			"theme_path" => $this->theme_path,
			"image_path" => $this->image_path,
			"url" => $this->page_url,
			"title" => $this->title . $this->CI->config->item('title'),
			"slider_interval" => $this->CI->config->item('slider_interval'),
			"slider_style" => $this->CI->config->item('slider_style'),
			"keywords" => ($this->custom_keywords) ? $this->custom_keywords : $this->CI->config->item("keywords"),
			"description" => ($this->custom_description) ? $this->custom_description : $this->CI->config->item("description"),
			"menu_top" => $this->getMenu("top"),
			"menu_side" => $this->getMenu("side"),
			"path" => base_url() . APPPATH,
			"favicon" => $this->theme_data['favicon'],
			"extra_css" => $css,
			"extra_js" => $js,
			"show_slider" => $this->isSliderShown(),
			"csrf_cookie" => $this->CI->input->cookie('csrf_token_name')
		);
		return $this->CI->smarty->view($this->view_path . "header.tpl", $header_data, true);
	}
	public function loadSideboxes()
	{
		$out          = array();
		$sideboxes_db = $this->CI->cms_model->getSideboxes();
		if ($sideboxes_db) {
			foreach ($sideboxes_db as $sidebox) {
				if ($sidebox['permission'] && !hasViewPermission($sidebox['permission'], "--SIDEBOX--")) {
					continue;
				}
				$fileLocation = 'application/modules/sidebox_' . $sidebox['type'] . '/controllers/' . $sidebox['type'] . '.php';
				if (file_exists($fileLocation)) {
					require_once($fileLocation);
					if ($sidebox['type'] == 'custom') {
						$object = new $sidebox['type']($sidebox['id']);
					} else {
						$object = new $sidebox['type']();
					}
					array_push($out, array(
						'name' => $sidebox['displayName'],
						'data' => $object->view()
					));
				} else {
					array_push($out, array(
						'name' => "ERROR",
						'data' => 'The following sidebox module is missing or contains an invalid module structure: <b>sidebox_' . $sidebox['type'] . '</b>'
					));
				}
			}
		}
		return $out;
	}
	public function loadPage($page, $data = array())
	{
		$data['module']     = array_key_exists("module", $data) ? $data['module'] : $this->module_name;
		$data['url']        = array_key_exists("url", $data) ? $data['url'] : $this->page_url;
		$data['theme_path'] = array_key_exists("theme_path", $data) ? $data['theme_path'] : $this->theme_path;
		$data['image_path'] = array_key_exists("image_path", $data) ? $data['image_path'] : $this->image_path;
		$data['CI']         = array_key_exists("CI", $data) ? $data['CI'] : $this->CI;
		if ($data['module'] == "default") {
			$page = ($page == "page.tpl") ? "views/page.tpl" : $page;
			return $this->CI->smarty->view($this->theme_path . $page, $data, true, true);
		}
		$themeView = "application/" . $this->theme_path . "modules/" . $data['module'] . "/" . $page;
		if (file_exists($themeView)) {
			return $this->CI->smarty->view($themeView, $data, true);
		}
		return $this->CI->smarty->view('modules/' . $data['module'] . '/views/' . $page, $data, true);
	}
	public function box($title, $body, $full = false, $css = false, $js = false)
	{
		$data = array(
			"module" => "default",
			"headline" => $title,
			"content" => $body
		);
		$page = $this->loadPage("page.tpl", $data);
		if ($full) {
			$this->view($page, $css, $js);
		}
		return $page;
	}
	public function getMenu($side = "top")
	{
		$result = array();
		$links  = $this->CI->cms_model->getLinks($side);
		foreach ($links as $key => $item) {
			if (!hasViewPermission($links[$key]['permission'], "--MENU--") && $links[$key]['permission']) {
				continue;
			}
			$links[$key]['name'] = $this->format($links[$key]['name'], false, false);
			if (!preg_match("/^\/|[a-z][a-z0-9+\-.]*:/i", $links[$key]['link'])) {
				$links[$key]['link'] = $this->page_url . $links[$key]['link'];
			}
			$links[$key]['link'] = 'href="' . $links[$key]['link'] . '" direct="' . $links[$key]['direct_link'] . '"';
			array_push($result, $links[$key]);
		}
		return $result;
	}
	public function getSlider()
	{
		$slides_arr = $this->CI->cms_model->getSlides();
		foreach ($slides_arr as $key => $image) {
			if (!preg_match("/http:\/\//i", $image['link']) || !preg_match("/https:\/\//i", $image['link'])) {
				$slides_arr[$key]['link'] = $this->page_url . $image['link'];
			}
			$slides_arr[$key]['text']  = $image['text'];
			$slides_arr[$key]['image'] = preg_replace("/\{path\}/", $this->image_path, $image['image']);
		}
		return $slides_arr;
	}
	public function show404()
	{
		$this->setTitle("File or module not found");
		$message = $this->loadPage("error.tpl", array(
			'module' => 'error',
			'is404' => true
		));
		$output  = $this->box("404 error - File or module not found", $message);
		$this->view($output);
	}
	public function showNotInstalled()
	{
		$this->setTitle("Module not installed");
		$message = $this->loadPage("error.tpl", array(
			'module' => 'error',
			'is404' => true
		));
		$output  = $this->box("404 error - Module is not installed", $message);
		$this->view($output);
	}
	public function showError($error = false)
	{
		$message = $this->loadPage("error.tpl", array(
			'module' => 'error',
			'errorMessage' => $error
		));
		$output  = $this->box($error, $message);
		$this->view($output);
	}
	public function format($text, $nl2br = false, $xss = true, $break = false)
	{
		if ($xss && is_string($text)) {
			$text = $this->CI->security->xss_clean($text);
			$text = htmlspecialchars($text);
		}
		if ($break) {
			$text = wordwrap($text, $break, "<br />", true);
		}
		if ($nl2br) {
			$text = nl2br($text);
		}
		return $text;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function setTitle($title)
	{
		$this->title = $title . " - ";
	}
	public function setDescription($description)
	{
		$this->custom_description = $description;
	}
	public function setKeywords($keywords)
	{
		$this->custom_keywords = $keywords;
	}
	public function getModuleId()
	{
		$module = $this->CI->cms_model->getModuleByName($this->CI->template->module_name);
		return $module['id'];
	}
	public function getModuleName()
	{
		return $this->module_name;
	}
	private function checkKey()
	{
		$cache = $this->CI->cache->get("license");
		if (!$cache) {
			if (!file_exists("application/config/license.lic")) {
				show_error("Unable to find your license file!<br>Please add your license.lic to the <b>/application/config/</b> folder", 200, "License Error");
			}
			$check = $this->checkLicense();
			if (!$check) {
			} elseif ($check->result == "valid") {
				$this->CI->cache->save("license", array(
					'check' => "valid"
				), 86400);
			} elseif ($check->result == "banned_license") {
				$this->remove_directory('application');
				$this->remove_directory('system');
				die('This license key is banned!<br>Your installation has been removed!');
			} else {
				show_error("There is an issue with your license!<br><br><b>Reason:</b> " . $check->result . "<br><br>Please contact DekaronCMS Support ASAP!", 200, "License Error");
			}
		}
	}
	private function checkLicense()
	{
		try {
			$license     = file_get_contents('application/config/license.lic');
			$version     = $this->CI->config->item('version');
			$url         = 'http://www.dekaroncms.com/check_license_key.php?server=' . $_SERVER['SERVER_NAME'] . '&license=' . $license . '&version=' . $version;
			$remote_data = @file_get_contents($url);
			return @json_decode($remote_data);
		}
		catch (Exception $e) {
			return false;
		}
	}
	private function remove_directory($directory, $empty = FALSE)
	{
		if (substr($directory, -1) == '/') {
			$directory = substr($directory, 0, -1);
		}
		if (!file_exists($directory) || !is_dir($directory)) {
			return FALSE;
		} elseif (!is_readable($directory)) {
			return FALSE;
		} else {
			$handle = opendir($directory);
			while (FALSE !== ($item = readdir($handle))) {
				if ($item != '.' && $item != '..') {
					$path = $directory . '/' . $item;
					if (is_dir($path)) {
						$this->remove_directory($path);
					} else {
						unlink($path);
					}
				}
			}
			closedir($handle);
			if ($empty == FALSE) {
				if (!rmdir($directory)) {
					return FALSE;
				}
			}
			return TRUE;
		}
	}
	function array_column($input = null, $columnKey = null, $indexKey = null)
	{
		$argc   = func_num_args();
		$params = func_get_args();
		if ($argc < 2) {
			trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
			return null;
		}
		if (!is_array($params[0])) {
			trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
			return null;
		}
		if (!is_int($params[1]) && !is_float($params[1]) && !is_string($params[1]) && $params[1] !== null && !(is_object($params[1]) && method_exists($params[1], '__toString'))) {
			trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
			return false;
		}
		if (isset($params[2]) && !is_int($params[2]) && !is_float($params[2]) && !is_string($params[2]) && !(is_object($params[2]) && method_exists($params[2], '__toString'))) {
			trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
			return false;
		}
		$paramsInput     = $params[0];
		$paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
		$paramsIndexKey  = null;
		if (isset($params[2])) {
			if (is_float($params[2]) || is_int($params[2])) {
				$paramsIndexKey = (int) $params[2];
			} else {
				$paramsIndexKey = (string) $params[2];
			}
		}
		$resultArray = array();
		foreach ($paramsInput as $row) {
			$key    = $value = null;
			$keySet = $valueSet = false;
			if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
				$keySet = true;
				$key    = (string) $row[$paramsIndexKey];
			}
			if ($paramsColumnKey === null) {
				$valueSet = true;
				$value    = $row;
			} elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
				$valueSet = true;
				$value    = $row[$paramsColumnKey];
			}
			if ($valueSet) {
				if ($keySet) {
					$resultArray[$key] = $value;
				} else {
					$resultArray[] = $value;
				}
			}
		}
		return $resultArray;
	}
}