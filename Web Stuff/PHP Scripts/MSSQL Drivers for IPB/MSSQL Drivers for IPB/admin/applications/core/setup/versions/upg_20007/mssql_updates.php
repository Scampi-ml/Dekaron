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

$SQL[] = "SET IDENTITY_INSERT custom_bbcode ON;";
$SQL[] = "INSERT INTO custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('CODEBOX', 'Use this BBCode tag to show a scrolling codebox. Useful for long sections of code.', 'codebox', '<div class=''codetop''>CODE</div><div class=''codemain'' style=''height:200px;white-space:pre;overflow:auto''>{content}</div>', 0, '[codebox]long_code_here = '';[/codebox]');";
$SQL[] = "SET IDENTITY_INSERT custom_bbcode OFF;";