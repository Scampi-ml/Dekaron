<?php

class Page_model extends CI_Model
{
	public function getPages()
	{
		$this->db->select('*')->from('pages')->order_by('id', 'desc');
		$query = $this->db->get();
			
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

	public function getPage($id)
	{
		$query = $this->db->query("SELECT * FROM pages WHERE id=?", array($id));

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

	public function pageExists($identifier, $id)
	{
		if($id)
		{
			$query = $this->db->query("SELECT COUNT(*) as `total` FROM pages WHERE id !=? AND identifier=?", array($id, $identifier));
		}
		else
		{
			$query = $this->db->query("SELECT COUNT(*) as `total` FROM pages WHERE identifier=?", array($identifier));
		}

		if($query->num_rows())
		{
			$row = $query->result_array();

			if($row[0]['total'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}