<?php
if(isset($_SESSION['id'])){
	if($_SESSION['admin']){
	
	$query = mssql_query("SELECT * FROM dkcms.dbo.dkcms_download");
	$row = mssql_fetch_row($query);
	if ($_GET['step'] == ""){
		
echo "		<fieldset>";
echo "	<legend>";
echo "		<b>Download</b>";
echo "	</legend>";
				

echo "<form method='post' action='?dkcms=admin&page=download&step=2'>";
echo"<table width='100%' border='0'>
		<tr>
			<td>
			Name <br>
			<input type='text' name='name' value='".$row[2]."'  size='50' /><br /><br />
			Link (add http)<br>
			<input type='text' name='link' value='".$row[1]."' size='50'/><br><br />
			<input type='hidden' name='select' value='1'>
			<input type='hidden' name='descr' value='0' />
			<input type='hidden' name='version' value='0' />
			<input type='submit' value='Save Download' />
			</center>
			</td>
		</tr>
	</form>
	</table>";
	echo " </fieldset>";
		
		} else if ($_GET['step'] == "2"){

		$u = mssql_query("UPDATE dkcms.dbo.dkcms_download SET
		 
		name='".$_POST['name']."', 
		link='".$_POST['link']."', 
		version='".$_POST['version']."', 
		descr='".$_POST['descr']."' 
		
		WHERE id='1'");
		
echo "		<fieldset>";
echo "	<legend>";
echo "		<b>Download</b>";
echo "	</legend>";


echo "<center>The download has been edited!</center>";
echo "<meta http-equiv='refresh' content='2;url=?dkcms=admin&page=download'>";
echo " </fieldset>";
				
					

		}
	}else{
		include('modules/public/accessdenied.php');
	}
}else{
	echo "You must be logged in to use this feature.";
}

?>