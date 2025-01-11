<?php
//*--------------------------------------------------------
// 					Site Settings
//*--------------------------------------------------------
$config['site'] = array(
	'title' 			=> 'Salvation Dekaron',														// Title (In the most upper bar of your browser)
	'name' 				=> 'Salvation Dekaron',														// Your server name, this will be used on the whole site
	'keywords' 			=> '',																		// Keywords, mostly for google
	'description'  		=> '',																		// Description, mostly for google
	'author' 			=> 'Janvier123',															// !!!!!!!!!!!!!! DO NOT CHANGE !!!!!!!!!!!!!!
	'version'			=> '1',																		// !!!!!!!!!!!!!! DO NOT CHANGE !!!!!!!!!!!!!!
	'support_url'		=> 'http://www.salvationdekaron.com/forums/',								// Your support URL, this can be a forum URL
	'forums_url'		=> '/forums/',																// Your Forums page URL
	'tos_url'			=> 'tos/',													                // Your Terms Of Service URL, this can be a forum URL (*)
	'faq_url'			=> 'http://www.salvationdekaron.com/forums/index.php?/topic/1309-frequently-asked-questions-faqs/',										// Your FAQ page URL
);
//(*)
// If you want to use your own TOS page, please enter the URL (including http://www), if you want to use the build-in page, enter "tos/"
// You can edit this page in "/application/views/view_tos.php"

//*--------------------------------------------------------
// 					Social Settings
//*--------------------------------------------------------
// Leave the URLs blank if you dont want to show the icons
// url, target, title, icons
// Image Icons: (Found in "/assets/images/social")
//aim, amazon-1, amazon-2, android, aol, apple, appstore, bebo, behance, bing, bleetbox, blinklist, blogger, brightkite-1, brightkite-2, cargocollective, coroflot, delicious, designfloat, designmoo, deviantart, digg, diglog, dopplr, dribbble, dzone, ebay, ember, evernote, facebook, feedburner-1, feedburner-2, flickr-1, flickr-2, foursquare, fresqui, friendfeed, friendster, furl, gamespot, gmail, google, googlebuzz, gowalla, gravee, grooveshark-1, grooveshark-2, gtalk, hi5-1, hi5-2, hyves-1, hyves-2, identica, ilike, isociety, lastfm, linkedin, livejournal, magnolia, metacafe, misterwong, mixx, mobileme, msn, mynameise, myspace, netvibes, newsvine, ning, openid-1, openid-2, orkut, pandora, paypal, picasa, pimpthisblog, plurk, posterous, qik, readernaut, reddit, rss, sharethis, skype, slashdot, sphere, sphinn, spotify, springpad, stumbleupon, technorati, tripadvisor, tuenti, tumblr, twitter, viddler, vimeo, virb, webshots, windows, wordpress, xing, yahoo, yahoobuzz, yelp, youtube, zanatic, zootool, 
$config['social_active'] 					= TRUE;												// IF set to FALSE, NO icons will be displayed, if set to TRUE the array below will be used
$config['social'] = array(
	array('http://www.twitter.com', 		'_self', 		'Visit us on Twitter', 			'twitter'),
	array('https://www.facebook.com/salvationdekaron', 		'_self', 		'Visit us on Facebook', 		'facebook'),
	array('http://www.youtube.com', 		'_self', 		'Visit us on YouTube', 			'youtube'),
	array('http://dekaronuprising.net/landing.htm', 			'_self', 		'Visit our Sponsor', 			'rising'),
);

//*--------------------------------------------------------
// 					Download Settings
//*--------------------------------------------------------
$config['download_page_active'] 				= TRUE; 											// Set this to "FALSE" if you want to use your own download page Ex. IP Downloads (IPB forum Mod) IF this is set to "TRUE", fill in settings below
$config['download_page_url'] 					= '';												// IF the above is set to "TRUE", fill in your url to your download page
// Url, Name, image, ShortCode
// Save your image files in /assets/images/downloads/
$config['downloads'] = array(
	array('http://www.mediafire.com/download/hc31a8vc636cgoa/Salvation_Dekaron.exe', 		'MediaFire', 				'downloadfile.png', 	'mirror_1'),
	array('https://mega.co.nz/#!zdkB1ZCZ!3V1sG1Mo8QQ5OsAYpz-Qi1bB0gLdQ8SUa8FHow3WeIY', 		'Mega Upload', 				'downloadfile.png', 	'mirror_2'),	
	array('https://drive.google.com/file/d/0B6WQgBMMFX5mWmxrNzN5M3hpWEU/edit?usp=sharing', 		'Google Drive', 			'downloadfile.png', 	'mirror_3'),
);



//*--------------------------------------------------------
// 				Server Online / Offline Settings
//*--------------------------------------------------------
// IP, Port, Server Name, Timeout, ShortCode
// WARNING: This array has been populated with DUMMY DATA!
// Use: '127.0.0.2' as dummy data, this will always return ONLINE, usefill if ports are closed
$config['servers'] = array(
	array('37.59.180.41', 		'1433', 	'MsSQL Server',			'3',	'mssql_server'),
	array('127.0.0.2', 		    '7880', 	'Session Server',		'3',	'session_server'),
	array('127.0.0.2', 		    '50005', 	'Game Server',			'3',	'game_server'),
	array('127.0.0.2', 		    '80', 		'Web Server',			'3',	'web_server'),
	array('127.0.0.2', 		    '9194', 	'Teamspeak Server',		'3',	'teamspeak_server'),
);

//*--------------------------------------------------------
// 					Slider Settings
//*--------------------------------------------------------
// Url, Omg, title, Target
// NOTE: change the URL to "#" for no link
// NOTE: images go into the "assets/images/slider/" folder, just add the image name
// NOTE: Target => http://www.w3schools.com/tags/att_a_target.asp
$config['slider'] = array(
	array('#', 	's1.png', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	's2.png', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	's3.png', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	's4.png', 	'This is the text when you hover on the image',		'_self'),
);

//*--------------------------------------------------------
// 					Forum News Settings
//*--------------------------------------------------------
// Add the ids of the forums
$config['forums_all'] 						= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=28,23,29,22&show=10&type=rss';
$config['forums_news'] 						= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=28&show=10&type=rss';
$config['forums_event'] 					= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=23&show=10&type=rss';
$config['forums_notice'] 					= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=29&show=10&type=rss';
$config['forums_update'] 					= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=22&show=10&type=rss';