<?php
class Groups extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		adminPerm();
	}

	public function index()
	{
		$data = array(
			"groups" => $this->acl_model->getGroups(),
			"modules" => $this->getAllRoles(),
			"guestId" => 1,
			"playerId" => 2,
			"links" => $this->cms_model->getLinks("all"),
			"sideboxes" => $this->cms_model->getSideboxes(),
			"pages" => $this->cms_model->getPages()
		);

		$output = $this->template->loadPage("groups/groups.tpl", $data);	
		$output = $this->administrator->box("Groups", $output);
		$this->administrator->view($output, false, "modules/admin/js/groups.js");
	}

	public function editGroup($id = false)
	{
		if(!is_numeric($id) || !$id)
		{
			die("ID has to be a number");
		}

		$group = $this->acl_model->getGroup($id);

		if(!$group)
		{
			show_error("There is no group with ID ".$id);
			die();
		}
		$this->administrator->setTitle($group['name']);

		$data = array(
			"group" => $group,
			"modules" => $this->getAllRoles(),
			"guestId" => 1,
			"playerId" => 2,
			"links" => $this->cms_model->getLinks("all"),
			"sideboxes" => $this->cms_model->getSideboxes(),
			"pages" => $this->cms_model->getPages()
		);


		foreach($data['links'] as $key => $value)
		{
			$data['links'][$key]['has'] = $this->acl_model->groupHasRole($id, $value['id'], "--MENU--");
		}

		foreach($data['sideboxes'] as $key => $value)
		{
			$data['sideboxes'][$key]['has'] = $this->acl_model->groupHasRole($id, $value['id'], "--SIDEBOX--");
		}

		foreach($data['pages'] as $key => $value)
		{
			$data['pages'][$key]['has'] = $this->acl_model->groupHasRole($id, $value['id'], "--PAGE--");
		}

		foreach($data['modules'] as $key => $value)
		{
			if($data['modules'][$key]['db'])
			{
				foreach($data['modules'][$key]['db'] as $subKey => $subValue)
				{
					$data['modules'][$key]['db'][$subKey]['has'] = $this->acl_model->groupHasRole($id, $subValue['name'], $key);
				}
			}

			if($data['modules'][$key]['manifest'])
			{
				foreach($data['modules'][$key]['manifest'] as $subKey => $subValue)
				{
					$data['modules'][$key]['manifest'][$subKey]['has'] = $this->acl_model->groupHasRole($id, $subKey, $key);
				}
			}
		}
		$output = $this->template->loadPage("groups/groups_edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'admin/groups/">Groups</a> &rarr; '.$group['name'], $output);
		$this->administrator->view($content, false, "modules/admin/js/groups.js");
	}

	public function groupSave($id)
	{
		adminPerm();
		$roles = array();
		foreach($_POST as $k => $v)
		{
			if($v == "true")
			{
				array_push($roles, $k);
			}	
		}

		$this->acl_model->deleteAllRoleFromGroup($id);

		foreach($roles as $role)
		{
			if(preg_match("/^(PAGE|SIDEBOX|MENU)_/", $role))
			{
				$parts = explode("_", $role);
				$roleName = $parts[1];
				$moduleName = "--".$parts[0]."--";

				$this->acl_model->addRoleToGroup($id, $roleName, $moduleName);
			}
			elseif(preg_match("/-/", $role))
			{
				$roleParts = explode("-", $role);
				$this->acl_model->addRoleToGroup($id, $roleParts[1], $roleParts[0]);
			}
			else
			{
				// Unknown POST
			}
		}
		die("yes");
	}

	public function roleDelete($id)
	{
		adminPerm();
		$this->acl_model->deleteRole($id);
	}


	private function getAllRoles()
	{
		$modules = array();
		foreach(glob("application/modules/*") as $module)
		{
			if(is_dir($module) && file_exists($module."/manifest.json"))
			{
				$data = file_get_contents($module."/manifest.json");
				$manifest = json_decode($data, true);
				$module = preg_replace("/^application\/modules\//", "", $module);

				if(is_array($manifest))
				{
					$modules[$module]['name'] = (array_key_exists("name", $manifest)) ? $manifest['name'] : $module;
					$modules[$module]['manifest'] = (array_key_exists("roles", $manifest)) ? $manifest['roles'] : false;
					$modules[$module]['db'] = $this->acl_model->getRolesByModule($module);
				}
			}
		}
		return $modules;
	}
}