<?php

if($_SESSION['user_id']){
	if($_GET['action']=="search"){
	
	$var = @$_POST['acc'];
	$trimmed = trim($var);
	$limit=10; 
	
if ($trimmed == "")
  {
    echo "<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
	<p><center><strong>Error: </strong>Please enter a search...</center></p>
	</div>
  </div>";
  exit;
  }

if (!isset($var))
  {
  echo "<p>We dont seem to have a search parameter!</p>";
  exit;
  }
 $query = "SELECT * FROM account.dbo.tbl_user WHERE user_id LIKE '%$trimmed%'";
 $numresults = mssql_query($query);
 $numrows = mssql_num_rows($numresults);



  if (empty($s)) {
  $s=0;
  }

  //$query .= " limit $s,$limit";
  $result = mssql_query($query);
  

echo "<div class='ui-widget'>
			<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'> 
				<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
				<strong>You searched for: </strong>&quot;" . $var . "&quot;</p>
			</div>
		</div>";

if ($numrows == 0)
  {
  echo "<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
	<p><center><strong>Error: </strong>Sorry, nothing has been found, please try again!</center></p>
	</div>
  </div>";
  }

$count = 1 + $s ;

	echo "<center>
			<table width='100%' height='1' border='0'>
				<tr valign='top'>
					<td>
						<center><b>User No</b></center>
					</td>
					<td>
						<center><b>Account Name</b></center>
					</td>
					<td>
						<center><b>Character Name</b></center>
					</td>
					<td>
						<center><b>Level</b></center>
					</td>
					<td>
						<center><b>Class</b></center>
					</td>
					<td>
						<center><b>Email</b></center>
					</td>
					<td>
						<center><b>Banned</b></center>
					</td>
					<td>
						<center><b>Admin Functions</b></center>
					</td>
				</tr>";
				

		
				
  while ($row= mssql_fetch_array($result)) {
  
    $classes = array('0' => "Azure Knight", 
  				   '1' => "Segita Hunter", 
				   '2' => "Incar Magician", 
				   '3' => "Vicious Summoner", 
				   '4' => "Segnale", 
				   '5' => "Bagi Warrior",
				   '6' => "Aloken"); 

  
  $user_no = $row["user_no"];
  $acc_mail = $row["user_mail"];
  $user_id = $row["user_id"];
  $acc_ban = $row["banned"];
  
  $query2 = "SELECT * FROM character.dbo.user_character WHERE user_no = '$user_no'"; 
  $result2 = mssql_query($query2);
  $row2 = mssql_fetch_array($result2);

  $classes = array('0' => "Azure Knight", 
  				   '1' => "Segita Hunter", 
				   '2' => "Incar Magician", 
				   '3' => "Vicious Summoner", 
				   '4' => "Segnale", 
				   '5' => "Bagi Warrior",
				   '6' => "Aloken"); 

  
  
  $char_name = $row2["character_name"];
  $char_class = $classes[$row2["byPCClass"]];
  $char_level = $row2["wLevel"];

  


echo "			<tr valign='top'>
					<td>
						<center><a href='?osds=dev&page=account&user_no=".$user_no."'>".$user_no."</a></center>
					</td>
					<td>
						<center>".$user_id."</center>
					</td>
					<td>
						<center>".$char_name."</center>
					</td>
					<td>
						<center>".$char_level."</center>
					</td>
					<td>
						<center>".$char_class."</center>
					</td>
					<td>
						<center><a href='?osds=dev&page=email&user_mail=".$acc_mail."'>".$acc_mail."</a></center>
					</td>
					
					
					
					<td>";
						if($acc_ban == '1') {
						 echo "<center><a href='?osds=dev&page=ban_acc&user_no=".$user_no."&ban=0'><img src='images/dev/ban.png' border='0' /></a></center>";
						} else {
						 echo "<center><a href='?osds=dev&page=ban_acc&user_no=".$user_no."&ban=1'><img src='images/dev/unban.png' border='0' /></a></center>";
						}
echo "				</td>
					<td>
						<center><a href='?osds=dev&page=character&user_no=".$user_no."'><img src='images/dev/edit.png' border='0' /></a>&nbsp;&nbsp;<img src='images/dev/delete.png' border='0' />&nbsp;&nbsp;<img src='images/dev/coins.png' border='0' /></center>
					</td>
				</tr>";
			}
				echo "</tr></table></center>";
			} else {
  				echo "No Access!";
		}
	} else {
  echo "No Access!";
}
?>
