<?php

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

/* Can't use replace on TEXT in MSSQL so- */
$DB->build( array( 'select' => '*',
				   'from'   => 'downloads_mime' ) );
$o = $DB->execute();

while( $g = $DB->fetch( $o ) )
{
	$DB->update( 'downloads_mime', array( 'mime_img' => str_replace( 'folder_mime_types', 'mime_types', $g['mime_img'] ) ), 'mime_id=' . $g['mime_id'] );
}



