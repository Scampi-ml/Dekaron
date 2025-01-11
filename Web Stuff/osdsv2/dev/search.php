<?php
include "exparray.php";
include "maparray.php";
include "classarray.php";
include "resetarray.php";
include "loginarray.php";

if($_SESSION['user_id']){
	if($_GET['action']=="search"){
	
	$var = @$_POST['char'] ;
	$trimmed = trim($var);
	$limit=10; 
	
if ($trimmed == "")
  {
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p>
        	<center><strong>Error: </strong>Please enter a search...</center>
        </p>
	</div>
</div>
<?php
include "footer.php";
  exit;
  }

if (!isset($var))
  {
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p>
        	<center><strong>Error: </strong>We dont seem to have a search parameter!</center>
        </p>
	</div>
</div>
<?php
include "footer.php";
  exit;
  }
 $query = "SELECT * FROM character.dbo.user_character WHERE character_name LIKE '%$trimmed%'";
 $numresults = mssql_query($query);
 $numrows = mssql_num_rows($numresults);
 $result = mssql_query($query);
  
if ($numrows == 0){
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p>
        	<center><strong>Error: </strong>Sorry, nothing has been found, please try again!</center>
        </p>
	</div>
</div>
<?php
include "footer.php";
exit;
}
?>
<div class='ui-widget'>
    <div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'> 
        <p>
        	<span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
        	<strong>You searched for: </strong>&quot;<?php echo $var; ?>&quot;</p>
    </div>
</div>

			<table width='100%' height='1' border='0' class="ui-widget-content ui-corner-all">
            
				<tr valign='top' >
					<td class="ui-widget-content ui-corner-all">
						<b>&nbsp;&nbsp;&nbsp;Username</b>
					</td>
					<td class="ui-widget-content ui-corner-all">
						<b>&nbsp;&nbsp;&nbsp;Character Name</b>
					</td>
					<td class="ui-widget-content ui-corner-all">
						<center><b>Level</b></center>
					</td>
					<td class="ui-widget-content ui-corner-all">
						<center><b>Str/Dex/Con/Spr</b></center>
					</td>
					<td class="ui-widget-content ui-corner-all">
						<b>&nbsp;&nbsp;&nbsp;Class</b>
					</td>
					<td class="ui-widget-content ui-corner-all">
						<b>&nbsp;&nbsp;&nbsp;Map</b>
					</td class="ui-widget-content ui-corner-all">

					<td class="ui-widget-content ui-corner-all">
						<b>&nbsp;&nbsp;&nbsp;IP</b>
					</td>
					<td class="ui-widget-content ui-corner-all">
						<center><b>Banned</b></center>
					</td class="ui-widget-content ui-corner-all">
				</tr>
                <tr>
                	<td></td>
                </tr>
<?php  
				
  while ($row = mssql_fetch_array($result)) {
  
  $char_name = $row["character_name"];
    
  $query3 = "SELECT * FROM character.dbo.GUILD_CHAR_INFO WHERE character_name = '$char_name'";
  
  $result3 = mssql_query($query3);
  $numresults3 = mssql_query($query3);
  $numrows3 = mssql_num_rows($numresults3);
  
		if ($numrows3 == '0'){
	  
	  	$guildname = "No Guild";
	
		} else {

  while($row3 = mssql_fetch_array($result3)) {
  
		if ($guild_code == '0'){

		$guildname = "No Guild";

		} else {

		$query4 = "SELECT * FROM character.dbo.GUILD_INFO WHERE guild_code = '".$row3["guild_code"]."'";
		$result4 = mssql_query($query4);
		$row4 = mssql_fetch_array($result4);
		$guildname = $row4["guild_name"];
		
		}
	  }
  }
  

  $char_class = $classarray[$row["byPCClass"]];
  $char_level = $row["wLevel"];
  $char_exp = $row["dwExp"];
  $char_str = $row["wStr"];
  $char_dex = $row["wDex"];
  $char_con = $row["wCon"];
  $char_spr = $row["wSpr"];
  $char_posx = $row["wPosX"];
  $char_posy = $row["wPosY"];
  $char_ret_posx = $row["wRetPosX"];
  $char_ret_posy = $row["wRetPosY"];
  $char_ret_map = $maparray[$row["wRetMapIndex"]];
  $char_ret_map_id = $row["wRetMapIndex"];
  $char_map = $maparray[$row["wMapIndex"]];
  $char_map_id = $row["wMapIndex"];
  $char_money = $row["dwMoney"];
  $char_money_storage = $row["dwStorageMoney"];
  $char_money_store = $row["dwStoreMoney"];
  $char_stat_reset = $statresetarray[$row["byStatClearCount"]];
  $char_skill_reset = $skillresetarray[$row["bySkillClearCount"]];
  $char_free_skillponts = $row["wSkillPoint"];
  $char_free_statpoints = $row["wStatPoint"];
  $char_chaotic = $row["wChaoticLevel"];

  $user_no = $row["user_no"];
  $char_ip = decode_ip(bin2hex($row["user_ip_addr"]));
 				   	
  $num_total_exp = $exparray[$char_level];
  $value = $char_exp;
  $total = $num_total_exp; 
  $percent = number_format(($value * 100) / $total);
  
  $query2 = "SELECT * FROM account.dbo.tbl_user WHERE user_no = '$user_no'"; 
  $result2 = mssql_query($query2);
  $row2 = mssql_fetch_array($result2);
  
  $user_id = $row2["user_id"];
  $acc_ban = $row2["banned"];
  
  $query5 = "SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '$user_no'"; 
  $result5 = mssql_query($query5);
  $row5 = mssql_fetch_array($result5);

  $acc_reg = $row5["ipt_time"];
  $acc_online = $loginarray[$row5["login_flag"]];
  $acc_login = $row5["login_time"];
  $acc_logout = $row5["logout_time"];
  $acc_ip = decode_ip(bin2hex($row5["user_ip_addr"]));
  
  
  $query6 = "SELECT * FROM cash.dbo.user_cash WHERE user_no = '$user_no'";
  $result6 = mssql_query($query6);
  $row6 = mssql_fetch_array($result6);
  $count6 = mssql_num_rows($result6);

  
  if($count6 == '0') {
	$coins = "
				<div class='ui-widget'>
					<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
						<p>
							<center><strong>Error: </strong>The account has not yet visited the D-Store,<br> and therefore it can not be credited coins</center>
						</p>
					</div>
				</div>";

  } else {
	$coins = $row6["amount"];
  }
  
?>
				<tr valign='top' class="ui-widget-content ui-corner-all" >
					<td>
							<a href='?osds=dev&page=saccount&user_no=<?php echo $user_no; ?>' title="Search for more characters on this account"><img src='images/dev/search.png' border='0' /></a>
							<a href='?osds=dev&page=ecoins&user_no=<?php echo $user_no; ?>' title="Give this user coins<br>
                            																		<b>Current Coins:</b> <?php echo $coins; ?> 
                            																		"><img src='images/dev/coins.png' border='0' /></a>
							<a href='?osds=dev&page=eaccount&user_no=<?php echo $user_no; ?>' title="Edit this account"><img src='images/dev/edit.png' border='0' /></a>
							
							&nbsp;
							<a href='#' title='<b>Registed on:</b> <?php echo $acc_reg; ?><br>
                            					<b>Last Login:</b> <?php echo $acc_login; ?><br>
                                                <b>Last Logout:</b> <?php echo $acc_logout; ?><br>
                                                <b>Last IP:</b> <?php echo $acc_ip; ?><br>
                                                <b>Status:</b> <?php echo $acc_online; ?>
                                                
							
												'><?php echo $user_id; ?></a>
					</td>
                    <td>
							<a href='?osds=dev&page=echaracter&char_name=<?php echo $char_name; ?>' title="Edit this character"><img src='images/dev/edit.png' border='0' /></a>
							&nbsp;
							<a href='#' title='<b>Inventory Money:</b> <?php echo $char_money; ?><br>
                            					<b>Storage Money:</b> <?php echo $char_money_storage; ?><br>
                                                <b>Store Money:</b> <?php echo $char_money_store; ?><br>
												<b>Stat Reset</b> <?php echo $char_stat_reset; ?><br>
                                                <b>Skill Reset</b> <?php echo $char_skill_reset; ?><br>
                                                <b>Free Skill Points:</b> <?php echo $char_free_skillponts; ?><br>
                                                <b>Free Stat Points:</b> <?php echo $char_free_statpoints; ?><br>
                                                <b>Chaotic Level (IP):</b> <?php echo $char_chaotic; ?><br>
                                                <b>Guild:</b> <?php echo $guildname; ?>
							
												'>
                                                
												<?php echo $char_name; ?>
                                                
                                                </a>
					</td>
					<td>
						<center><a href='#' title='<b>Current EXP:</b> <?php echo $char_exp; ?><br>
                        							<b>EXP to next level:</b> <?php echo $num_total_exp; ?><br>
													<?php echo $percent; ?>% done<br>
                                                    
                                                    '>
													
													<?php echo $char_level; ?> 
                                                    
                                                    </a></center>
					</td>
					<td>
						<center><?php echo $char_str; ?>/<?php echo $char_dex; ?>/<?php echo $char_con; ?>/<?php echo $char_spr; ?></small></center>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;<?php echo $char_class; ?>
					</td>
					<td>
						
						&nbsp;&nbsp;&nbsp;<a href='#' title='<b>Current map ID:</b> <?php echo $char_map_id; ?><br>
     														<b>Current Pos X:</b> <?php echo $char_posx; ?><br>
                                                            <b>Current Pos Y:</b> <?php echo $char_posy; ?><br>
                                                            <b>Current Return Pos X:</b> <?php echo $char_ret_posx; ?><br>
                                                            <b>Current Return Pos Y:</b> <?php echo $char_ret_posy; ?><br>
                                                            <b>Return Map ID:</b> <?php echo $char_ret_map_id; ?><br>
                                                            <b>Return Map:</b> <?php echo $char_ret_map; ?>
                                                            
                                                            '>
                                                            
															<?php echo $char_map; ?>
                                                            
                                                            </a>
															
															
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;<?php echo $char_ip; ?>
					</td>
					<td>
<?php
						if($acc_ban == '1') {

						echo "<center><a href='?osds=dev&page=ban_acc&user_no=".$user_no."&ban=0' title='Unban'><img src='images/dev/ban.png' border='0' /></a></center>";

						} else {
					
						echo "<center><a href='?osds=dev&page=ban_acc&user_no=".$user_no."&ban=1' title='Ban'><img src='images/dev/unban.png' border='0' /></a></center>";
						
						}
?>				
					</td>
				</tr>
<?php
			}
?>
</tr></table></center>
<?php
			} else {
  				echo "No Access!";
		}
	} else {
  echo "No Access!";
}
?>
