<?php
class Module_model extends CI_Model
{	
	public function addModule($data)
	{	
		$this->db->insert("modules", $data);
	}	

	public function addUcpModule($module_name)
	{		
		$this->db->insert("module_ucp", array('module_name' => $module_name));
	}		

	public function removeModule($moduleName)
	{
		$this->db->delete('modules', array('module_name' => $moduleName));
	}	

	public function enableModule($moduleName)
	{	
		$this->db->where('module_name', $moduleName);
		$this->db->update('modules', array('enabled' => 1));
	}	

	public function disableModule($moduleName)
	{	
		$this->db->where('module_name', $moduleName);
		$this->db->update('modules', array('enabled' => 0));
	}	

	public function getModules()
	{
		$query = $this->db->query("SELECT * FROM modules");
		return $query->result_array();
	}

	public function removeModuleRoles($moduleName)
	{
		$this->db->delete('acl_group_roles', array('module' => $moduleName));
	}	
	
	public function removeModuleConfig($moduleName)
	{
		$this->db->delete('module_config', array('module_name' => $moduleName));
	}

	public function removeModuleMenu($moduleName)
	{
		$this->db->delete('menu', array('link' => $moduleName));
	}

	public function findModule($moduleName)
	{	
		$query = $this->db->query("SELECT * FROM modules WHERE module_name = ?", array($moduleName));
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

	public function RunSQLModule($sql)
	{	
		$file = $this->load->file($sql, true);
		$file_array = explode(';', $file);

		foreach($file_array as $query)
		{		
			$query = trim($query);
			if (!empty($query))
			{
				$this->db->query("SET FOREIGN_KEY_CHECKS = 0");
				$run = $this->db->query($query);
				$this->db->query("SET FOREIGN_KEY_CHECKS = 1");
			}
		}
		return true;
	}	
}