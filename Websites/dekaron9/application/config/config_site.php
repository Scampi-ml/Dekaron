<?php
//*--------------------------------------------------------
// 					Site Settings
//*--------------------------------------------------------
$config['site'] = array(
	'name' 				=> 'Dekaron9',														// Your server name, this will be used on the whole site
	'keywords' 			=> '',																// Keywords, mostly for google
	'description'  		=> '',																// Description, mostly for google
	'author' 			=> 'Janvier123',													// !!!!!!!!!!!!!! DO NOT CHANGE !!!!!!!!!!!!!!
	'version'			=> '1',																// !!!!!!!!!!!!!! DO NOT CHANGE !!!!!!!!!!!!!!
	'support_url'		=> 'http://www.dekaron9.com/forums/',								// Your support URL, this can be a forum URL
	'forums_url'		=> 'forums/',														// Your Forums page URL
	'tos_url'			=> 'tos/',													        // Your Terms Of Service URL, this can be a forum URL (*)
	'faq_url'			=> 'http://www.dekaron9.com',										// Your FAQ page URL
);
//(*)
// If you want to use your own TOS page, please enter the URL (including http://www), if you want to use the build-in page, enter "tos/"
// You can edit this page in "/application/views/view_tos.php"

//*--------------------------------------------------------
// 					CSS Settings
//*--------------------------------------------------------
$config['header_css'] = array('default.css','cms.css','main.css');


//*--------------------------------------------------------
// 					JS Settings
//*--------------------------------------------------------
$config['header_js']  = array('jquery.min.js','ui.js','main.js');	


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
	array('http://www.google.com', 			'_self', 		'Visit us on Google', 			'google'),
	array('http://www.digg.com', 			'_self', 		'Visit us on Digg', 			'digg'),
	array('http://www.facebook.com', 		'_self', 		'Visit us on Facebook', 		'facebook'),
	array('http://www.youtube.com', 		'_self', 		'Visit us on YouTube', 			'youtube'),
);


//*--------------------------------------------------------
// 					Paymentwall Settings
// There are NO settings for paymentwall like paypal, please set you info on the payment wall info
//*--------------------------------------------------------
$config['paymentwall_active'] 				= FALSE;												// If you want paymentwall to be active set this to "TRUE"
$config['paymentwall_key'] 					= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';					// Your Paymentwall KEY 		=> See paymentwall for more into
$config['paymentwall_secret'] 				= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';					// Your Paymentwall SECRET 		=> See paymentwall for more into
$config['paymentwall_widget'] 				= 'p4_1';												// Paymentwall Widget Code
$config['paymentwall_sign_version'] 		= '2';													// Paymentwall Sign Version | DO NOT CHANGE, UNLESS YOU ARE TOLD TO CHANGE IT


//*--------------------------------------------------------
// 					PayPal Settings
//*--------------------------------------------------------
$config['paypal_sandbox'] 					= false;												// Sandbox Mode => Used for testing 	=> https://developer.paypal.com/   | Default: "false"
$config['paypal_email'] 					= 'terracidebaker19@gmail.com';							// Your paypal email or business 
$config['paypal_currency_code'] 			= 'USD'; 												// Ex. USD, EUR, ...
$config['paypal_cbt'] 						= 'Return to merchant to retrieve your coins';			// The button name to return to the website
$config['paypal_lc'] 						= 'US';													// Location Code, Ex. US, BE, DE, ...
$config['paypal_button'] 					= 'Pay for product on PayPal';							// Button name
$config['paypal_symbol'] 					= '$'; 													// Ex. $ | € | £ | ....
$config['paypal_item_name'] 				= 'Coins';												// Ex. Coins
$config['paypal_custom_list'] 				= false; 												// * (See Below) | Default: false
// *
// IF THIS IS SET TO "true" => 		the 3th array will be used in the paypal_packages 				Ex. 1000 Custom Coins $5,00 USD
// IF THIS IS SET TO "false" => 	the 1ste and 2nd will be used in the paypal_packages 			Ex. 1000 Coins For $5,00 USD


