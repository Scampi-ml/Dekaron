<?php 

if(isset($_SESSION['id'])){
	if($_SESSION['admin']){
		if($_GET['action']=="add"){
			echo "
		<fieldset>
			<legend>
				<b>Add An Event</b>
			</legend>";
				if(!isset($_POST['add'])){
					echo "
			<form method='post' action=''>
				<table border='0' width='100%'>
					<tr>
						<td class='regtext' align='center' colspan='2'>
							Once the event is over, you may edit it and set it to 'End'
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Title:</b>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<input type='text' style='width:50%;' name='title' />
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Author:</b>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							".$_SESSION['id']."
						</td>
					</tr>
					<tr>
						<td class='regtext'>
							<b>Category:</b>
						</td>
						<td class='regtext'>
							<b>Status:</b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<select name='cat'>
								<option value='event_info'>Info</option>
								<option value='event_prize'>Prize</option>
								<option value='event_end'>End</option>
							</select>
						</td>
						<td align='center'>
							<select name='status'>
								<option value='Active'>Active</option>
								<option value='Standby'>Standby</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Content:</b>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<textarea name='content' style='height:100px;width:100%;'></textarea>
						</td>
					</tr>
					<tr>
						<td class='regtext' align='center' colspan='2'>
							You may edit or delete this event later on. 
						</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='submit' name='add' value='Add Event' />
						</td>
					</tr>
				</table>
			</form>";
				}else{
					$title = $_POST['title'];
					$date = date("m.d");
					$cat = $_POST['cat'];
					$status = $_POST['status'];
					$content = $_POST['content'];
					if($title == ""){
						echo "You must enter a title.";
					}elseif($cat == ""){
						echo "You must select a category.";
					}elseif($content == ""){
						echo "You must enter some content.";
					}else{
						$i = mssql_query("INSERT INTO dkcms.dbo.dkcms_events (title,author,date,type,status,content) VALUES ('".$title."','".$_SESSION['id']."','".$date."','".$cat."','".$status."','".$content."')");
						echo "Your event has been posted.";
					}
				}
			echo "
		</fieldset>";
		}elseif($_GET['action']=="edit"){
			echo "
		<fieldset>
			<legend>
				<b>Edit An Event</b>
			</legend>";
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$ge = mssql_query("SELECT * FROM dkcms.dbo.dkcms_events WHERE id='".$id."'");
				$e = mssql_fetch_array($ge);
				if(!isset($_POST['edit'])){
					echo "
			<form method='post' action=''>
				<table border='0' width='100%'>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Title:</b>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<input type='text' style='width:50%;' name='title' value='".$e['title']."' />
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Author:</b>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							".$e['author']."
						</td>
					</tr>
					<tr>
						<td class='regtext'>
							<b>Category:</b>
						</td>
						<td class='regtext'>
							<b>Status:</b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<select name='cat'>
								<option value='event_info'>Info</option>
								<option value='event_prize'>Prize</option>
								<option value='event_end'>End</option>
							</select>
						</td>
						<td align='center'>
							<select name='status'>
								<option value='Active'>Active</option>
								<option value='Standby'>Standby</option>
								<option value='Ended'>End</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Content:</b>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<textarea name='content' style='height:100px;width:100%;'>".$e['content']."</textarea>
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2' align='center'>
							If you end the event, you may reactivate it by editing it again.
						</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='submit' name='edit' value='Edit Event' />
						</td>
					</tr>
				</table>
			</form>";
				}else{
					$title = $_POST['title'];
					$cat = $_POST['cat'];
					$status = $_POST['status'];
					$content = $_POST['content'];
					if($title == ""){
						echo "You must enter a title.";
					}elseif(empty($cat)){
						echo "You must select a category.";
					}elseif($content == ""){
						echo "You must enter some content.";
					}else{
						$u = mssql_query("UPDATE dkcms.dbo.dkcms_events SET title='".$title."',type='".$cat."',status='".$status."',content='".$content."' WHERE id='".$id."'");
						echo "The event has been edited.";
					}
				}
			}else{
				echo "
			<table border='0' width='100%'>
				<tr>
					<td class='regtext'>
						<b>Events</b>
					</td>
				</tr>
				<tr>
					<td>
						Select an event to modify:
					</td>
				</tr>";
				$ge = mssql_query("SELECT * FROM dkcms.dbo.dkcms_events ORDER BY id DESC");
				while($e = mssql_fetch_array($ge)){
					echo "
				<tr>
					<td>
						[".$e['date']."] <a href='?dkcms=admin&amp;page=manevent&amp;action=edit&amp;id=".$e['id']."'>".$e['title']."</a> [#".$e['id']."]
					</td>
				</tr>";
				}
			}
			echo "
			</table>
		</fieldset>";

		}elseif($_GET['action']=="del"){
			echo "
		<fieldset>
			<legend>
				<b>Delete An Event</b>
			</legend>";
			if(!isset($_POST['del'])){
				echo "
			<form method='post' action=''>
				<table border='0' width='100%'>
					<tr>
						<td class='regtext' align='center'>
							Select an event to delete 
						</td>
					</tr>
					<tr>
						<td align='center'>
							<b>Event:</b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<select name='event'>
								<option value=''>Please select...</option>";
				$ge = mssql_query("SELECT * FROM dkcms.dbo.dkcms_events ORDER BY id DESC");
				while($e = mssql_fetch_array($ge)){
					echo "
								<option value='".$e['id']."'>#".$e['id']." - ".$e['title']."</option>";
				}
				echo "
							</select>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<b>Delete:</b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<select name='dec'>
								<option value='0'>No</option>
								<option value='1'>Yes</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='regtext' align='center'>
							Please remember that this action cannot be undone. 
						</td>
					</tr>
					<tr>
						<td align='center'>
							<input type='submit' name='del' value='Delete' />
						</td>
					</tr>
				</table>
			</form>";
			}else{
				$event = $_POST['event'];
				$dec = $_POST['dec'];
				if($event == ""){
					echo "Please select an event to delete.";
				}elseif($dec == "0"){
					echo "You selected 'No'. The event was not deleted.";
				}else{
					$d = mssql_query("DELETE FROM dkcms.dbo.dkcms_events WHERE id='".$event."'");
					echo "The event has been deleted.";
				}
			}
			echo "
		</fieldset>";
		}
	}else{
		include('modules/public/accessdenied.php');
	}
}else{
	echo "You must be logged in to use this feature.";
}
?>