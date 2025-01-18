<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class L_clearcount {

    public function byskill($value)
    {
		$byskillclearcount = array('0' => "Unused", '1' => "Used");
        return $byskillclearcount[$value];
    }
	
	
	public function bystat($value)
	{
		$bystatclearcount = array('0' => "Unused", '1' => "Used");	
		return $bystatclearcount[$value];
	}
	
}




