<?php 
$msconnect = mssql_connect("37.59.180.41","SaBaker1893","ImPP8pL0h");;
        $msdb = mssql_select_db("character", $msconnect);

        $q = "SELECT user_id FROM account.dbo.user_profile WHERE login_flag = '1100'";
        $r = mssql_query($q);
        $sad = mssql_num_rows($r);

$smarty->assign("SAD", $sad);
?>