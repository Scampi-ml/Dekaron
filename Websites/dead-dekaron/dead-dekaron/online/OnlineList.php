<?php 

$mssql = array( 
        'host' => "localhost", 
        'user' => "sa", 
        'pass' => "xxxxx" 
    ); 
     
echo "<center>Player Online List<br><br>"; 
echo "<table border='1'> 
    <tr> 
        <td align='center'>Character Name</td> 
        <td align='center'>Level</td> 
        <td align='center'>Map</td> 
        <td align='center'>Login</td> 

    </tr>"; 

$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']); 

$result1 = mssql_query("SELECT user_no FROM account.dbo.USER_PROFILE WHERE login_flag = '1100'",$con); 


while($row1 = mssql_fetch_row($result1)) { 
     
    $result2 = mssql_query("SELECT character_name,wLevel,wMapIndex,login_time FROM character.dbo.user_character WHERE character_name NOT LIKE '[%' AND user_no = '".$row1[0]."'   ORDER by login_time DESC",$con); 
    $row2 = mssql_fetch_row($result2); 

        echo "<tr> 
            <td align='left'>".$row2[0]."</td> 
            <td align='center'>".$row2[1]."</td> 
            <td align='center'>".$row2[2]."</td> 
            <td align='center'>".$row2[3]."</td> 

        </tr>"; 

} 
echo "</table></center>"; 
?> 