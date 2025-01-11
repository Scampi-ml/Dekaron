<?php

class Settings_model extends CI_Model
{
	public function updateSetting($module_name, $key, $value)
	{
		$this->db->where('key', $key);
		$this->db->update('module_config',  array('key' => $key,'value' => $value));				
	}

	public function getSetting()
	{
		$query = $this->db->query("SELECT * FROM module_config ");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}

	public function deleteSetting($module_name)
	{
		$this->db->delete('module_config', array('module_name' => $module_name));
	}	

	public function getModuleConfig()
	{
		$query = $this->db->get('module_config');
		return $query->result_array();			
	}

}