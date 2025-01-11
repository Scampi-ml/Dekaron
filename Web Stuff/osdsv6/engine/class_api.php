<?php

class dac_api
{
	var $the_mssql_query;
	var $the_mssql_link;
	var $mssql_host;
	var $mssql_user;
	var $mssql_pasw;
	var $persistent;
	

	function SQLquery()
	{
	
		$args = func_get_args();
		$num = func_num_args();
		if($num > 1)
		{
			$array = array();
			for($i=1;$i < $num; $i++)
			{	
				// Escape all input data.
				$array[] = preg_replace('/\'/','\'\'', $args[$i]);
			}
			
			$request = 'http://localhost:8080/dac_api/dac_api.php?api_key='.$dac_api_key.'&query='.base64_encode(vsprintf($args[0], $array)).'');
			$response = file_get_contents($request);
			$jsonobj = json_decode($response);
			return $jsonobj;
			
			
		}
		else
		{
			$request = 'http://localhost:8080/dac_api/dac_api.php?api_key='.$dac_api_key.'&query='.base64_encode($args[0]).'');
			$response = file_get_contents($request);
			$jsonobj = json_decode($response);
			return $jsonobj;
		}

		
	}
	
	function SQLfetchArray($result)
	{
		$return = mssql_fetch_array($result);
		return $return;
	}
	
	function SQLfetchRow($result)
	{
		$return = mssql_fetch_row($result);
		return mssql_fetch_row($result);		
	}
	
	function SQLfetchNum($result)
	{
		$return = mssql_num_rows($result);
		return $return;
	}
	
	function SQLerror($error)
	{
		$error_tpl = '
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>SQL Error</title>
		<link rel="stylesheet" type="text/css" href="style/error.css" />
		</head>
		<body>
		<div align="center">
		  <div class="maintenance" style="margin-top: 40px;">
			<div class="maintenance_title" align="left">SQL Error</div>
			<div class="maintenance_reason" align="left">'.$error.'</div>
		  </div>
		</div>
		</body>
		</html>
		<br><br>
		';	
		return $error_tpl;
	}
			
	function SQLclose()
	{
		mssql_close($this->the_mssql_link);
	}
}
?> 