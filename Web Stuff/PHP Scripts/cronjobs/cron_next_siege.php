<?php

$query_next_siege = $db->SQLquery("SELECT TOP 1 character.dbo.FN_BinDateToDateTime(dwStartTime) as time FROM character.dbo.SIEGE_INFO WHERE CHANNEL_NO = '1' AND SIEGE_TAG = 'Y' ORDER BY time ASC");
$next_siege = $db->SQLfetchArray($query_next_siege);
$db->addfile('next_siege.cache', $next_siege['time']);
?>