// Price, Coin amount, Text (if "paypal_custom_list" is set to true, fill in your own text, if not, leave it like it is )
// If you dont like to change this, ASK before you start to mess with it!
$config['paypal_packages'] = array(
	array('5.00', 		'1200', 		'1200 D-Shop Coins $5,00 USD'),
	array('10.00', 		'2100', 		'2100 D-Shop Coins $10,00 USD'),
	array('15.00', 		'3200', 		'3200 D-Shop Coins $15,00 USD'),
	array('20.00', 		'4300', 		'4300 D-Shop Coins $20,00 USD'),
	array('25.00', 		'6400', 		'6400 D-Shop Coins $25,00 USD'),
	array('30.00', 		'7500', 		'7500 D-Shop Coins $30,00 USD'),
	array('40.00', 		'10600', 		'10600 D-Shop Coins $40,00 USD'),
	array('50.00', 		'21700', 		'21700 D-Shop Coins $50,00 USD'),
	array('75.00', 		'41800', 		'41800 D-Shop Coins $75,00 USD'),
	array('100.00', 	'61900', 		'61900 D-Shop Coins $100,00 USD'),
);
//*--------------------------------------------------------
// 					Download Settings
//*--------------------------------------------------------
$config['download_page_active'] 				= TRUE; 											// Set this to "FALSE" if you want to use your own download page Ex. IP Downloads (IPB forum Mod) IF this is set to "TRUE", fill in settings below
$config['download_page_url'] 					= '';												// IF the above is set to "TRUE", fill in your url to your download page
// Url, Name, image, ShortCode
// Save your image files in /assets/images/downloads/
$config['downloads'] = array(
	array('http://www.mediafire.com/download/y6u9m6ogljd972y/Salvation%20Dekaron.rar', 		'Media Fire Full Client 00.00.40', 			'downloadfile.png', 	'mirror_1'),
	array('https://docs.google.com/uc?id=0B86tK1gQkAQPU2RMVlN5UnVXZnc&export=download', 	'Full Client (Google Drive) 00.00.40', 		'downloadfile.png', 	'mirror_2'),
	array('https://mega.co.nz/#!nRljRTQD!EDloSABfpmwazXEPdZx5_g6BWLE0ML5DCNr5Ekk0hps', 		'Mega - Full Client 00.00.40', 				'downloadfile.png', 	'mirror_3'),
);

//*--------------------------------------------------------
// 					Slider Settings
//*--------------------------------------------------------
// Url, Omg, title, Target
// NOTE: change the URL to "#" for no link
// NOTE: images go into the "assets/images/slider/" folder, just add the image name
// NOTE: Target => http://www.w3schools.com/tags/att_a_target.asp
$config['slider'] = array(
	array('#', 	'1.jpg', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	'2.jpg', 	'This is the text when you hover on the image',		'_self'),
	array('#', 	'3.jpg', 	'This is the text when you hover on the image',		'_self'),
);


//*--------------------------------------------------------
// 					Forum News Settings
//*--------------------------------------------------------
// Add the ids of the forums
$config['forums_all'] 						= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=28,23,29,22&show=5&type=rss';
$config['forums_news'] 						= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=28&show=5&type=rss';
$config['forums_event'] 					= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=23&show=5&type=rss';
$config['forums_notice'] 					= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=29&show=5&type=rss';
$config['forums_update'] 					= 'http://www.salvationdekaron.com/forums/forum_posts.php?a=out&f=22&show=5&type=rss';
$config['forums_update_interval']			= '3600';												// Time in seconds to update the forums news (All news) | 3600 Seconds = 1hr

//*--------------------------------------------------------
// 					Email Settings
//*--------------------------------------------------------
/*
$config['email_name'] 						= 'New Dekaron';             							// The name that will be used to send outgoing email (From: xxxxx)	
$config['protocol'] 						= 'smtp';												// mail, sendmail, or smtp| 																	DO NOT CHANGE THIS !!!!!!!!!!		
$config['smtp_host'] 						= 'smtp1.servage.net';									// SMTP Server Address
$config['smtp_user'] 						= 'janvier123@janvier123.be';							// SMTP Username
$config['smtp_pass'] 						= '';													// SMTP Password
$config['smtp_port'] 						= '2525';												// SMTP Port
$config['mailtype'] 						= 'html';												// text or html	Type of mail. If you send HTML email you must send it as a complete web page. 
$config['smtp_timeout'] 					= '1';													// SMTP Timeout (in seconds)
$config['newline']        					= "\r\n";												// Newline character. (Use "\r\n" to comply with RFC 822).| 									DO NOT CHANGE THIS !!!!!!!!!!
$config['crlf']            					= "\r\n";												// Newline character. (Use "\r\n" to comply with RFC 822).| 									DO NOT CHANGE THIS !!!!!!!!!!
$config['charset']        					= "utf-8"; 												// haracter set (utf-8, iso-8859-1, etc.)| 														DO NOT CHANGE THIS !!!!!!!!!!
$config['priority']        					= "3"; 													// Email Priority. 1 = highest. 5 = lowest. 3 = normal.| 										DO NOT CHANGE THIS !!!!!!!!!!
$config['useragent']						= "CodeIgniter";										// The "user agent" | 																			DO NOT CHANGE THIS !!!!!!!!!!
$config['validate']							= FALSE;												// TRUE or FALSE (boolean)	Whether to validate the email address. | 							DO NOT CHANGE THIS !!!!!!!!!!
$config['wordwrap']							= TRUE;													// TRUE or FALSE (boolean)	Enable word-wrap. | 												DO NOT CHANGE THIS !!!!!!!!!!
$config['bcc_batch_mode']					= FALSE;												// TRUE or FALSE (boolean)	Enable BCC Batch Mode | 											DO NOT CHANGE THIS !!!!!!!!!!
$config['bcc_batch_size']					= 200;													// Number of emails in each BCC batch | 														DO NOT CHANGE THIS !!!!!!!!!!
*/

