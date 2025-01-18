<?php
include ('osdscore.php');


// the search string - check if sql inject
if ( isValid ( $_GET['search_string'] ) == true )
{
	$search_string = $_GET['search_string'];
}
else
{
	JavaAlert(LAN_error_search_string, 'goback');
	die();
}

// is the string filled in?
if ( empty ( $search_string ) )
{
	if ( isset($_GET['back'] ))
	{
		JavaAlert(LAN_search_no_string, 'index.php');
		die();
	}
	JavaAlert(LAN_search_no_string, 'goback');
	die();
}

// Method of searching
if ( $_GET['method'] == 'account' )
{
	include ( 'search_account.php' );
}
elseif ( $_GET['method'] == 'character' )
{
	include ( 'search_character.php' );
}
elseif ( $_GET['method'] == 'guilds' )
{
	include ( 'search_guilds.php' );
}
elseif ( $_GET['method'] == 'guild' )
{
	include ( 'search_guild.php' );
}
elseif ( $_GET['method'] == 'viewcharacters' )
{
	include ( 'search_viewcharacters.php' );
}
elseif ( $_GET['method'] == 'gm' )
{
	include ( 'search_gm.php' );
}
elseif ( $_GET['method'] == 'dev' )
{
	include ( 'search_dev.php' );
}
elseif ( $_GET['method'] == 'opr' )
{
	include ( 'search_opr.php' );
}
elseif ( $_GET['method'] == 'email' )
{
	include ( 'search_email.php' );
}
else
{
	$method_name = '';
	JavaAlert(LAN_search_no_method, 'goback');
	die();
	
}
echo '</table>
</div>';

echo FOOTER;

?>