<?php 

if(isset($_SESSION['gm'])){
	if($_GET['ticket'] == ""){
	echo "
	<fieldset>
		<legend>
			<strong>Your Tickets</strong>
		</legend>
		<table border='0' width='100%'>
			<tr>
				<td width = '15%'>
					Ticket Number
				</td>
				<td width = '45%'>
					Ticket Name
				</td>
				<td width = '25%'>
					Last Reply
				</td>
				<td width = '15%'>
					Status
				</td>
			</tr>";
			$gettickets = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets WHERE status = 'Open' ORDER BY ticketid ASC");
			$getnumber = mssql_num_rows($gettickets);
			while($tickets = mssql_fetch_array($gettickets)){
				echo "
					<tr>
						<td>
							" . $tickets['ticketid'] . "
						</td>
						<td>
							<a href ='?dkcms=gmcp&amp;page=ticket&amp;a=$tickets[ticketid]&amp;ticket=Yes'>
								" . $tickets['title'] . "
							</a>
						</td>
						<td>
							" . $tickets['date'] . "
						</td>
						<td>
							" . $tickets['status'] . "
						</td>
					</tr>
				";
			}
		echo "</table>";
	}
	elseif($_GET['ticket'] == "Yes"){
		$GrabTicket = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets LEFT JOIN dkcms.dbo.dkcms_tcomments ON dkcms.dbo.dkcms_tickets.ticketid = dkcms.dbo.dkcms_tcomments.ticketid WHERE dkcms.dbo.dkcms_tickets.ticketid = '{$_GET['a']}'");
		$viewTicket = mssql_fetch_array($GrabTicket);
		$getResponce = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tcomments WHERE ticketid = '{$_GET['a']}'");
		$countTicket = mssql_num_rows($getResponce);
		echo "
			<fieldset>
				<legend>
					Viewing Your Ticket
				</legend>
				Created By: $viewTicket[name]<br/>
				Date: $viewTicket[date]<br/>
				<br/>
				Ticket Details:<br/> 
				$viewTicket[details] <br/><br/>
				<br/>
				Responces: <br/><br/>
				";
				while($c = mssql_fetch_array($getResponce)){
					echo $c['user_name'] . " posted on " . $c['date_com'] . "<br/><br/> ".$c['content']."<hr/>";
				}
				if($countTicket < 1){
					echo "Please make a responce to this ticket.";
				}
				echo "
					Make a comment to this ticket:<br/>
					<form method='post' action''>
						<textarea name='comment' rows='5' cols='76%'/></textarea>
						<center>
							<input type='submit' name='subcomment' value='Submit Responce'/>
							<input type='submit' name='close' value='Close Ticket'/>
						</center>
					</form>
				";
				if(isset($_POST['subcomment'])){
					$postComment = $_POST['comment'];
						
					if(strlen($postComment) < 2){
						echo "Please provide more information.";
					}
					else{
						$insertComment = mssql_query("INSERT INTO dkcms.dbo.dkcms_tcomments (ticketid, user_name, content, date_com)
							VALUES "."('".$_GET['a']."', '".$_SESSION['id']."', '".$postComment."', '".date('F d - g:i A')."')") ;
						$insertComment = mssql_query("UPDATE dkcms.dbo.dkcms_tickets SET date = '".date('F d - g:i A')."' WHERE ticketid = '{$_GET['a']}'") ;
						if($insertComment){
							echo "<meta http-equiv='refresh' content='0; url='/>";
						}
						else{
							echo "There was an error processing your update. Please notify the admin.";
						}
					}
				}
				if(isset($_POST['close'])){
					$closeTicket = mssql_query("UPDATE dkcms.dbo.dkcms_tickets SET status = 'Closed' WHERE ticketid = '{$_GET['a']}'");
					if($closeTicket){
						echo "This ticket was successfuly closed! You will be redirected in two seconds.
						<meta http-equiv='refresh' content='2; url=?dkcms=gmcp&amp;page=ticket'/>
						";
					}
				}
			echo "
			</fieldset>
		";
	}
} else {
	header('Location:?dkcms=gmcp');
}
?>