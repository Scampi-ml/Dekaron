<?php
class Cms_model extends CI_Model{
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db = $this->load->database("default", true);
	}
	public function getModuleConfigKey($moduleId, $key){
		$query = $this->db->query("SELECT m.id, m.module_id, m.key, m.value, m.date_added, m.date_changed FROM modules_configs m WHERE m.module_id = ? AND m.key = ?", array((int)$moduleId, (string)$key));
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return null;
	}
	public function getSideboxes(){
		$query = $this->db->query("SELECT * FROM sideboxes ORDER BY `order` ASC");
		return $query->result_array();
	}
	public function getSlides(){
		$query = $this->db->query("SELECT * FROM image_slider ORDER BY `order` ASC");
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}
	public function getLinks($side = "top"){
		if(in_array($side, array("top", "side"))){
			$query = $this->db->query("SELECT * FROM menu WHERE side = ? ORDER BY `order` ASC", array($side));
		}else{
			$query = $this->db->query("SELECT * FROM menu ORDER BY `order` ASC", array($side));
		}
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return null;
	}
	public function getPage($page){
		$this->db->select('*')->from('pages')->where('identifier', $page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return null;
	}
	public function getPages(){
		$this->db->select('*')->from('pages');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}
		return null;
	}
}