<?php
// Set SEO Page Tile Names
if ( preg_match ('/index.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Dekaron");
}
// fix the homepage, fucking windows ....
if ( preg_match ('/Index.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Dekaron");
}
if ( preg_match ('/login.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Dekaron Login");
}
if ( preg_match ('/register.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Dekaron Register");
}
if ( preg_match ('/information.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Server Info");
}
if ( preg_match ('/404.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation File not found");
}
if ( preg_match ('/ranking.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Ranking");
}
if ( preg_match ('/donate.php/', $parts[count($parts) - 1] ))
{
	$smarty->assign("SEO_PAGE_NAME", "Salvation Donate");
}
?>