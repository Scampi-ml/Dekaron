
<?php    
$table = "";
$top = $config->get('top','settings_account_logouts');
if($config->get('shownull','settings_account_logouts') == '1')
{
    $shownull = 'WHERE account.dbo.USER_CONNLOG_KEY.logout_time IS NOT NULL';
}
else
{
    $shownull = '';
}
        
$result = $db->SQLquery("
SELECT TOP ".$top."
  account.dbo.USER_CONNLOG_KEY.user_no,
  account.dbo.USER_PROFILE.user_no,
  account.dbo.USER_PROFILE.[user_id],
  account.dbo.USER_CONNLOG_KEY.login_time,
  account.dbo.USER_CONNLOG_KEY.logout_time,
  account.dbo.USER_CONNLOG_KEY.conn_ip
FROM
  account.dbo.USER_CONNLOG_KEY
  INNER JOIN account.dbo.USER_PROFILE ON (account.dbo.USER_CONNLOG_KEY.user_no = account.dbo.USER_PROFILE.user_no)
".$shownull."
ORDER BY account.dbo.USER_CONNLOG_KEY.logout_time DESC");  

$qnum1 = $db->SQLfetchNum($result);
if ($qnum1 == '0')
{
    $table .= '<tr><td align="center" class="panel_text_alt_list" colspan="4">No logouts found</td></tr>';
}
else
{
    $count = 0;
    while ($record = $db->SQLfetchArray($result)) 
    { 
        $count++;
        $tr_color = ($count % 2) ? '' : 'even';
        
        $table .= "<tr class='" . $tr_color . "' > 
                <td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['logout_time'])."</td> 
                <td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['login_time'])."</td>
                <td align='left' class='panel_text_alt_list'>".htmlspecialchars(decodeIp($record['conn_ip']))."</td> 
                <td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['user_id'])."</td> 
            </tr>"; 
    }
}
$smarty->assign("TABLE", $table); 
?>
