<?php
$config['site'] = array(
	'name' 				=> 'Salvation Dekaron',														// Your server name, this will be used on the whole site
	'keywords' 			=> '',																		// Keywords, mostly for google
	'description'  		=> '',																		// Description, mostly for google
	'author' 			=> 'Janvier123',															// !!!!!!!!!!!!!! DO NOT CHANGE !!!!!!!!!!!!!!
	'support_url'		=> '/forums/',								// Your support URL, this can be a forum URL
	'forums_url'		=> '/forums/',								// Your Forums page URL
	'download_url'		=> '/forums/index.php?/files/',
);


$config['api_url'] = 'http://108.61.84.154:8181/api/';


$config['rss_news_url']			= 'http://www.salvationdekaron.com/forums/rss/forums/1-website/';
$config['rss_news_url_more'] 	= 'http://www.salvationdekaron.com/forums/index.php?/forum/32-announcements/';


// Vote :> http://www.xtremetop100.com/in.php?site=1132347217

//*--------------------------------------------------------
// 					Social Settings
//*--------------------------------------------------------
$config['social'] = array(
	array('https://www.facebook.com/salvationdekaron', 	'_self', 		'Visit us on Facebook', 	'facebook'),
	array('https://www.twitter.com/SalvationAct9', 		'_self', 		'Visit us on Twitter', 		'twitter'),
	array('http://www.dekaronuprising.net', 			'_self', 		'Visit us on Sponsor', 		'rising'),
);


//*--------------------------------------------------------
// 					Paymentwall Settings
//*--------------------------------------------------------
$config['paymentwall_active'] 				= true;													// If you want paymentwall to be active set this to "TRUE"
$config['paymentwall_key'] 					= '';					// Your Paymentwall KEY 		=> See paymentwall for more into
$config['paymentwall_secret'] 				= '';					// Your Paymentwall SECRET 		=> See paymentwall for more into
$config['paymentwall_widget'] 				= 'p10_1';												// Paymentwall Widget Code
$config['paymentwall_sign_version'] 		= '2';													// Paymentwall Sign Version | DO NOT CHANGE, UNLESS YOU ARE TOLD TO CHANGE IT

//*--------------------------------------------------------
// 					Slider Settings
//*--------------------------------------------------------
$config['slider'] = array(
	array('#', 	's1.png', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	's2.png', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	's3.png', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	's4.png', 	'This is the text when you hover on the image',		'_self'),
);