//*--------------------------------------------------------
// 					Vote Settings
//*--------------------------------------------------------
// NOTE: images go into the "assets/images/vote/" folder, just add the image name
// DO NOT ADD OR REMOVE ANY LINES! MAX 5 VOTE SITES
// 								Name 					 Url 													Reward  	Delay 		Log   		Active  	Image
$config['vote_site_1'] = array('Extreme Gamelist',		'http://www.google.com',								'15',		'43200',		true,		false,		'extreme-gamelist.jpg');
$config['vote_site_2'] = array('Arena Top 100',			'http://www.arena-top100.com/?ref=SalvationDK',			'65',		'43200', 		true,		true,		'arena-top100.png');
$config['vote_site_3'] = array('Xtremetop100', 			'http://www.xtremetop100.com/in.php?site=1132347217', 	'65',		'43200',		true, 		true,		'XtremeTop100.png');	
$config['vote_site_4'] = array('GTop 100',				'http://www.google.com',								'15',		'43200',		true,		false,		'votebutton.jpg');
$config['vote_site_5'] = array('Vote Site 5',			'http://www.google.com',								'0',		'43200',		false,		false,		'image.jpg');

// Change "<YOUR SERVER NAME HERE>" to your server name
//$config['vote_message'] ='Thank you for voting for Salvation Dekaron!\n\nPlease fill in the security code to complete the voting proccess.\n\nThank You';					// use "\n" for a new line (Without the ")


//*--------------------------------------------------------
// 					Deadfront Settings
//*--------------------------------------------------------
// Time, RecordEnableCount, MinLevel, MaxLevel
$config['deadfront_list'] = array(
	array('12:00', 	'4', 	'21',	'45'),
	array('16:00', 	'4', 	'46',	'70'),
	array('20:00', 	'4', 	'71',	'90'),
	array('24:00', 	'4', 	'91',	'110'),
	array('04:00', 	'4', 	'111',	'130'),
	array('08:00', 	'4', 	'131',	'170'),
);


$hour_now = date('H');
if($hour_now == '0'){$next = '02';}
if($hour_now == '1'){$next = '02';}
if($hour_now == '2'){$next = '04';}
if($hour_now == '3'){$next = '04';}
if($hour_now == '4'){$next = '06';}
if($hour_now == '5'){$next = '06';}
if($hour_now == '6'){$next = '08';}
if($hour_now == '7'){$next = '08';}
if($hour_now == '8'){$next = '10';}
if($hour_now == '9'){$next = '10';}
if($hour_now == '10'){$next = '12';}
if($hour_now == '11'){$next = '12';}
if($hour_now == '12'){$next = '14';}
if($hour_now == '13'){$next = '14';}
if($hour_now == '14'){$next = '16';}
if($hour_now == '15'){$next = '16';}
if($hour_now == '16'){$next = '18';}
if($hour_now == '17'){$next = '18';}
if($hour_now == '18'){$next = '20';}
if($hour_now == '19'){$next = '20';}
if($hour_now == '20'){$next = '22';}
if($hour_now == '21'){$next = '22';}
if($hour_now == '22'){$next = '24';}
if($hour_now == '23'){$next = '24';}
$config['deadfront_time'] = (mktime($next, 0, 0) - time());