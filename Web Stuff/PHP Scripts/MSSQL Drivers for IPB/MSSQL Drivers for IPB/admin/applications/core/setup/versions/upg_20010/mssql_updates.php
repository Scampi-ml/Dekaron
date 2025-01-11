<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2004 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/
$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

# Fix bug where ICQ alt text missing last single quote

$SQL[] = "DELETE FROM skin_macro WHERE macro_value='PRO_ICQ' and macro_set=1";
$SQL[] = "INSERT INTO skin_macro (macro_value, macro_replace, macro_can_remove, macro_set) VALUES ('PRO_ICQ', '<img src=''style_images/<#IMG_DIR#>/profile_icq.gif'' border=''0''  alt=''ICQ'' />', 1, 1);";

# Fix bug where update "msg_total=msg_total+1" doesn't update when msg_total is NULL

$DB->changeField('members', 'msg_total', 'msg_total', 'int', '0');

# Fix bug where "select * from members where temp_ban..." prevents NULL IS NOT NULL confusion

$DB->changeField('members', 'msg_total', 'msg_total', 'tinyint', '0');