<?php 

if($_SESSION['id']){
	if($_SESSION['gm']){
		echo "
			<fieldset>
				<legend>
					<a href='?dkcms=main&amp;page=gmblog'><b>GM Blog</b></a>
				</legend>";
			if($_GET['action']=="add"){
				if(!$_POST['add']){
					echo "
				<form method='post' action=''>
					<table border='0' width='100%'>
						<tr>
							<td class='regtext'>
								<b>Title:</b>
							</td>
						</tr>
						<tr>
							<td>
								<input type='text' style='width:50%;' name='title' />
							</td>
						</tr>
						<tr>
							<td class='regtext'>
								<b>Author:</b>
							</td>
						</tr>
						<tr>
							<td>
								".$_SESSION['id']."
							</td>
						</tr>
						<tr>
							<td class='regtext'>
								<b>Content:</b>
							</td>
						</tr>
						<tr>
							<td>
								<textarea name='content' style='height:100px;width:100%'></textarea>
							</td>
						</tr>
						<tr>
							<td class='regtext' align='center'>
								You may edit or delete your blog entry later on.
							</td>
						</tr>
						<tr>
							<td align='center'>
								<input type='submit' name='add' value='Add Blog Entry' />
							</td>
						</tr>
					</table>
				</form>";
				}else{
					$title = $_POST['title'];
					$date = date("m.d");
					$content = $_POST['content'];
					if($title == ""){
						echo "You must enter a title.";
					}elseif($content == ""){
						echo "You must enter some content.";
					}else{
						$i = mssql_query("INSERT INTO dkcms.dbo.dkcms_gmblog (title,author,date,content) VALUES ('".$title."','".$_SESSION['id']."','".$date."','".$content."')");
						echo "Your blog entry has been posted.";
					}
				}
			}elseif($_GET['action']=="edit"){
				if($_GET['id']){
					$id = $_GET['id'];
					$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog WHERE id='".$id."'");
					$b = mssql_fetch_array($gb);
					if($_SESSION['id'] == $b['author'] || $_SESSION['admin']){
						if(!$_POST['edit']){
							echo "
				<form method='post' action=''>
					<table border='0' width='100%'>
						<tr>
							<td class='regtext'>
								<b>Title:</b>
							</td>
						</tr>
						<tr>
							<td>
								<input type='text' style='width:50%;' name='title' value='".$b['title']."' />
							</td>
						</tr>
						<tr>
							<td class='regtext'>
								<b>Author:</b>
							</td>
						</tr>
						<tr>
							<td>
								".$b['author']."
							</td>
						</tr>
						<tr>
							<td class='regtext'>
								<b>Content:</b>
							</td>
						</tr>
						<tr>
							<td>
								<textarea name='content' style='height:100px;width:100%'>".$b['content']."</textarea>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<input type='submit' name='edit' value='Edit Blog Entry' />
							</td>
						</tr>
					</table>
				</form>";
						}else{
							$title = $_POST['title'];
							$content = $_POST['content'];
							if($title == ""){
								echo "You must enter a title.";
							}elseif($content == ""){
								echo "You must enter some content.";
							}else{
								$u = mssql_query("UPDATE dkcms.dbo.dkcms_gmblog SET title='".$title."',content='".$content."' WHERE id='".$id."'");
								echo "Blog entry, <b>".$b['title']."</b>, has been updated.";
							}
						}
					}else{
						echo "This blog entry does not belong to you.";
					}
				}else{
					echo "
					<table border='0' width='100%'>
						<tr>
							<td class='regtext'>
								<b>Your blog entries</b>
							</td>
						</tr>
						<tr>
							<td>
								Select a blog entry to modify:
							</td>
						</tr>";

					if($_SESSION['gm']){
						$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog WHERE author='".$_SESSION['id']."' ORDER BY id ASC");
						while($b = mssql_fetch_array($gb)){
							echo "
						<tr>
							<td>
								[".$b['date']."] <a href='?dkcms=gmcp&amp;page=manblog&action=edit&id=".$b['id']."'>".$b['title']."</a>
							</td>
						</tr>";
						}
					}
					if($_SESSION['admin']){
						echo "
						<tr>
							<td class='regtext'>
								<b>Administrator options</b>
							</td>
						</tr>
						<tr>
							<td>
								Select a blog entry to modify:
							</td>
						</tr>";

						$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog WHERE author='".$_SESSION['id']."' ORDER BY author,id ASC");
						while($b = mssql_fetch_array($gb)){
							echo "
						<tr>
							<td>
								[".$b['date']."] <a href='?dkcms=gmcp&amp;page=manblog&amp;action=edit&id=".$b['id']."'>".$b['title']."</a>
							</td>
						</tr>";
						}
					}
					echo "
					</table>";
				}

			} else if ($_GET['action']=="pdel") {
				if (!isset($_GET['id'])) {
					echo "No Blog Comment ID Specified.";
				} else if (!is_numeric($_GET['id'])) {
					echo "Invalid Blog Comment ID.";
				} else {
					echo "Error deleting blog comment.";
				}
			}elseif($_GET['action']=="del"){
				if(!$_POST['del']){
					echo "
					<form method='post' action=''>
						<table border='0' width='100%'>
							<tr >
								<td class='regtext' align='center'>
									Select a blog entry to delete
								</td>
							</tr>
							<tr >
								<td>
									<b>Blog</b>
								</td>
							</tr>
							<tr >
								<td>
									<select name='blog'>
											<option value=''>Please select...</option>
										<optgroup label='Your Blog Entries'>";
					$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog WHERE author='".$_SESSION['id']."' ORDER BY id ASC");
					while($b = mssql_fetch_array($gb)){
						echo "
											<option value='".$b['id']."'>[".$b['date']."] ".$b['title']."</option>";
					}
					if($_SESSION['admin']){
						echo "
										<optgroup label='Administrator'>";
						$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog WHERE author='".$_SESSION['id']."' ORDER BY author,id ASC");
						while($b = mssql_fetch_array($gb)){
							echo "
											<option value='".$b['id']."'>[".$b['date']."] ".$b['title']."</option>";
						}
					}
					echo "
										</optgroup>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<input type='submit' name='del' value='Delete' />
								</td>
							</tr>
						</table>
					</form>";
				}else{
					$blog = $_POST['blog'];
					if($blog == ""){
						echo "Please select a blog entry to delete.";
					}else{
						$d = mssql_query("DELETE FROM dkcms.dbo.dkcms_gmblog WHERE id='".$blog."'");
						echo "The blog entry has been deleted.";
					}
				}
			}
		echo "
			</fieldset>";
	}else{
		include('modules/public/accessdenied.php');
	}
}else{
	echo "Please log in to use this feature.";
}
?>