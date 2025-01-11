<?php

mysql_connect("mysql1049.servage.net", "c0d3r3d9", "c0d3r3d91") or die(mysql_error());

mysql_select_db("c0d3r3d9") or die(mysql_error());

	
//google code secret key
$google_code_secret_key = '39O5_G2YDwFrSvRG';
//get revision commit data
$revision_data=file_get_contents('php://input');
//build secret verify info;
$secret_verify=hash_hmac("md5",$revision_data,$google_code_secret_key);
//get google secret info
$google_secret_info=$_SERVER['HTTP_GOOGLE_CODE_PROJECT_HOSTING_HOOK_HMAC'];

//prase revision commit data
$revision_info=json_decode($revision_data);
//var_export $revision info
$revision_var_export=var_export($revision_info,true);

foreach($revision_info->revisions as $revision){
	$project_id = '1';
	
	  $query = mysql_query("INSERT INTO svn_revisions (project_id, revision, url, author, timestamp, message) VALUES (
			'$project_id',
			'$revision->revision',
			'$revision->url',
			'$revision->author',
			'$revision->timestamp',
			'$revision->message'
	)");
	
}


?>