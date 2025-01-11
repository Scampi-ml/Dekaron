<?php
// The sidebar	 
$left_side = "";
$nav_xml = array();


$nav_categories = array( );


$o_xml = simplexml_load_file( "engine/nav_core.xml" );
foreach ( $o_xml as $nav_cat )
{
	$nav_group = $nav_cat['group'];
	$nav_categories["{$nav_group}"] = $nav_cat['title'];
}
ksort( $nav_categories );

$count_cat = '0';
foreach ( $nav_categories as $cat => $cat_value )
{
    if($count_cat == '0')
    {
        $margin = 'margin-top: 0px';
    }
    else
    {
        $margin = 'margin-top: 20px';
    }
    $left_side .= "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\" class=\"nav_table\" style=\"".$margin.";\"><tr><td align=\"left\" class=\"nav_title\">".$cat_value."</td></tr>";
	$o_xml = simplexml_load_file( "engine/nav_core.xml" );
	foreach ( $o_xml as $nav_cat )
	{
		foreach ( $nav_cat as $nav_script )
		{
			if ( $nav_script['group'] == $cat )
			{
				$left_side .= "   <tr><td align=\"left\" class=\"nav_title_sub\"><a href=\"".$nav_script['link']."\">".$nav_script[0]."</a></td></tr>";
			}
		}
	}
    
    $count_cat++;
    $left_side .= "</table>";
}

// send left_side to tamplate
$smarty->assign("left_side", $left_side);    
?>