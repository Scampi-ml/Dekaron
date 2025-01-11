<?php
class Acl{
	private $CI;
	private $modules;
	private $runtimeCache;
	public function __construct(){
		$this->modules = array();
		$this->runtimeCache = array();
		$this->CI = &get_instance();
	}
	public function requirePermission($permissionName, $moduleName = false){
		if(!$this->hasPermission($permissionName, $moduleName)){
			$this->CI->template->showError(lang("permission_denied", "error"));
		}
	}
	public function hasViewPermission($permissionName, $moduleName){
		$userId = false;
		if($this->CI->user->isOnline()){
			$userId = $this->CI->user->getId();
		}
		if(array_key_exists($moduleName, $this->runtimeCache) && array_key_exists($permissionName, $this->runtimeCache[$moduleName]) && array_key_exists($userId, $this->runtimeCache[$moduleName][$permissionName])){
			return $this->runtimeCache[$moduleName][$permissionName][$userId];
		}else{
			if($userId){
				$result = $this->CI->acl_model->hasPermission($userId, $permissionName, $moduleName, true);
			}else{
				$result = $this->CI->acl_model->hasPermissionGuest($permissionName, $moduleName, true);
			}
			return $result;
		}
	}
	public function hasPermission($permissionName, $moduleName = false, $userId = false){
		if(!$moduleName){
			$moduleName = $this->CI->template->module_name;
		}
		if(!$userId && $this->CI->user->isOnline()){
			$userId = $this->CI->user->getId();
		}
		if(array_key_exists($moduleName, $this->runtimeCache) && array_key_exists($permissionName, $this->runtimeCache[$moduleName]) && array_key_exists($userId, $this->runtimeCache[$moduleName][$permissionName])){
			return $this->runtimeCache[$moduleName][$permissionName][$userId];
		}else{
			$permission = $this->getPermission($permissionName, $moduleName);
			$result = $permission['default'];

			if($userId){
				$userPermission = $this->CI->acl_model->hasPermission($userId, $permissionName, $moduleName);
			}else{
				$userPermission = $this->CI->acl_model->hasPermissionGuest($permissionName, $moduleName);
			}
			if($userPermission !== null){
				$result = $userPermission;
			}
			return $result;
		}
	}
	public function getPermission($permissionName, $moduleName){
		if(!array_key_exists($moduleName, $this->modules)){
			$this->loadManifest($moduleName);
		}
		if(array_key_exists($permissionName, $this->modules[$moduleName]['permissions'])){
			return $this->modules[$moduleName]['permissions'][$permissionName];
		}else{
			show_error("The permission <b>".$permissionName."</b> does not exist in <b>".$moduleName."</b>");
		}
	}
	public function getManifestRole($roleName, $moduleName){
		if(!array_key_exists($moduleName, $this->modules)){
			$this->loadManifest($moduleName);
		}
		if(array_key_exists($roleName, $this->modules[$moduleName]['roles'])){
			return $this->modules[$moduleName]['roles'][$roleName];
		}else{
			return false;
		}
	}
	private function loadManifest($moduleName){
		if(!file_exists("application/modules/".$moduleName."/manifest.json")){
			show_error("The manifest.json file for <b>".strtolower($moduleName)."</b> does not exist");
		}
		$manifest = file_get_contents("application/modules/".$moduleName."/manifest.json");
		$manifest = json_decode($manifest, true);
		if(!is_array($manifest)){
			show_error("The manifest.json file for <b>".strtolower($moduleName)."</b> is not properly formatted");
		}
		$this->modules[$moduleName]['permissions'] = (array_key_exists("permissions", $manifest)) ? $manifest['permissions'] : array();
		$this->modules[$moduleName]['roles'] = (array_key_exists("roles", $manifest)) ? $manifest['roles'] : array();
	}
}