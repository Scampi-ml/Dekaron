<?php
function createNewid($length = 0, $characters = 12){
	if ($characters == ''){ return ''; }
	$chars_length = strlen($characters)-1;
	mt_srand((double)microtime()*1000000);
	$newid = '';
	while(strlen($newid) < $length){
		$rand_char = mt_rand(0, $chars_length);
		$newid .= $characters[$rand_char];
	}
	return $newid;
}	

$user = createNewid(6, 'abcdefghijklmnopqrstuvwxyz01234567890');
$pasw = createNewid(6, 'abcdefghijklmnopqrstuvwxyz01234567890');
$email= createNewid(4, 'abcdefghijklmnopqrstuvwxyz01234567890').'@'.createNewid(4, 'abcdefghijklmnopqrstuvwxyz01234567890').'.com';

$friends = array(
	'http://dekaron-extreme.org/register.php',
	'http://dekahorizon.sytes.net/index.php?do=register',
	'http://portal.elysium-dekaron.com/account/?do=register',
);

// Create an array of friends :)
sort($friends);
// Randomly select a winner!
$winner = array_rand($friends, 1);
$winner_name = $friends[$winner];
// Print the winner's name
echo "<p>$winner_name</p>";

$fields = array(
		'accname' => $user,
		'accpass1' => $pasw,
		'accpass2' => $pasw,
		'accmail' => $email,
		'activ' => '1',
		'sub' => 'Create Account',
);
$fields_string = '';

// url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $winner_name);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
echo curl_exec($ch);
curl_close($ch);
?>
<meta http-equiv="refresh" content="0">