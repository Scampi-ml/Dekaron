<?php

class Update_model extends CI_Model
{
	public function DoSqlUpdates($sql)
	{
		$file = $this->load->file($sql, true);
		$file_array = explode(';', $file);

		foreach($file_array as $query)
		{
			if (!empty($query))
			{
				$query = trim($query);
		        $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
		        $run = $this->db->query($query);
		        $this->db->query("SET FOREIGN_KEY_CHECKS = 1");	        			
			}
		}
	}
}