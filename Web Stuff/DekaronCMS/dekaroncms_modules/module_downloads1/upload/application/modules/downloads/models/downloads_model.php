<?php

class Downloads_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getDownloads()
	{
		$query = $this->db->query("SELECT * FROM downloads");
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

	public function getDownload($id)
	{
		$query = $this->db->query("SELECT * FROM downloads WHERE id = ?", array($id));
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		if($this->db->query("DELETE FROM downloads WHERE id = ?", array($id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function edit($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('downloads', $data);
	}
	
	public function add($name, $link)
	{
		$data = array(
			"download_name" => $name,
			"download_link" => $link,
		);
		$this->db->insert("downloads", $data);
	}

}
