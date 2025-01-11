<?php

$QUERY	= array();

$registry	= ipsRegistry::instance();

$_tables	= $registry->DB()->getTableNames();

foreach( $_tables as $_table )
{
	if( preg_match( "/ccs_custom_database_(\d+)$/", $_table ) )
	{
		$registry->DB()->dropTable( str_replace( $registry->dbFunctions()->getPrefix(), '', $_table ) );
	}
}
