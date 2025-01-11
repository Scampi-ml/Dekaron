<?php
if(isset($_SESSION['id'])){
	if($_SESSION['admin']){
	
	$query = mssql_query("SELECT * FROM dkcms.dbo.dkcms_rules");
	$row = mssql_fetch_row($query);
	if ($_GET['step'] == ""){
		
echo "		<fieldset>";
echo "	<legend>";
echo "		<b>Rules</b>";
echo "	</legend>";
				

echo "<form method='post' action='?dkcms=admin&page=rules&step=2'>";
echo"<table width='100%' border='0'>
		<tr>
			<td>
			<textarea cols='75' rows='25' name='rules'>".$row[1]."</textarea><br />
			<input type='submit' value='Save Rules' />
			<input type='hidden' name='select' value='1'>
			</center>
			</td>
		</tr>
	</form>
	</table>";
	echo " </fieldset>";
		
		} else if ($_GET['step'] == "2"){

		$u = mssql_query("UPDATE dkcms.dbo.dkcms_rules SET rules='".$_POST['rules']."' WHERE id='1'");
		
echo "		<fieldset>";
echo "	<legend>";
echo "		<b>Rules</b>";
echo "	</legend>";


echo "<center>The rules has been edited!</center>";
echo "<meta http-equiv='refresh' content='2;url=?dkcms=admin&page=rules'>";
echo " </fieldset>";
				
					

		}
	}else{
		include('modules/public/accessdenied.php');
	}
}else{
	echo "You must be logged in to use this feature.";
}

?>