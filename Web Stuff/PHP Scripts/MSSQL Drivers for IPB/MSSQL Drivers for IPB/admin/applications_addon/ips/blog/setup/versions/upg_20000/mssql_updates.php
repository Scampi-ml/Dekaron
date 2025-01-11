<?php

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->addField( 'blog_entries', 'entry_hastags', 'INT', "'0'" );

$DB->addField( 'groups', 'g_blog_settings', 'TEXT' );

$DB->addField( 'blog_blogs', 'blog_view_level', 'VARCHAR(12)' );

$SQL[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd) VALUES(1, 'Blog Plugin', 'This is the plugin for making reports for the <a href=''http://www.invisionblog.com/'' target=''_blank''>IP.Blog</a>.', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'blog', ',1,2,3,4,6,', ',4,6,', 'a:1:{s:15:"report_supermod";s:1:"1";}', 0);
EOF;

$SQL[] = "UPDATE blog_blogs SET blog_skin_id = '0';";