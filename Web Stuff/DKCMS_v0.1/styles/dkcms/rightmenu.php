<?php 
$accounts = mssql_query("SELECT * FROM account.dbo.tbl_user");
$saccounts = mssql_num_rows($accounts);

$characters = mssql_query("SELECT * FROM character.dbo.user_character");
$scharacters = mssql_num_rows($characters);

$guilds = mssql_query("SELECT * FROM character.dbo.guild_info");
$sguilds = mssql_num_rows($guilds);

$online = mssql_query("SELECT * FROM account.dbo.user_profile WHERE login_flag = '1100'");
$sonline = mssql_num_rows($online);

echo "
	<table border='0' width='155'>
		<tr valign='top'>
			<td>
				<div class='regtext'>
					<h3>Game Info</h3>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<table border='0' class='menutext' width='100%' cellspacing='0'>
					<tr>
						<td>
							<b>Server:</b>
						</td>
					</tr>
					<tr>
						<td>
							Players Online
						</td>
						<td align='right'>
							<b>".$sonline."</b>
						</td>
					</tr>
					<tr>
						<td>
							Accounts
						</td>
						<td align='right'>
							<b>".$saccounts."</b>
						</td>
					</tr>
					<tr>
						<td>
							Characters
						</td>
						<td align='right'>
							<b>".$scharacters."</b>
						</td>
					</tr>
					<tr>
						<td>
							Guilds
						</td>
						<td align='right'>
							<b>".$sguilds."</b>
						</td>
					</tr>
				</table>
				<br>
				<table border='0' class='menutext' width='100%' cellspacing='0'>
					<tr>
						<td>
							<b>Information:</b>
						</td>
					</tr>
					<tr>
						<td>
							Experience Rate
						</td>
						<td align='right'>
							".$exprate."
						</td>
					</tr>
					<tr>
						<td>
							Money Rate
						</td>
						<td align='right'>
							".$moneyrate."
						</td>
					</tr>
					<tr>
						<td>
							Drop Rate
						</td>
						<td align='right'>
							".$droprate."
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>";

?>