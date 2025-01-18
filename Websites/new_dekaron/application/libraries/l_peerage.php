<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class L_peerage {

    public function peeragecode2peeragename($peerage_code)
    {
		$array_class = array(
			'0' => 'Guild Leader', 
			'1' => 'Sub guild leader',
			'2' => 'Strategist',
			'3' => 'The royal guard',
			'4' => 'Imperator',
			'5' => 'General',
			'6' => 'Patrol team',
			'7' => 'Senior',
			'8' => 'Trainee',
			'9' => 'Guild member', 
		);
		return $array_class[$peerage_code];
    }
}




