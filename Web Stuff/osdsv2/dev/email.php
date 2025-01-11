<?php

/*

					<td>
							<a href='?osds=dev&page=semail&user_mail=".$acc_mail."'><img src='images/dev/search.png' border='0' /></a>
							&nbsp;
							".$acc_mail." 
					</td>


*/
 $user_mail = $_GET['user_mail'] ;
 echo "<div class='ui-widget'>
			<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'> 
				<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
				<strong>You searched for: </strong>&quot;" . $user_mail . "&quot;</p>
			</div>
		</div>";


 $query = "SELECT * FROM account.dbo.tbl_user WHERE user_mail = '$user_mail'";
 $numresults = mssql_query($query);
 $numrows = mssql_num_rows($numresults);
 $result = mssql_query($query);
 
	echo "<center>
			<table width='100%' height='1' border='0'>
				<tr valign='top'>
					<td>
						<b>Account No</b>
					</td>
					<td>
						<b>Account Name</b>
					</td>
					<td>
						<b>Account Mail</b>
					</td>
					<td>
						<b><center>Banned</center></b>
					</td>
					<td>
						<b><center>Admin Functions</center></b>
					</td>
				</tr>";


  while ($row= mssql_fetch_array($result)) {
  $acc_id = $row["user_id"];
  $acc_no = $row["user_no"];
  $acc_mail = $row["user_mail"];
  $ban = $row['banned'];

echo "			<tr valign='top'>
					<td>
						[".$acc_no."]
					</td>
					<td>
						[".$acc_id."]
					</td>
					<td>
						[".$acc_mail."]
					</td>
					<td>";
						if($ban == '1') {
						 echo "<center><a href='?osds=dev&page=ban_acc&user_no=".$acc_no."&ban=0'><img src='images/dev/ban.png' border='0' /></a></center>";
						} else {
						 echo "<center><a href='?osds=dev&page=ban_acc&user_no=".$acc_no."&ban=1'><img src='images/dev/unban.png' border='0' /></a></center>";
						}

echo "				</td>
					<td>
						<center><img src='images/dev/edit.png' border='0' /></center>
					</td>

				</tr>";
			}
				echo "</tr></table></center>";
?>