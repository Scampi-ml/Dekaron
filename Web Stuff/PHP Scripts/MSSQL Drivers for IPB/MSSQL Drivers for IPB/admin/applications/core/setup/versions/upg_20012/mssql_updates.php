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

# Fix bug where unread PM count not incremented
$DB->changeField('members', 'msg_total', 'msg_total', 'smallint', '0');
$DB->changeField('members', 'msg_total', 'new_msg', 'smallint', '0');

$SQL[] = "UPDATE members SET new_msg=0";

# Add WIZZY Blog hook
$DB->addField('members', 'has_blog', 'tinyint', '0');

# Optimization indexes
$DB->addIndex('members_converge', 'converge_email', 'converge_email');
$DB->addIndex('polls', 'tid', 'tid');