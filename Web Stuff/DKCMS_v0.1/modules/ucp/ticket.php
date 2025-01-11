<?php 

if(isset($_SESSION['id'])){
	if(!$_GET['ticket']){
	echo "
	<fieldset>
		<legend>
			<strong>Your Tickets</strong>
		</legend>
		<table border='0' width='100%'>
				<tr>
					<td width = '15%'>
						Nr.
					</td>
					<td width = '45%'>
						Name
					</td>
					<td width = '25%'>
						Last Reply
					</td>
					<td width = '15%'>
						Status
					</td>
				</tr>";
			$gettickets = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets WHERE name = '{$_SESSION['id']}' AND status = 'Open' ORDER BY ticketid DESC");
			$getnumber = mssql_num_rows($gettickets);
			$NumberTicket = 0;
			while($tickets = mssql_fetch_array($gettickets)){
				echo "
					<tr>
						<td>
							" . ++$NumberTicket . "
						</td>
						<td>
							<a href ='?dkcms=ucp&amp;page=ticket&amp;a=$tickets[ticketid]&amp;ticket=Yes'>
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
		echo "
		</table>";
		@mssql_data_seek($gettickets, 0);
		$opentick = mssql_fetch_array($gettickets);
		if($getnumber >= 5 && $opentick['status'] == "Open"){
			echo "<br /><input type=\"button\" value=\"View Closed Tickets\" onclick='parent.window.location = \"?dkcms=ucp&amp;page=ticket&amp;ticket=closed\"'/>";
		} else{
		echo "
			<center>
				<br /><input type=\"button\" value=\"View Closed Tickets\" onclick='parent.window.location = \"?dkcms=ucp&amp;page=ticket&amp;ticket=closed\"'/>  <input type=\"button\" value=\"Create Ticket\" onclick='parent.window.location = \"?dkcms=ucp&amp;page=ticket&amp;ticket=create\"' />
			</center>
			";
		}
	}
	if($_GET['ticket'] == "create"){
		echo " 
			<fieldset>
				<legend>
					Ticket Creation
				</legend>
				<form method='post' action=''>
					<table border='0' width='100%'>
						<tr>
							<td>
								Type of ticket:
							</td>
						</tr>
						<tr>
							<td>
								<select name='type'>
									<option value='Game'>Game Help</option>
									<option value='Website'>WebSite Help</option>
									<option value='Abuse'>Account Help</option>
									</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Select which kind of statement :
							</td>
						</tr>
						<tr>
							<td>
									<select name='support'>
									<optgroup label='Game'>Game Help</optgroup
										<option value='Bug' >Bug Report</option>
										<option value='Connection'>Connection</option>
									<optgroup label='Website'>WebSite Help
										<option value='Missing / Broken Link'>Missing / Broken Link</option>
										<option value='Error on Page'>Error on a Page</option>
										<option value='Page is not functioning'>Page not functioning correctly</option>
									<optgroup label='Account'>Account Help
										<option value='Account' >Account issue</option>
										<option value='Abuse' >User Abuse</option>
								</select>
							</td>
						</tr>
						<tr>
							<td> 
								Title :
							</td>
						</tr>
						<tr>
							<td>
								<input type='text' name='title' maxlength='20' size='23'/>
							</td>
						</tr>
						<tr>
							<td>
								Details / Information :
							</td>
						</tr>
						<tr>
							<td>
								<textarea name='details' rows='7'></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<input type='submit' name='ticket' value='Send Ticket' />
							</td>
						</tr>
						<tr>
							<td>
								<input type='button' value='Go Back' onclick='parent.window.location = '?dkcms=ucp&amp;page=ticket''>
							</td>
						</tr>
					</table>
				</form>";
				if(isset($_POST['ticket'])){
					$type = $_POST['type'];
					$support = $_POST['support'];
					$title = $_POST['title'];
					$details = $_POST['details'];
					$nowtickets = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets WHERE name = '{$_SESSION['id']}' AND status = 'Open'");
					$checktickets = mssql_num_rows($nowtickets);
					
					if($type == ""){
						echo "Please select the type of ticket.";
					}
					elseif($support == ""){
						echo "Please select the type for this ticket.";
					}
					elseif($title == "" || strlen($title) < "5"){
						echo "You did not enter a title name or the title name is too short.";
					}
					elseif($checktickets > 5){
						echo "We're very sorry, however, you are only allowed 5 tickets on your account.";
					}
					else{
						$newticket = mssql_query("INSERT INTO dkcms.dbo.dkcms_tickets (title, type, support_type, details, date, ip, name, status) 
							VALUES "."('".$title."', '".$type."', '".$support."', '".$details."', '".date('F d - g:i A')."', '".$_SERVER['REMOTE_ADDR']."', '".$_SESSION['id']."', 'Open')");
							
						if($newticket){
							echo "<meta http-equiv='refresh' content='0; url=?dkcms=ucp&amp;page=ticket'/>";
						}
						else{
							echo "The ticket you have created was not able to be completed due to an error. Please contact the admin.";
						}
					}
				}
			echo " </fieldset>
		";
	}
	elseif($_GET['ticket'] == "Yes"){
		$GrabTicket = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets LEFT JOIN dkcms.dbo.dkcms_tcomments ON dkcms.dbo.dkcms_tickets.ticketid = dkcms.dbo.dkcms_tcomments.ticketid WHERE dkcms.dbo.dkcms_tickets.ticketid = '".$_GET['a']."'");
		$viewTicket = mssql_fetch_array($GrabTicket);
		$getResponce = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tcomments WHERE ticketid = '".$_GET['a']."'");
		$countTicket = mssql_num_rows($getResponce);
		if($_SESSION['id'] != $viewTicket['name']){
			echo "
				You are not allowed to view this ticket. Your actions have been logged.
				<meta http-equiv='refresh' content='1; url=?dkcms=main'/>
			";
			exit();
		}
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
					echo $c['user_name'] . " posted on " . $c['date_com'] . "<br/><br/> ".$c['content']."<p></p><hr/>";
				}
				if($viewTicket['status'] == "Closed"){
					echo "<hr/> This ticket is closed. If your solution is not here, please open another ticket.";
				}
				else {
				echo "
					Make a comment to this ticket:<br/>
					<form method='post' action''>
						<textarea name='comment' rows='5' cols='70%'/></textarea>
						<center>
							<input type='submit' name='subcomment' value='Submit Responce'/>
						</form>
					</center>
				";
				}
				if(isset($_POST['subcomment'])){
					$postComment = $_POST['comment'];

						$insertComment = mssql_query("INSERT INTO dkcms.dbo.dkcms_tcomments (ticketid, user_name, content, date_com)
							VALUES "."('".$_GET['a']."', '".$_SESSION['id']."', '".$postComment."', '".date('F d - g:i A')."')") ;
						
						$insertComment = mssql_query("UPDATE dkcms.dbo.dkcms_tickets SET date = '".date('F d - g:i A')."' WHERE ticketid = '".$_GET['a']."'");
							
						if($insertComment){
							echo "<meta http-equiv='refresh' content='0; url='/>";
						}
						else{
							echo "There was an error processing your update. Please notify the admin.";
						}
				}
			echo "
			</fieldset>
		";
	}
	elseif($_GET['ticket'] == "closed"){
	echo "
		<fieldset>
			<legend>
				Viewing Closed Tickets
			</legend>
			";
			$getclosedTickets = mssql_query("SELECT * FROM dkcms.dbo.dkcms_tickets WHERE name = '{$_SESSION['id']}' AND status = 'Closed'");
			echo "<table border='1' width='100%'>
				<tr>
					<td width = '15%'>
						Nr.
					</td>
					<td width = '45%'>
						Name
					</td>
					<td width = '25%'>
						Last Reply
					</td>
					<td width = '15%'>
						Status
					</td>
				</tr>
			";
			$TicketNumber = 0;
			while($viewTickets = mssql_fetch_array($getclosedTickets)){
				echo "
					<tr>
						<th>
							" . ++$TicketNumber . "
						</th>
						<td>
							<a href = '?dkcms=ucp&amp;page=ticket&amp;ticket=Yes&amp;a=$viewTickets[ticketid]'>
								" . $viewTickets['title'] . "
							</a>
						</td>
						<td>
							" . $viewTickets['date'] . "
						</td>
						<th>
							" . $viewTickets['status'] . "
						</th>
					</tr>
				";
			}
			echo "
			</table>
			<center>
				<br /><input type='button' value='Go Back' onclick='parent.window.location  = '?dkcms=ucp&amp;page=ticket''/>
			</center>
		</fieldset>
		";
	}
} else {
	header('Location:?dkcms=ucp');
}
?>