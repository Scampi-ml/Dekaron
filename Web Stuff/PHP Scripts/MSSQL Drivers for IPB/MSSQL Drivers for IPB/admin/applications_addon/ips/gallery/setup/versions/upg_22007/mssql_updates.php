<?php

if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "perms_thumbs") )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE gallery_categories ALTER COLUMN perms_thumbs TEXT NULL;";
if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "perms_view") )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE gallery_categories ALTER COLUMN perms_view TEXT NULL;";
if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "perms_images") )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE gallery_categories ALTER COLUMN perms_images TEXT NULL;";
if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "perms_comments") )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE gallery_categories ALTER COLUMN perms_comments TEXT NULL;";
if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "perms_moderate") )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE gallery_categories ALTER COLUMN perms_moderate TEXT NULL;";

$SQL[] = "UPDATE gallery_form_fields SET deleteable='0' WHERE id=4 OR id=5";

?>