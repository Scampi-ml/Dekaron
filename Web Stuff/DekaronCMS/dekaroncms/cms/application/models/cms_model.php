<?php
class Cms_model extends CI_Model
{
	private $db;
	
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database("default", true);
	}

	public function getModuleConfigValue($module_name, $key)
	{
		$query = $this->db->query("SELECT * FROM module_config WHERE module_name = ? AND key = ?", array((string)$module_name, (string)$key));
		if($query->num_rows() > 0)
		{
			$result = $query->result_row();

			return $result['value'];
		}
		return null;
	}	

	public function getModules()
	{
		$query = $this->db->query("SELECT * FROM modules");
		return $query->result_array();
	}

	public function getConfig()
	{
		$query = $this->db->get('module_config');
		return $query->result_array();			
	}	


	public function getModuleEnabled($module_name)
	{
		$enabled = 1;
		$query = $this->db->query("SELECT module_name,enabled FROM modules WHERE module_name = ? AND enabled = ?", array((string)$module_name, (int)$enabled));
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getSideboxes()
	{
		$query = $this->db->query("SELECT * FROM sideboxes ORDER BY `order` ASC");
		return $query->result_array();
	}

	public function getSlides()
	{
		$query = $this->db->query("SELECT * FROM image_slider ORDER BY `order` ASC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}

	public function getLinks($side = "top")
	{
		if(in_array($side, array("top", "side")))
		{
			$query = $this->db->query("SELECT * FROM menu WHERE side = ? ORDER BY `order` ASC", array($side));
		}
		else
		{
			$query = $this->db->query("SELECT * FROM menu ORDER BY `order` ASC", array($side));
		}

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}

	public function getPage($page)
	{
		$this->db->select('*')->from('pages')->where('identifier', $page);
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result[0];
		}
		return null;
	}

	public function getPages()
	{
		$this->db->select('*')->from('pages');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result;
		}
		return null;
	}
}