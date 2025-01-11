<?php 
if($_SESSION['admin'] == 1){
	if(isset($_GET['do'])){
		$do = $_GET['do'];
	}else{
		$do = "";
	}
	echo '<fieldset><legend>Styles</legend>';
	if($do == "add"){
		if(!isset($_POST['add'])){
			echo '
			<form method="post" action="">
				Name:<br />
				<input type="text" name="sname" /><br /><br />
				Directory:<br />
				<input type="text" name="sdir" value="styles/dirhere/"/><br /><br />
				Enabled:<br />
				<select name="senabled">
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select><br /><br />
				<input type="submit" name="add" value="Add" />
			</form>
			';
		}else{
			$sname = $_POST['sname'];
			$sdir = $_POST['sdir'];
			$senabled = $_POST['senabled'];
			
			$stop = false;
			if(empty($sname)){
				echo 'You need to enter a name for your style!';
				$stop = true;
			}
			if($stop == false){
				if(empty($sdir)){
					echo 'You need to enter a directory for your style!';
					$stop = true;
				}
			}
			if($stop == false){
				mssql_query("INSERT INTO dkcms.dbo.dkcms_styles (dir, name, enabled) VALUES ('".$sdir."', '".$sname."', '".$senabled."')");
				echo 'Style added!<meta http-equiv="refresh" content="3; url=?dkcms=admin&page=styles" />';
			}
		}
	}elseif($do == "edit"){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}else{
			$id = "";
		}
		
		if(!isset($_POST['edit'])){
			$getsty = mssql_query("SELECT * FROM dkcms.dbo.dkcms_styles WHERE id=".$id."");
			$showsty = mssql_fetch_array($getsty);
			switch($showsty['enabled']){
				case 0:
					$isenabled = '<option value="1">Yes</option><option value="0" selected="selected">No</option>';
					break;
				case 1:
					$isenabled = '<option value="1" selected="selected">Yes</option><option value="0">No</option>';
					break;
			}
			echo '
			<form method="post" action="">
				Name:<br />
				<input type="text" name="sname" value="'.$showsty['name'].'"/><br /><br />
				Directory:<br />
				<input type="text" name="sdir" value="'.$showsty['dir'].'"/><br /><br />
				Enabled:<br />
				<select name="senabled">
					'.$isenabled.'
				</select><br /><br />
				<input type="submit" name="edit" value="Edit" />
			</form>
			';
		}else{
			$sname = $_POST['sname'];
			$sdir = $_POST['sdir'];
			$senabled = $_POST['senabled'];
			
			$stop = false;
			if(empty($sname)){
				echo 'You need to enter a name for your style!';
				$stop = true;
			}
			if($stop == false){
				if(empty($sdir)){
					echo 'You need to enter a directory for your style!';
					$stop = true;
				}
			}
			if($stop == false){
				mssql_query("UPDATE dkcms.dbo.dkcms_styles SET dir='".$sdir."', name='".$sname."', enabled='".$senabled."' WHERE id='".$id."'");
				echo 'Style updated!<meta http-equiv="refresh" content="3; url=?dkcms=admin&page=styles" />';
			}
		}
	}elseif($do == "delete"){
				if(isset($_GET['id'])){
			$id = $_GET['id'];
		}else{
			$id = "";
		}
		
		if(!isset($_POST['delete'])){
			echo '
			<form method="post" action="">
				Are you sure?<br />
				<select name="sdelete">
					<option value="0" selected="selected">No</option>
					<option value="1">Yes</option>
				</select><br /><br />
				<input type="submit" name="delete" value="Delete" />
			</form>
			';
		}else{
				mssql_query("DELETE FROM dkcms.dbo.dkcms_styles WHERE id=".$id."");
				echo 'Style deleted!<meta http-equiv="refresh" content="3; url=?dkcms=admin&page=styles" />';
		}
	}else{
		$getst = mssql_query("SELECT * FROM dkcms.dbo.dkcms_styles");
		while($showst = mssql_fetch_array($getst)){
			echo ''.$showst['id'].')&nbsp;&nbsp;'.$showst['name'].' - <a href="?dkcms=admin&page=styles&do=edit&id='.$showst['id'].'">EDIT</a>&nbsp;&nbsp;<a href="?dkcms=admin&page=styles&do=delete&id='.$showst['id'].'">DELETE</a><br /><br />';
		}
		echo '<br /><form method="post" action="?dkcms=admin&page=styles&do=add"><input type="submit" value="Add" /></form>';
	}
	echo '</fieldset>';
}else{
	include('modules/public/accessdenied.php');
}
?>