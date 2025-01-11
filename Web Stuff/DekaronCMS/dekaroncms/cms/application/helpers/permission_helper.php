<?php

function hasPermission($permissionName, $moduleName = false, $user_no = false)
{
	static $CI;
	if(!$CI){$CI = &get_instance();}
	return $CI->acl->hasPermission($permissionName, $moduleName, $user_no);
}

function hasViewPermission($permissionName, $moduleName)
{
	static $CI;
	if(!$CI){$CI = &get_instance();}
	return $CI->acl->hasViewPermission($permissionName, $moduleName);
}

function requirePermission($permissionName, $moduleName = false)
{
	static $CI;
	if(!$CI){$CI = &get_instance();}
	return $CI->acl->requirePermission($permissionName, $moduleName);
}

function adminPerm()
{
	static $CI;
	if(!$CI){$CI = &get_instance();}
	if(!$CI->session->userdata('admin_access')){$CI->template->showError("permission_denied");}
}