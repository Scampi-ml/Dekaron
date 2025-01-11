<?php

class Reborn_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getTeleportLocations()
	{
		return array();
	}
	
	public function teleportLocationExists()
	{
		return array();
	}

	public function getLocationRealm($id)
	{
		return array();
	}
	
	public function characterExists($guid, $realmConnection)
	{
		return array();
	}
	
	public function setLocation($x, $y, $z, $o, $mapId, $characterGuid, $realmConnection)
	{
		
	}


}
