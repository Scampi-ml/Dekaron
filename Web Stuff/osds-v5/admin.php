<?php
include ('osdscore.php');
include (exo_getglobalvariable('HEPublicationPath', '').'Data/stats_cache.php');
?>
<div id="main_pane_left">
	<div class="group">
		<form method="get" action="stats_update.php">
			<span style="float:right;margin-top:2px;"><input type="submit" value="Update" name="Update"></span>
		</form>
		<h2>Statistics</h2>
		<table>
			  <tr>
				<td>Accounts</td>
				<td><?php echo $server_stats_total_accounts; ?></td>
			  </tr>
			  <tr>
				<td>Characters</td>
				<td><?php echo $server_stats_total_characters; ?></td>
			  </tr>
			  <tr>
				<td >Online Accounts</td>
				<td><?php echo $server_stats_total_accounts_online; ?></td>
			  </tr>
			  <tr>
				<td>Banned Characters</td>
				<td><?php echo $server_stats_total_banned; ?></td>
			  </tr>
			  <tr>
				<td >Guilds</td>
				<td><?php echo $server_stats_total_guilds; ?></td>
			  </tr>
			  <tr>
			  <td>Deadfront</td>
				<td><?php echo $server_stats_total_df; ?></td>
			  </tr>
			  <tr>
				<td >Deleted Characters</td>
				<td><?php echo $server_stats_total_del_char; ?></td>
			  </tr>
		</table>
	</div>
</div>
<div id="main_pane_left">
	<div class="group" >
    <form method="get" action="search.php">
    	<span style="float:right;margin-top:2px;"><input type="submit" value="Search" name="search"></span>
		<h2>Search</h2>
			<table>
				<tr>
					<td>Search in</td>
					<td>
                    <?php
						if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '1')
						{
							echo '<input type="radio" name="method" checked="checked" value="character" />Character Database<br />';
						}
						else
						{
							echo '<input type="radio" name="method" value="character" />Character Database<br />';
						}
						
						if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '2')
						{
							echo '<input type="radio" name="method" checked="checked" value="account" />Account Database<br />';
						}
						else
						{
							echo '<input type="radio" name="method" value="account" />Account Database<br />';
						}
						
						if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '3')
						{
							echo '<input type="radio" name="method" checked="checked" value="ip_character" />Ip on Character<br />';
						}
						else
						{
							echo '<input type="radio" name="method" value="ip_character" />Ip on Character<br />';
						}
						
						if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '4')
						{
							echo '<input type="radio" name="method" checked="checked" value="ip_account" />Ip in Account<br />';
						}
						else
						{
							echo '<input type="radio" name="method" value="ip_account" />Ip in Account<br />';
						}
						
						if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '5')
						{
							echo '<input type="radio" name="method" checked="checked" value="email" />Email Database<br />';
						}
						else
						{
							echo '<input type="radio" name="method" value="email" />Email Database<br />';
						}
						
						if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '6')
						{
							echo '<input type="radio" name="method" checked="checked" value="guild" />Guild Database<br />';
						}
						else
						{
							echo '<input type="radio" name="method" value="guild" />Guild Database<br />';
						}

					
					?>
					</td>
				</tr>
				<tr>
					<td>Search for</td>
					<td><input type="text" value="" size="30" name="search_string"></td>
				</tr>
			</table>		
			
		</form>
	</div>
</div>
<div id="main_pane_right">
	<div class="group" >
    	<h2>Today</h2>
        <table>
			  <tr>
				<td>New Accounts</td>
				<td><?php include('today_acc.php'); ?></td>
			  </tr>
			  <tr>
				<td>New Characters</td>
				<td><?php include('today_char.php'); ?></td>
			  </tr>
        </table>
	</div>
</div>
<?php
if(exo_getglobalvariable('CONFIG_DISPLAY_VERSION', '') == 'yes')
{
?>
<div id="main_pane_right">
    <div class="response-msg success">
		<span>Version</span>
		<?php echo $osds_version; ?>
	</div>
</div>

<?php
}
if(exo_getglobalvariable('CONFIG_REGISTERD', '') != 'yes')
{
?>
<div id="main_pane_right">
	<div class="response-msg notice">
    	<span>Unregistered version</span>
        You can donate to the OSDS V5 project and remove this message + you get the branding option. <a target="_heexternal" href="http://osds.dkunderground.org/donate.php">Read more about it</a>
    </div>
</div>
<?php        
}
?>


</body>
</html>
