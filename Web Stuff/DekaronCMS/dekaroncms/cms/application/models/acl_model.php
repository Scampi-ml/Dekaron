<?php
class Acl_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function hasPermissionGuest($permissionName, $moduleName, $onlyDatabase = false)
	{
		$result = null;
		$groupId = 1;
		$this->db->select("arp.value");
		$this->db->where("agr.group_id", $groupId);
		$this->db->where("agr.module", $moduleName);
		$this->db->where("arp.role_name = agr.role_name");
		$this->db->where("arp.module", $moduleName);
		$this->db->where("arp.permission_name", $permissionName);

		$query = $this->db->get("acl_roles_permissions arp, acl_group_roles agr");

		if($query->num_rows())
		{
			$row = $query->result_array();

			$result = $row[0]['value'];
		}
		elseif(!$onlyDatabase)
		{
			$roles = $this->getRolesByGroupId($groupId, $moduleName);

			if($roles)
			{
				foreach($roles as $role)
				{
					$manifest = $this->acl->getManifestRole($role['role_name'], $moduleName);

					if($manifest && array_key_exists($permissionName, $manifest['permissions']))
					{
						$result = $manifest['permissions'][$permissionName];
					}
				}
			}
		}

		return $result;
	}

	private function hasPermissionPlayer($permissionName, $moduleName)
	{
		$result = null;

		$groupId = 2;

		$this->db->select("arp.value");
		$this->db->where("agr.group_id", $groupId);
		$this->db->where("agr.module", $moduleName);
		$this->db->where("arp.role_name = agr.role_name");
		$this->db->where("arp.module", $moduleName);
		$this->db->where("arp.permission_name", $permissionName);

		$query = $this->db->get("acl_roles_permissions arp, acl_group_roles agr");

		if($query->num_rows())
		{
			$row = $query->result_array();

			$result = $row[0]['value'];
		}

		return $result;
	}

	public function hasPermission($userId, $permissionName, $moduleName, $onlyDatabase = false)
	{
		$result = $this->hasPermissionPlayer($permissionName, $moduleName);

		$this->db->select("arp.value");
		//$this->db->where("aag.account_id", $userId);
		//$this->db->where("aag.group_id = agr.group_id");
		$this->db->where("agr.module", $moduleName);
		$this->db->where("arp.role_name = agr.role_name");
		$this->db->where("arp.module", $moduleName);
		$this->db->where("arp.permission_name", $permissionName);

		//$query = $this->db->get("acl_roles_permissions arp, acl_group_roles agr, acl_account_groups aag");

		$query = $this->db->get("acl_roles_permissions arp, acl_group_roles agr");

		if($query->num_rows())
		{
			$permissions = $query->result_array();

			foreach($permissions as $permission)
			{
				if($permission['value'] || $result === null)
				{
					$result = $permission['value'];
				}
			}
		}
		elseif(!$onlyDatabase)
		{
			$roles = $this->getGroupRolesByUser($userId, $moduleName);

			if($roles)
			{
				foreach($roles as $role)
				{
					$manifest = $this->acl->getManifestRole($role['role_name'], $moduleName);

					if($manifest && array_key_exists($permissionName, $manifest['permissions']))
					{
						$result = $manifest['permissions'][$permissionName];
					}
				}
			}
		}

		$this->db->select("arp.value");
		$this->db->where("aar.account_id", $userId);
		$this->db->where("aar.module", $moduleName);
		$this->db->where("aar.role_name = arp.role_name");
		$this->db->where("arp.module", $moduleName);
		$this->db->where("arp.permission_name", $permissionName);

		$userRoleQuery = $this->db->get("acl_account_roles aar, acl_roles_permissions arp");

		if($userRoleQuery->num_rows())
		{
			$userRolePermissions = $query->result_array();

			foreach($userRolePermissions as $userRolePermission)
			{
				// Override group permissions
				$result = $userRolePermission['value'];
			}
		}
		elseif(!$onlyDatabase)
		{
			// Give it another try with manifest defined roles
			$userRoles = $this->getAccountRoles($userId, $moduleName);

			if($userRoles)
			{
				foreach($userRoles as $userRole)
				{
					$manifest = $this->acl->getManifestRole($userRole['role_name'], $moduleName);

					if($manifest && array_key_exists($permissionName, $manifest['permissions']))
					{
						$result = $manifest['permissions'][$permissionName];
					}
				}
			}
		}

		$this->db->select("value");
		$this->db->where("account_id", $userId);
		$this->db->where("module", $moduleName);
		$this->db->where("permission_name", $permissionName);

		$userQuery = $this->db->get("acl_account_permissions");

		if($userQuery->num_rows())
		{
			$userPermission = $userQuery->result_array();
			$result = $userPermission[0]['value'];
		}

		return $result;
	}

	private function getGroupRolesByUser($userId, $moduleName = false)
	{
		$this->db->select("agr.role_name, agr.module");
		//$this->db->where("aag.account_id", $userId);
		//$this->db->where("aag.group_id = agr.group_id");

		if($moduleName)
		{
			$this->db->where("agr.module", $moduleName);
		}

		$query = $this->db->get("acl_group_roles agr");
		//$query = $this->db->get("acl_group_roles agr, acl_account_groups aag");

		if($query->num_rows())
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function getAccountPermissions($userId)
	{
		$this->db->select("account_id, permission_name, module, value");
		$this->db->where("account_id", $userId);
		$query = $this->db->get("acl_account_permissions");

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function getAccountRoles($userId, $module = false)
	{
		$this->db->select("role_name");
		$this->db->where("account_id", $userId);

		if($module)
		{
			$this->db->where("module", $module);
		}

		$query = $this->db->get("acl_account_roles");

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function getGroups()
	{
		$this->db->select('ag.id, ag.name, ag.color, ag.description');
		$query = $this->db->get('acl_groups ag');

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function getGroup($groupId)
	{
		$this->db->select('id, name, color, description');
		$this->db->where('id', $groupId);
		$query = $this->db->get('acl_groups');

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result[0];
		}
		else
		{
			return false;
		}
	}

	public function getGroupByName($groupName)
	{
		$this->db->select('id, name, color, description');
		$this->db->where('name', $groupName);
		$query = $this->db->get('acl_groups');

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result[0];
		}
		else
		{
			return false;
		}
	}

	public function getRoles()
	{
		$this->db->select('name, module, description');
		$query = $this->db->get('acl_roles');

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function groupHasRole($groupId, $name, $module)
	{
		$query = $this->db->query("SELECT COUNT(*) `total` FROM acl_group_roles WHERE role_name=? AND module=? AND group_id=?", array($name, $module, $groupId));

		if($query->num_rows())
		{
			$result = $query->result_array();

			return $result[0]['total'];
		}
		else
		{
			return false;
		}
	}

	public function getRole($name, $module)
	{
		$this->db->select('name, module, description');
		$this->db->where('name', $name);
		$this->db->where('module', $module);
		$query = $this->db->get('acl_roles');

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result[0];
		}
		else
		{
			return false;
		}
	}

	public function getRolesByGroupId($groupId, $moduleName)
	{
		$this->db->select("ar.name, ar.module, ar.description");
		$this->db->where("agr.group_id", $groupId);
		
		if($moduleName)
		{
			$this->db->where("agr.module", $moduleName);
		}

		$this->db->where("agr.module = ar.module");
		$this->db->where("agr.role_name = ar.name");
		$query = $this->db->get('acl_group_roles agr, acl_roles ar');

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getRolesByModule($moduleName)
	{
		$query = $this->db->query("SELECT * FROM acl_roles WHERE module=?", array($moduleName));

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getPermissionsByRole($name, $module)
	{
		$this->db->select("role_name, permission_name, module, value");
		$this->db->where('name', $name);
		$this->db->where('module', $module);
		$query = $this->db->get("acl_roles_permissions");

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function createGroup($name, $color = '', $description = '')
	{
		$data = array(
			'name' => $name,
			'color' => $color,
			'description' => $description
		);

		$this->db->insert('acl_groups', $data);

		return $this->db->insert_id();
	}

	public function createRole($name, $description = '')
	{
		$data = array(
			'name' => $name,
			'description' => $description
		);

		$this->db->insert('acl_roles', $data);
	}

	public function deleteGroup($groupId)
	{
		$this->db->delete('acl_groups', array('id' => $groupId));
	}

	public function deleteRole($name, $module)
	{
		$this->db->delete('acl_roles', array('name' => $name, 'module' => $module));
	}

	public function addRoleToGroup($groupId, $name, $module)
	{
		$data = array(
			'group_id' => $groupId,
			'role_name' => $name,
			'module' => $module
		);

		$this->db->insert('acl_group_roles', $data);
	}

	public function deleteRoleFromGroup($groupId, $name, $module)
	{
		$this->db->delete('acl_group_roles', array('group_id' => $groupId, 'role_name' => $name, 'module' => $module));
	}

	public function saveGroup($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('acl_groups', $data);
	}

	public function saveRole($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('acl_roles', $data);
	}

	public function deleteAllRoleFromGroup($groupId)
	{
		$this->db->delete('acl_group_roles', array('group_id' => $groupId));
	}

	public function addPermissionToRole($name, $permission, $module, $value = 1)
	{
		$data = array(
			'role_name' => $name,
			'permission_name' => $permission,
			'module' => $module,
			'value' => $value
		);

		$this->db->insert('acl_roles_permissions', $data);
	}

	public function deletePermissionFromRole($name, $permission, $module)
	{
		$where = array(
			'role_name' => $name,
			'permission_name' => $permission,
			'module' => $module
		);

		$this->db->delete('acl_roles_permissions', $where);
	}

	public function updatePermissionOfRole($name, $permission, $module, $value)
	{
		$this->db->where('role_name', $name);
		$this->db->where('permission_name', $permission);
		$this->db->where('module', $module);
		$this->db->update('acl_roles_permissions', array('value' => $value));
	}
}