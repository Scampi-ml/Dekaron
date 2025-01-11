<?php 



// plaats de header
header("Content-Type: application/xml; charset=UTF-8");

$con = mysql_connect("mysql1049.servage.net", "c0d3r3d9", "c0d3r3d91") or die(mysql_error());
mysql_select_db("c0d3r3d9") or die(mysql_error());

    // laad de 5 laatst toegevoegde artikelen uit de database
	
	//"INSERT INTO svn_revisions (project_id, revision, url, author, timestamp, message) VALUES (
    $sql = mysql_query("SELECT * FROM svn_revisions ORDER BY revision DESC LIMIT 10");

$charset = "UTF-8";

echo '<?xml version="1.0" encoding="'.$charset.'"?'.'>'; 


?>
<rss version="2.0" >

<channel>
<title>OSDS V4 Revision</title>
<link>http://www.dkunderground.org/forums/forum/25-osds-announcements</link>
<lastBuildDate><?php echo date('r'); ?></lastBuildDate>


<?php 
// laad de artikelen uit de database
while($rss_feed = mysql_fetch_assoc($sql))
{
	// filter de extra slashes
	$message = stripslashes($rss_feed['message']);
	
	// zet alle html karakters om in leesbare tekens
	$message = htmlspecialchars($message);
	 
	// plaats de artikelen
	echo("<item>\n");
	echo("<title>Update Revision: ".$rss_feed['revision']." </title>\n");
	echo("<date>".$rss_feed['timestamp']."</date>\n");
	echo("<revision>".$rss_feed['revision']."</revision>\n");
	echo("<description>
		<![CDATA[Hello!
		<br><br>
		This is an automated messags from Google Code.
		<br><br>
		A revision has been updated to <b>R".$rss_feed['revision']."</b>
		<br><br>
		The following message had been added:
		<br><br>
		[quote]".$message."[/quote]
		<br><br>
		Please update your OSDS now!
		<br><br>
		Over and out!
		]]>
	
	</description>\n");
	echo("<pubDate>" . date('r') . "</pubDate>\n");
	echo("</item>\n");
}
mysql_close($con);
?>

</channel>
</rss>