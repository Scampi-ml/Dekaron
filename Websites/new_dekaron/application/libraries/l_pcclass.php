<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class L_pcclass {

    public function class2name($class)
    {
		$array_class = array(
			'0' => 'Azure Knight', 
			'1' => 'Segita Hunter', 
			'2' => 'Incar Magician', 
			'3' => 'Vicious Summoner', 
			'4' => 'Segnale', 
			'5' => 'Bagi Warrior', 
			'6' => 'Aloken',
			'9' => 'Dark Wizard',
			'10' => 'Concerra Summoner',
			'11' => 'Seguriper',
			'12' => 'Half Bagi'
		);
		return $array_class[$class];
    }
	
	
    public function class2nameArray()
    {
		$array_class = array(
			'0' => 'Azure Knight', 
			'1' => 'Segita Hunter', 
			'2' => 'Incar Magician', 
			'3' => 'Vicious Summoner', 
			'4' => 'Segnale', 
			'5' => 'Bagi Warrior', 
			'6' => 'Aloken',
			'9' => 'Dark Wizard',
			'10' => 'Concerra Summoner',
			'11' => 'Seguriper',
			'12' => 'Half Bagi'
		);
		return $array_class;
    }	
}




