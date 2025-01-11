<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wgrade {

    public function number2grade($grade)
    {
		$array_grade = array(
			'0' => 'No Grade Yet',
			'1' => 'New Trainee',
			'2' => 'Trainee',
			'3' => 'Senior Trainee',
			'4' => 'Elite Trainee',
			'5' => 'New Infantry',
			'6' => 'Infantry',
			'7' => 'Senior Infantry',
			'8' => 'Elite Infantry',
			'9' => 'New Captain',
			'10' => 'Captain',
			'11' => 'Senior Captain',
			'12' => 'Elite Captain',
			'13' => 'New Squire',
			'14' => 'Squire',
			'15' => 'Senior Squire',
			'16' => 'Elite Squire',
			'17' => 'New Knight',
			'18' => 'Knight',
			'19' => 'Senior Knight',
			'20' => 'Elite Knight',
			'21' => 'New Knight Commander',
			'22' => 'Knight Commander',
			'23' => 'Senior Knight Commander',
			'24' => 'Elite Knight Commander',
			'25' => 'New Baron',
			'26' => 'Baron',
			'27' => 'Senior Baron',
			'28' => 'Elite Baron',
			'29' => 'New Duke',
			'30' => 'Duke',
			'31' => 'Senior Duke',
			'32' => 'Elite Duke',
			'33' => 'New Prince',
			'34' => 'Prince',
			'35' => 'Senior Prince',
			'36' => 'Elite Prince',
			'37' => 'New Archduke',
			'38' => 'Archduke',
			'39' => 'Senior Archduke',
			'40' => 'Elite Archduke',
			'41' => 'New King',
			'42' => 'King',
			'43' => 'Senior King',
			'44' => 'Elite King',
			'45' => 'New Emperor',
			'46' => 'Emperor',
			'47' => 'Senior Emperor',
			'48' => 'Guardian'
		);
		return $array_grade[$grade];
    }
}







