<?php
// this is for time.js
$smarty->assign("HOURS", date("H", time()));
$smarty->assign("MINS", date("i", time()));
$smarty->assign("SECS", date("s", time()));
$smarty->assign("DAYFULL", strtoupper(date('D')));
$smarty->assign("DAYFULL2", date('M d'));
?>