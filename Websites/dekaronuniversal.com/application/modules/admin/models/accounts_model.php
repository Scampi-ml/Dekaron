<?php

class Accounts_model extends CI_Model 
{
	private $connection;
	
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default');
	}
	
	public function getByEmail($email = "")
	{
		$query = $this->db->query("SELECT * FROM account WHERE email = ?", array($email));
		
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
	
	public function getByUsername($username = "")
	{
		$query = $this->db->query("SELECT * FROM account WHERE username = ?", array($username));
		
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
	
	public function getInternalDetails($userId = 0)
	{
		$query = $this->db->query("SELECT * FROM account_data WHERE id = ?", array($userId));
		
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
	
	public function getAccessId($userId = 0)
	{
		$query = $this->db->query("SELECT gmlevel FROM account_access WHERE id = ?", array($userId));
		
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
	
	public function save($id, $external_account_data, $external_account_access_data, $internal_data)
	{
		if(column("account", "v") && column("account", "s") && column("account", "sessionkey"))
		{
			$external_account_data["v"] = "";
			$external_account_data["s"] = "";
			$external_account_data["sessionkey"] = "";
		}

		$this->db->where('id', $id);
		$this->db->update('account', $external_account_data);
		
		if($this->getAccessId($id))
		{
			// Update external access
			$this->db->where('id', $id);
			$this->db->update('account_access', $external_account_access_data);
		}
		else
		{
			// Update external access
			$external_account_access_data['id'] = $id;
			$this->db->insert('account_access', $external_account_access_data);
		}
		
		// Update internal
		$this->db->where('id', $id);
		$this->db->update('account_data', $internal_data);

	}
}
