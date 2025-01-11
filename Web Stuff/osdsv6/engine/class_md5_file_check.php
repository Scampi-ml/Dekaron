<?php
class md5_file_check
{
	private $i = 0;
	
	function Create($FILEN, $mode)
	{
		$dir = "./";

		if(is_dir($dir))
		{
			$Handle = opendir($dir);
			if($Handle)
			{
				$FHandle = fopen($FILEN, 'w');
				$this->ReadDir($Handle, $dir, $FHandle, $mode);
				//Cut trails
				$temps = file_get_contents($FILEN);
				$temps[strlen($temps) - 1] = "";
				file_put_contents($FILEN, $temps);
			}
		}
		return true;
	}

	function ReadDir($Handle, $dir, $FHandle, $mode)
	{
		while (($file = readdir($Handle)) !== false)
		{
			if(is_dir($dir.$file) && $file != ".." && $file != ".")
			{
				$NHandle = opendir($dir.$file."/");
				if($NHandle)
				{
					$this->ReadDir($NHandle, $dir.$file."/", $FHandle, $mode);
				}
			}
			elseif (is_file($dir.$file))
			{
			
				$Skip = array('file.list');
				if($mode == 1)
				{
					if($this->FileExt($file) == "zip" && !array_key_exists($file, $Skip) && $file[0] != '_')
					{
						$data = $this->FileName($file) . "," . filesize($dir.$file) . "*";
						$dat = $data;
						fwrite($FHandle, $dat);
						$this->i++;
					}
				}
				else
				if(!$this->CheckName($file, $Skip) && $file[0] != '_')
				{
					$data = $dir.$file . "," .md5_file($dir.$file);
					$dat = "$data\r\n";
					fwrite($FHandle, $dat);
					$this->i++;
				}
			}
			else
			{
				continue;
			}
		}
		closedir($Handle);
		return true;
	}

	function FileExt($file)
	{
		$TEMP = explode('.', $file);
		return $TEMP[count($TEMP) - 1];
	}

	function FileName($file)
	{
		$TEMP = explode('.', $file);
		return $TEMP[0];
	}

	function Load($FILEN)
	{
		$fp = fopen("list.txt", 'r');
		$TEMP['RESOURCE'] = fopen($FILEN, 'r');

		$i = 0;

		while (!feof($TEMP['RESOURCE']))
		{
			$TEMP['FILE'][$i] = fgets($TEMP['RESOURCE'], 1024);
			$i++;
		}

		for($c = 0; $c < count($TEMP['FILE']); $c++)
		{
			include($TEMP['FILE'][$i]);
		}

		unset($TEMP);
		return true;
	}

	function CheckName($file, $array)
	{
		for($i = 0; $i < count($array); $i++)
		{
			if($file == $array[$i])
			{
				return true;
				break;
			}
		}
		return false;
	}
}