<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="left_table" height="900">
	<tr>
    	<td align="left" valign="top">
			<?php
            $nav_xml = array();
            if ( $handle = @opendir( "modules_nav" ) )
            {
                while ( ( $file = readdir( $handle ) ) !== false )
                {
                    if ( preg_match( "#^nav_(.*).xml\$#i", $file, $matches ) )
                    {
                        $nav_key = preg_replace( "#[^a-z0-9]#i", "", $matches[1] );
                        $nav_xml["{$nav_key}"] = $file;
                    }
                }
                closedir( $handle );
            }
            
            $nav_categories = array( );
            
            foreach ( $nav_xml as $xml => $xml_file )
            {
                $o_xml = simplexml_load_file( "modules_nav/".$xml_file."" );
                foreach ( $o_xml as $nav_cat )
                {
                    $nav_group = $nav_cat['group'];
                    $nav_categories["{$nav_group}"] = $nav_cat['title'];
                }
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
					$margin = 'margin-top: 10px';
				}
				echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\" class=\"nav_table\" style=\"".$margin.";\"><tr><td align=\"left\" class=\"nav_title\">".$cat_value."</td></tr>";
                foreach ( $nav_xml as $xml => $xml_file )
                {
                    $o_xml = simplexml_load_file( "modules_nav/".$xml_file."" );
                    foreach ( $o_xml as $nav_cat )
                    {
                        foreach ( $nav_cat as $nav_script )
                        {
                            if ( $nav_script['group'] == $cat )
                            {
                                echo "   <tr><td align=\"left\" class=\"nav_title_sub\"><a href=\"".$nav_script['link']."\" target=\"body\">".$nav_script[0]."</a></td></tr>";
                            }
                        }
                    }
                }
				$count_cat++;
                echo "</table>";
            }
            ?>
		</td>
	</tr>
</table>
