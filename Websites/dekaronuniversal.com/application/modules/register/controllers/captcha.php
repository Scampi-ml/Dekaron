<?php
class Captcha
{
	private $stack = "abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ123456789";
	private $length = 6;
	private $distortionLevel = 8;
	private $value;
	private $stackLength;

	public function __construct($enable = true)
	{
		$this->stackLength = strlen($this->stack) - 1;
		if(session_id() == '')
		{
			session_start();
		}
		if(isset($_SESSION['captcha']))
		{
			$this->value = $_SESSION['captcha'];
		}
		if(!$enable)
		{
			$this->value = false;
		}
	}

	public function generate()
	{
		$this->value = "";
		for($i = 0; $i < $this->length; $i++)
		{
			$this->value .= $this->random();
		}
		$_SESSION['captcha'] = $this->value;
	}

	private function random()
	{
		return $this->stack{rand(0, $this->stackLength)};
	}

	public function output($width, $height)
	{
		$image = imagecreatetruecolor($width, $height);
		$backgroundColor = imagecolorallocate($image, 0, 0, 0);
		$textColor = imagecolorallocate($image, 250, 0, 0);
		imagecolortransparent($image, $backgroundColor);
		imagestring($image, 5, 3, 4, $this->value, $textColor);
		for($i = 0; $i < $this->distortionLevel; $i++)
		{
			imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), imagecolorallocatealpha($image, rand(0,255), rand(0,255), rand(0,255), 60));
		}
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-type: image/png");  
		imagepng($image);  
	}

	public function getValue()
	{
		return $this->value;
	}
}