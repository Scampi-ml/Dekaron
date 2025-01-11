<?php

class ConfigEditor
{
	private $file;
	private $data;

	public function __construct($file)
	{
		$this->data = "";
		$this->file = $file;

		$handle = fopen($this->file, "r");

		while(!feof($handle))
		{
			$this->data .= fgets($handle);
		}

		fclose($handle);
	}

	public function set($key, $value)
	{
		if(is_array($value))
		{
			$value = "array(".implode(",", $value).")";
		}
		elseif(is_bool($value))
		{
			$value = ($value) ? "true" : "false";
		}
		elseif(in_array($value, array("true", "false")))
		{
			$value = $value;
		}
		elseif(is_numeric($value))
		{
			$value = $value;
		}
		elseif(empty($value))
		{
			$value = "false";
		}
		elseif(preg_match("/^([0-9]*,? ?)*$/", $value))
		{
			$value = "array(".$value.")";
		}
		else
		{
			$value = "\"".str_replace('"', '\"', $value)."\"";
		}
		
		if(preg_match("/.*-.*/", $key))
		{
			$parts = explode("-", $key);

			preg_match('/\$config\[["\']'.$parts[0].'["\']\] ?= [^;]*/', $this->data, $matches);

			if(count($matches))
			{
				$matches[0] = preg_replace('/^\$config\[["\']'.$parts[0].'["\']\] ?= /', "", $matches[0]);
				$matches[0] = preg_replace('/;$/', "", $matches[0]);

				$key = $parts[0];
				$value = preg_replace('/["\']'.$parts[1].'["\'] ?=> ?["\']?.*["\']?,?/', "'".$parts[1]."' => ".$value.",", $matches[0]);
			}
		}

		$this->data = preg_replace('/\$config\[["\']'.$key.'["\']\] ?= ?["\']?.*["\']?;/', "\$config['".$key."'] = ".$value.";", $this->data);
	}
	
	public function save()
	{
		$file = fopen($this->file, "w");
		fwrite($file, $this->data);
		fclose($file);
	}

	public function get()
	{
		return $this->data;
	}
}