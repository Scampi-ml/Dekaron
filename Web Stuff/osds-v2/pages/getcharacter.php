<?php 

/* -------------{The appointed characters listing page by Zombe}------------- */ 
//        Don't edit below if you don't know what you are doing. 
// 			Thanks again to zombe for this
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}

$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
echo'<center>'; 
echo'<Form Name ="form0" Method ="POST">'; 
echo'Enter an account name:<p>'; 
echo'<input name="name" type="text"><p>'; 
echo'<input name="submit" type="submit" value="Get character list!"><p>'; 
echo'</form0>'; 
$name = $_POST['name']; 

if ($name) 
{ 
    $result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '$name'",$ms_con); 
    $row2 = mssql_fetch_array($result2); 
    $user_no = "$row2[user_no]"; 
    $login = "$row2[login_time]"; 
    $logout = "$row2[logout_time]"; 
    if (($login) && ($logout) && ($login > $logout)) $status = 'Online'; 
    else $status = 'Offline'; 
     
    if ($user_no) 
    { 
        echo " 
            <p>&nbsp<p>&nbsp<p> 
            The account <b>$name</b> has the following characters:<br><table border='1'><p>&nbsp 
            <tr> 
            <td align='center'><b>Char. No</b></td> 
            <td align='center'><b>Char. Name</b></td> 
            <td align='center'><b>Level</b></td> 
            <td align='center'><b>Class</b></td> 
            <td align='center'><b>Map index</b></td> 
            <td align='center'><b>Status</b></td> 
            </tr> 
        "; 
    } 
    else echo 'No such account'; 
     
    $result = mssql_query("SELECT * FROM character.dbo.user_character WHERE user_no = '$user_no'",$ms_con); 
    while ($record = mssql_fetch_array($result)) 
    { 
        if ($record[byPCClass] == 0) $class = 'Azure Knight'; 
        if ($record[byPCClass] == 1) $class = 'Segita Hunter'; 
        if ($record[byPCClass] == 2) $class = 'Incar Magician'; 
        if ($record[byPCClass] == 3) $class = 'Vicious Summoner'; 
        if ($record[byPCClass] == 4) $class = 'Segnale'; 
        if ($record[byPCClass] == 5) $class = 'Bagi Warrior'; 
        if ($record[byPCClass] == 6) $class = 'Aloken'; 
        if (($record[login_time]) && ($record[logout_time]) && ($record[login_time] > $record[logout_time])) $status = 'Online'; 
        else $status = 'Offline'; 
         
        echo " 
            <tr> 
            <td align='center'>$record[character_no]</td> 
            <td align='center'>$record[character_name]</td> 
            <td align='center'>$record[wLevel]</td> 
            <td align='center'>$class</td> 
            <td align='center'>$record[wMapIndex]</td> 
            <td align='center'>$status</td> 
            </tr> 
        "; 
    } 
} 
?> 
