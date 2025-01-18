<?php
// -----------------------------------
// Did the admin run the installer?
// -----------------------------------
if (!file_exists('install.lock'))
{	
    header('Location: install.php');
	die();
	
} else { 
	// Added in R2 => delete files
	if(file_exists('install.php'))
	{
		unlink('install.php');
	}
	
	if(file_exists('class.ConfigMagik.php'))
	{
		unlink('class.ConfigMagik.php');
	}
}

// -----------------------------------
// Include header
// -----------------------------------
include ("header.php");

// -----------------------------------
// Update stats
// => After the installer is done, refresh the stats
// -----------------------------------
if (filesize('cache_server_stats.php') == 0)
{
	updateServerStats();
}

// -----------------------------------
// Include cache file
// -----------------------------------
include ("cache_server_stats.php");

// -----------------------------------
// is its a POST do updateServerStats
// -----------------------------------
if (isset($_POST['updateServerStats']))
{
	updateServerStats();
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Dashboard</h1>
	<div class="statistics">
		<h4>Server Statistics</h4>
		<table width="100%">
			<tr>
				<td>Total Accounts</td>
				<td><b>' . $server_stats_total_accounts . '</b></td>
			</tr>
			<tr>
				<td>Total Characters</td>
				<td><b>' .  $server_stats_total_characters . '</b></td>
			</tr>
			<tr>
				<td>Total Online</td>
				<td><b>' .  $server_stats_total_accounts_online . ' <span style="float:right;"><a href="online_accounts.php">View</a></span></b></td>
			</tr>
			<tr>
				<td>Total Banned</td>
				<td><b>' .  $server_stats_total_banned . '</b></td>
			</tr>
			<tr>
				<td>Total Guilds</td>
				<td><b>' .  $server_stats_total_guilds . '</b></td>
			</tr>
			<tr>
				<td>Total Dead Front</td>
				<td><b>' .  $server_stats_total_df . '</b></td>
			</tr>
			<tr>
				<td>Total Deleted Characters</td>
				<td><b>' .  $server_stats_total_del_char . '</b></td>
			</tr>
			<tr>
				<td>Total Siege</td>
				<td><b>' .  $server_stats_total_siege . '</b></td>
			</tr>
		</table>
		<br />
			<form class="uniform" method="post">
				<input type="hidden" value="updateServerStats" name="updateServerStats" />
				<button type="submit" class="button small">Update Statistics</button>
			</form>
		<div style="float:right">Last Update: ' . timeAgo($server_stats_time) . '</div>
	</div>
	<div class="clear"></div>
</article>';
		
		$getDkuNews_block = $Config->get('getDkuNews_block', 'GENERAL');
        if ($getDkuNews_block == 'true')
        {
			echo getDkuNews();
		}

echo '<div class="clear"></div>';
			
include "footer.php";
?>