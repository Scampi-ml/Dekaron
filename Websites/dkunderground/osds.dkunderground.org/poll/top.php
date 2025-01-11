<?php

include ("config.php");

if (isset ($_REQUEST['poll'])) {

	$result = mysql_query ("SELECT pollid, title, starts, expires, vote, voting, results, graph, resultsvotes, ip, cookies FROM polls WHERE status='on' AND pollid='$_REQUEST[poll]'");
	
} else {

	$result = mysql_query ("SELECT pollid, title, starts, expires, vote, voting, results, graph, resultsvotes, ip, cookies FROM polls WHERE status='on' ORDER BY pollid DESC LIMIT 1");
	
}

$totalpolls = mysql_num_rows ($result);

if ($totalpolls > 0) {

	$polls = mysql_fetch_array ($result);
	
	$whatpoll = $polls['pollid'];
	$title = $polls['title'];
	
	// Calculate Poll Expiration
	list ($dayx, $monthx, $yearx) = explode ("/", $polls['expires']);
	$now = mktime (0, 0, 0, date ("m"), date ("d"), date ("Y"));
	$expire = mktime (0, 0, 0, $monthx, $dayx, $yearx);
	
	if ($expire <= $now) {
	
		$expired = "yes";
		
	} else {
	
		$expired = "no";
		
	}
	
	// Calculate Poll Start
	if ($expired == "no") {
	
		list ($days, $months, $years) = explode ("/", $polls['starts']);
		$starts = mktime (0, 0, 0, $months, $days, $years);
	
		if ($starts > $now) {
	
			$started = "no";
		
		} else {
	
			$started = "yes";
		
		}
		
	} else {
	
		$started = "no";
	
	}
	
	// Check if IP is blocked from voting
	$blockcheck = mysql_num_rows (mysql_query ("SELECT blockedid FROM blocked WHERE (polls LIKE '%$polls[title]%' OR polls LIKE '%all%') AND ip='$_SERVER[REMOTE_ADDR]'"));
	
	if ($blockcheck == 0) {
	
		$blocked = "no";
		
	} else {
	
		$blocked = "yes";
		
	}
	
	// Check if user has voted (IP)
	if ($polls['ip'] == "yes") {
	
		$check = mysql_query ("SELECT ipid, vote FROM ip WHERE title='$polls[title]' AND ip='$_SERVER[REMOTE_ADDR]'");
		$checkip = mysql_num_rows ($check);
		$ip = mysql_fetch_array ($check);
		
		if ($checkip == 0 | $ip['vote'] < time ()) {
		
			$voteip = "yes";
			
		} else {
		
			$voteip = "no";
			
		}
		
		if ($ip['vote'] <= time ()) {
		
			mysql_query ("DELETE FROM ip WHERE title='$polls[title]' AND ip='$_SERVER[REMOTE_ADDR]'");
			
		}
		
	} else {
	
		$voteip = "none";
		
	}
	
	// Check if user has voted (Cookie)
	if ($polls['cookies'] == "yes") {
		
		if (isset ($_COOKIE[$whatpoll])) {
		
			if ($_COOKIE[$whatpoll] == $title) {
		
				$votecookies = "no";
				
			} else {
			
				$votecookies = "yes";
			
			}
			
		} else {
		
			$votecookies = "yes";
			
		}
		
	} else {
	
		$votecookies = "none";
		
	} 
	
	if (isset ($_POST['stage'])) {

		$polls = mysql_fetch_array (mysql_query ("SELECT title, vote, ip, cookies FROM polls WHERE status='on' AND pollid='$_POST[poll]'"));
		$options = mysql_fetch_array (mysql_query ("SELECT optionid, options, votes FROM options WHERE pollid='$_POST[poll]' AND optionid='$_POST[option]'"));
		
		$title = $polls['title'];
		
		$nextvote = $polls['vote'] + time ();
		$votes = $options['votes'] + 1;
		
		if ($polls['ip'] == "yes" && $voteip != 'no') {
		
			$ip = mysql_fetch_array (mysql_query ("SELECT ipid FROM ip ORDER BY ipid DESC"));
			
			$ipid = $ip['ipid'] + 1;
		
			mysql_query ("INSERT INTO ip (ipid, title, ip, vote) VALUES ('$ipid', '$polls[title]', '$_SERVER[REMOTE_ADDR]', '$nextvote')");
			
		}
		
		if ($polls['cookies'] == "yes" && $votecookies != 'no') {
		
			setcookie ($whatpoll, $title, $nextvote);
			
		}
		
		if ($votecookies != 'no' && $voteip != 'no' && $blocked != 'yes' && $started == 'yes' && $expired == 'no') {
		
			mysql_query ("UPDATE options SET votes='$votes' WHERE optionid='$options[optionid]'");
			
		}
				
	}
	
}
	
?>