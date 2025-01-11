<?php

$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$INSERT[] = "SET IDENTITY_INSERT blog_default_cblocks ON";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(1,'Mini Calendar','get_mini_calendar', 1, 1, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(2,'Last 10 Entries','get_last_entries', 1, 2, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(3,'My Blog Links','get_my_links', 1, 3, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(4,'My Gallery Albums','get_albums', 0, 4, 0, 0)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(5,'Last 10 Comments','get_last_comments', 1, 5, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(6,'My Picture','get_my_picture', 0, 6, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(7,'Random Album Image','get_random_album_image', 0, 7, 0, 0)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(8,'Active Users','get_active_users', 0, 8, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(9, 'Tags','get_my_tags', 0, 9, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(10, 'My Search','get_my_search', 0, 10, 0, 1)";
$INSERT[] = "INSERT INTO blog_default_cblocks(cbdef_id, cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES(11, 'Categories','get_my_categories', 0, 11, 0, 1)";
$INSERT[] = "SET IDENTITY_INSERT blog_default_cblocks OFF";

$INSERT[] = "SET IDENTITY_INSERT blog_pingservices ON";
$INSERT[] = "INSERT INTO blog_pingservices(blog_service_id,blog_service_key, blog_service_name, blog_service_host, blog_service_port, blog_service_path, blog_service_methodname, blog_service_extended, blog_service_enabled )
VALUES(1, 'technorati', 'Technorati', 'rpc.technorati.com', 80, '/rpc/ping', 'weblogUpdates.ping', 0, 1 )";
$INSERT[] = "INSERT INTO blog_pingservices(blog_service_id,blog_service_key, blog_service_name, blog_service_host, blog_service_port, blog_service_path, blog_service_methodname, blog_service_extended, blog_service_enabled )
VALUES(2, 'weblogs', 'Weblogs.com', 'rpc.weblogs.com', 80, '/RPC2', 'weblogUpdates.extendedPing', 1, 1 )";
$INSERT[] = "INSERT INTO blog_pingservices(blog_service_id,blog_service_key, blog_service_name, blog_service_host, blog_service_port, blog_service_path, blog_service_methodname, blog_service_extended, blog_service_enabled )
VALUES(3, 'pingomatic', 'Ping-o-Matic', 'rpc.pingomatic.com', 80, '/RPC2', 'weblogUpdates.ping', 0, 1 )";
$INSERT[] = "INSERT INTO blog_pingservices(blog_service_id,blog_service_key, blog_service_name, blog_service_host, blog_service_port, blog_service_path, blog_service_methodname, blog_service_extended, blog_service_enabled )
VALUES(4, 'google', 'Google Blog Search', 'blogsearch.google.com', 80, 'ping/RPC2', 'weblogUpdates.extendedPing', 1, 1 )";
$INSERT[] = "SET IDENTITY_INSERT blog_pingservices OFF";

ipsRegistry::DB()->delete('cache_store', "cs_key IN ('blog_headers', 'blog_themes' )" );

$INSERT[] = "INSERT INTO cache_store (cs_key ,cs_value , cs_array, cs_updated) VALUES ('blog_headers', '' , 1, 0);";
$INSERT[] = "INSERT INTO cache_store (cs_key ,cs_value , cs_array, cs_updated) VALUES ('blog_themes', '' , 1, 0);";

$INSERT[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd, app)
VALUES(1, 'Blog Plugin', 'This is the plugin for making reports for the <a href=''http://www.invisionblog.com/'' target=''_blank''>IP.Blog</a>.', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'blog', ',1,2,3,4,6,', ',4,6,', 'a:1:{s:15:"report_supermod";s:1:"1";}', 0, 'blog');
EOF;

$INSERT[] = "ALTER TABLE groups ADD g_blog_attach_max INT NOT NULL DEFAULT '-1'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_attach_per_entry INT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_do_html TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_do_commenthtml TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_allowpoll TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_allowprivate TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_allowprivclub TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_alloweditors TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_allowskinchoose TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_preventpublish TINYINT NOT NULL DEFAULT '0'";
$INSERT[] = "ALTER TABLE groups ADD g_blog_settings TEXT;";

/* set up  basic permissions for admin groups */

$groups = array();

$DB->build( array( 'select' => '*',
				   'from'   => 'groups',
				   'where'  => 'g_view_board=1 AND g_id NOT IN(' . implode( ',', array( ipsRegistry::$settings['banned_group'], ipsRegistry::$settings['guest_group'], ipsRegistry::$settings['auth_group'] ) ) . ')' ) );
				   
$o = $DB->execute();

while( $row = $DB->fetch( $o ) )
{
	$save = array(  'g_blog_do_html'			=> 0,
					'g_blog_do_commenthtml'		=> 0,
					'g_blog_allowpoll'			=> 1,
					'g_blog_allowprivate'		=> 1,
					'g_blog_allowprivclub'		=> 1,
					'g_blog_alloweditors'		=> 1,
					'g_blog_attach_max'			=> 0,
					'g_blog_attach_per_entry'	=> 0,
					'g_blog_allowskinchoose'	=> 1,
					'g_blog_preventpublish'		=> 0,
					'g_blog_settings'			=> serialize( array(
																	'g_blog_allowview'    => 1,
																	'g_blog_allowcomment' => 1,
																	'g_blog_allowcreate'  => 1,
																	'g_blog_allowlocal'   => 1,
																	'g_blog_allowownmod'  => 1,
																	'g_blog_maxblogs'	  => 25,
																	'g_blog_allowdelete'  => 1,
																	'g_blog_rsspergo'	  => 5 ) ) );
					
	$DB->update( 'groups', $save, 'g_id=' . $row['g_id'] );
	$DB->update( 'members', array( 'has_blog' => 'recache' ), 'member_group_id=' . $row['g_id'] );
}


