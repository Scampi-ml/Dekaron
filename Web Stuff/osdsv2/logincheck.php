<?
include "session.php";
if (!isset($_SESSION["userid"]) && !isset($_REQUEST["pg"]))
{
echo "ERROR You must be logged in!";
die();
}
?>