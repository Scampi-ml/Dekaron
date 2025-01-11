<?php
$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->addField('gallery_categories', 'images_per_page', 'smallint', "'25'");
$DB->addIndex('gallery_images', 'album', 'album_id, approved, idate');
$DB->addField('groups', 'g_max_notes', 'smallint', "'5'");
$DB->addField('gallery_images', 'image_notes', 'text', "''");
$DB->addField('gallery_albums', 'profile_album', 'tinyint', "'0'");
$DB->addField('gallery_albums', 'cover_img_id', 'bigint', "'0'");
$DB->addField('gallery_categories', 'cover_img_id', 'bigint', "'0'");
$DB->addField('groups', 'g_gallery_cat_cover', 'tinyint', "'0'");
$DB->addField('gallery_albums', 'parent', 'bigint', "'0'");
$DB->addField('gallery_albums', 'friend_only', 'tinyint', "'0'");
$DB->addField('gallery_albums', 'name_seo', 'varchar(60)', "''");
$DB->addField('gallery_categories', 'name_seo', 'varchar(60)', "''");
$DB->addField('gallery_images', 'caption_seo', 'varchar(255)', "''");

$SQL[] = "CREATE TABLE gallery_image_views ( views_img INT NOT NULL DEFAULT '0' );";

$SQL[] = "UPDATE gallery_categories SET images_per_page=imgs_per_col*imgs_per_row";

$DB->addIndex('gallery_albums', 'member', 'member_id, name');
$DB->addIndex('gallery_comments', 'image', 'img_id, pid');
$DB->addIndex('gallery_albums', 'category', 'category_id, last_pic_date');

$DB->changeField('gallery_images', 'masked_file_name', 'masked_file_name', 'varchar(255)', "''");
$DB->changeField('gallery_images', 'medium_file_name', 'medium_file_name', 'varchar(255)', "''");
$DB->changeField('gallery_images', 'file_name', 'file_name', 'varchar(255)', "''");