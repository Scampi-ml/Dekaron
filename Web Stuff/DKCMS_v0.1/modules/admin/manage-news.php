<?php 
if(isset($_SESSION['id'])){
	if(isset($_SESSION['admin'])){
		if($_GET['action']=="add"){
			echo "
		<fieldset>
			<legend>
				<b>Add A News Article</b>
			</legend>";

				if(!isset($_POST['add'])){
					echo "
			<form method='post' action=''>
				<table border='0' width='100%'>
					<tr>
						<td class='regtext' colspan='2'>
							<b>Title:</b>
						</td>
					</tr>
					<tr>
						<td>
							<input type='text' style='width:50%;' name='title' />
						</td>
					</tr>
					<tr>
						<td class='regtext' colspan='2'>
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
							<b>Category:</b>
						</td>
					</tr>
					<tr>
						<td>
							<select name='cat'>
								<option value='notice'>Notice</option>
								<option value='update'>Update</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='regtext'>
							<b>Content:</b>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name='content' style='height:100px;width:100%;'></textarea>
						</td>
					</tr>
					<tr>
						<td class='regtext' align='center' colspan='2'>
							You may edit or delete this news article later on. 
						</td>
					</tr>
					<tr>
						<td align='center'>
							<input type='submit' name='add' value='Add News Article' />
						</td>
					</tr>
				</table>
			</form>";
				}else{
					$title = $_POST['title'];
					$author = $_SESSION['id'];
					$date = date("m.d");
					$cat = $_POST['cat'];
					$content = $_POST['content'];
					if($title == ""){
						echo "You must enter a title.";
					}elseif(empty($cat)){
						echo "You must select a category.";
					}elseif($content == ""){
						echo "You must enter some content.";
					}else{
						$i = mssql_query("INSERT INTO dkcms.dbo.dkcms_news (title,author,type,date,content) VALUES ('".$title."','".$author."','".$cat."','".$date."','".$content."')");
						echo "Your news article has been posted.";
					}
				}
			
			echo "
		</fieldset>";
		}elseif($_GET['action']=="edit"){
			echo "
		<fieldset>
			<legend>
				<b>Edit A News Article</b>
			</legend>";
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$gn = mssql_query("SELECT * FROM dkcms.dbo.dkcms_news WHERE id='".$id."'");
				$n = mssql_fetch_array($gn);
				if(!isset($_POST['edit'])){
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
							<input type='text' style='width:50%;' name='title' value='".$n['title']."' />
						</td>
					</tr>
					<tr>
						<td class='regtext'>
							<b>Author:</b>
						</td>
					</tr>
					<tr>
						<td>
							".$n['author']."
						</td>
					</tr>
					<tr>
						<td class='regtext'>
							<b>Category:</b>
						</td>
					</tr>
					<tr>
						<td>
							<select name='cat'>
								<option value='notice'>Notice</option>
								<option value='update'>Update</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='regtext'>
							<b>Content:</b>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name='content' style='height:100px;width:100%;'>".$n['content']."</textarea>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<input type='submit' name='edit' value='Edit News Article' />
						</td>
					</tr>
				</table>
			</form>";
				}else{
					$title = $_POST['title'];
					$cat = $_POST['cat'];
					$content = $_POST['content'];
					if($title == ""){
						echo "You must enter a title.";
					}elseif(empty($cat)){
						echo "You must select a category.";
					}elseif($content == ""){
						echo "You must enter some content.";
					}else{
						$u = mssql_query("UPDATE dkcms.dbo.dkcms_news SET title='".$title."',type='".$cat."',content='".$content."' WHERE id='".$id."'");
						echo "News article, <b>".$n['title']."</b>, has been updated.";
					}
				}
			}else{
				echo "
			<table border='0' width='100%'>
				<tr>
					<td class='regtext'>
						<b>".$servername." News Articles</b>
					</td>
				</tr>
				<tr>
					<td>
						Select a news article to modify:
					</td>
				</tr>";
				$gn = mssql_query("SELECT * FROM dkcms.dbo.dkcms_news ORDER BY id DESC");
				while($n = mssql_fetch_array($gn)){
					echo "
				<tr>
					<td>
						[".$n['date']."] <a href='?dkcms=admin&amp;page=mannews&amp;action=edit&amp;id=".$n['id']."'>".$n['title']."</a> [#".$n['id']."]
					</td>
				</tr>";
				}
			}
			echo "
			</table>
		</fieldset>";

		} else if ($_GET['action']=="pdel") {
			if (!isset($_GET['id'])) {
				echo "No Comment ID Specified.";
			} else if (!is_numeric($_GET['id'])) {
				echo "Invalid Comment ID.";
			} else {
				$newsid = $_GET['id'];
				$query = mssql_query("SELECT * FROM dkcms.dbo.dkcms_ncomments WHERE id = ".$newsid."");
				$rows = mssql_num_rows($query);
				$fetch = mssql_fetch_array($query);
	
				if ($rows != 1) {
					echo "Comment ID Does Not Exists.";
				} else {
					$delete = "DELETE FROM dkcms_ncomments WHERE id = ".$newsid."";
					if (mssql_query($delete)) {
						header("Location:?dkcms=main&page=news&id=".$fetch['nid']);
					} else {
						echo "Error deleting news comment.";
					}
				}

			}

		}elseif($_GET['action']=="del"){
			echo "
		<fieldset>
			<legend>
				<b>Delete A News Article</b>
			</legend>";
			if(!isset($_POST['del'])){
				echo "
			<form method='post' action=''>
				<table border='0' width='100%' align='center'>
					<tr>
						<td class='regtext' align='center'>
							Select a news article to delete
						</td>
					</tr>
					<tr>
						<td align='center'>
							<b>Article:</b>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<select name='art'>
								<option value=''>Please select...</option>";
				$gn = mssql_query("SELECT * FROM dkcms.dbo.dkcms_news ORDER BY id DESC");
				while($n = mssql_fetch_array($gn)){
					echo "
								<option value='".$n['id']."'>#".$n['id']." - ".$n['title']."</option>";
				}
				echo "
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
				$art = $_POST['art'];
				if($art == ""){
					echo "Please select a news article to delete.";
				}else{
					$d = mssql_query("DELETE FROM dkcms.dbo.dkcms_news WHERE id='".$art."'");
					echo "The news article has been deleted.";
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