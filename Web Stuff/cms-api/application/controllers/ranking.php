<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends REST_Controller{

    function __construct(){
        parent::__construct();
		$this->db = $this->load->database('character', TRUE);
    }		

	function ByExp(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.dwExp,
		  dbo.user_character.byPCClass
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%'		  
		ORDER BY
		  dbo.user_character.dwExp DESC		
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByGrade(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.byPCClass,
		  dbo.user_character.wGrade
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%' 
		ORDER BY
		  dbo.user_character.wGrade DESC
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByPk(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.byPCClass,
		  dbo.user_character.wPKCount
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%'			  
		ORDER BY
		  dbo.user_character.wPKCount DESC
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByPvPWin(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.byPCClass,
		  dbo.user_character.wWinRecord
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%'			  
		ORDER BY
		  dbo.user_character.wWinRecord DESC
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByPvPLose(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.byPCClass,
		  dbo.user_character.wLoseRecord
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%'			  
		ORDER BY
		  dbo.user_character.wLoseRecord DESC
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByPvPTotal(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.byPCClass,
		  dbo.user_character.wWinRecord,
		  dbo.user_character.wLoseRecord,
		  dbo.user_character.wDrawRecord,
		  (wWinRecord + wLoseRecord + wDrawRecord) AS total
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%'			  
		ORDER BY
		  total DESC
  		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByPpoint(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.user_character.character_name,
		  dbo.GUILD_INFO.guild_name,
		  dbo.user_character.byPCClass,
		  dbo.user_character.dwLowAllRPoint
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		  INNER JOIN dbo.user_character ON (dbo.GUILD_CHAR_INFO.character_name = dbo.user_character.character_name)
		WHERE dbo.user_character.character_name LIKE '[GM]%'			  
		ORDER BY
		  dbo.user_character.dwLowAllRPoint DESC
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}
	
	function ByGuild(){
		$query = $this->db->query("
		SELECT TOP 50 
		  dbo.GUILD_INFO.guild_name,
		  dbo.GUILD_INFO.guild_Level,
		  COUNT(dbo.GUILD_CHAR_INFO.character_name) AS members
		FROM
		  dbo.GUILD_CHAR_INFO
		  INNER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
		GROUP BY
		  dbo.GUILD_INFO.guild_name,
		  dbo.GUILD_INFO.guild_Level
		ORDER BY
		  members DESC
		");
		if($query->num_rows() > 0){		
			$this->response(array('status' => 'true','data' => $query->result_array()), 200);	
		} else {
			$this->response(array('status' => 'false','error' => 'no data found'), 200);	
		}
	}		
}