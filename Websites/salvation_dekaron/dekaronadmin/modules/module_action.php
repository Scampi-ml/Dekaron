<?php
$form = "";
if(isset($_GET['account']) && !empty($_GET['account']))
{
    $action_xml = array();
    if ( $handle = @opendir( "modules_action" ) )
    {
        while ( ( $file = readdir( $handle ) ) !== false )
        {
            if ( preg_match( "#^account_action_(.*).xml\$#i", $file, $matches ) )
            {
                $action_key = preg_replace( "#[^a-z0-9]#i", "", $matches[1] );
                $action_xml["{$action_key}"] = $file;
            }
        }
        closedir( $handle );
    }
    
    $action_categories = array( );
    
    foreach ( $action_xml as $xml => $xml_file )
    {
        $o_xml = simplexml_load_file( "modules_action/".$xml_file."" );
        foreach ( $o_xml as $action_cat )
        {
            $action_group = $action_cat['group'];
            $action_categories["{$action_group}"] = $action_cat['title'];
        }
    }
    
    ksort( $action_categories );
    
    $count_cat = '0';
    foreach ( $action_categories as $cat => $cat_value )
    {
    
        $form .= "<optgroup label='".$cat_value."'>";
        foreach ( $action_xml as $xml => $xml_file )
        {
            $o_xml = simplexml_load_file( "modules_action/".$xml_file."" );
            foreach ( $o_xml as $action_cat )
            {
                foreach ( $action_cat as $action_script )
                {
                    if ( $action_script['group'] == $cat )
                    {
                        $form .= "<option value='".$action_script['link']."&account=".$_GET['account']."'>".$action_script[0]."</option>";
                    }
                }
            }
        }
        $count_cat++;
        $form .= "</optgroup>";
    }
}
elseif(isset($_GET['character']) && !empty($_GET['character']))
{
    $action_xml = array();
    if ( $handle = @opendir( "modules_action" ) )
    {
        while ( ( $file = readdir( $handle ) ) !== false )
        {
            if ( preg_match( "#^character_action_(.*).xml\$#i", $file, $matches ) )
            {
                $action_key = preg_replace( "#[^a-z0-9]#i", "", $matches[1] );
                $action_xml["{$action_key}"] = $file;
            }
        }
        closedir( $handle );
    }
    
    $action_categories = array( );
    
    foreach ( $action_xml as $xml => $xml_file )
    {
        $o_xml = simplexml_load_file( "modules_action/".$xml_file."" );
        foreach ( $o_xml as $action_cat )
        {
            $action_group = $action_cat['group'];
            $action_categories["{$action_group}"] = $action_cat['title'];
        }
    }
    
    ksort( $action_categories );
    
    $count_cat = '0';
    foreach ( $action_categories as $cat => $cat_value )
    {
    
        $form .= "<optgroup label='".$cat_value."'>";
        foreach ( $action_xml as $xml => $xml_file )
        {
            $o_xml = simplexml_load_file( "modules_action/".$xml_file."" );
            foreach ( $o_xml as $action_cat )
            {
                foreach ( $action_cat as $action_script )
                {
                    if ( $action_script['group'] == $cat )
                    {
                        $form .= "<option value='".$action_script['link']."&character=".$_GET['character']."&account=".$_GET['acc']."'>".$action_script[0]."</option>";
                    }
                }
            }
        }
        $count_cat++;
        $form .= "</optgroup>";
    }					
}
elseif(isset($_GET['guild']) && !empty($_GET['guild']))
{
    $action_xml = array();
    if ( $handle = @opendir( "modules_action" ) )
    {
        while ( ( $file = readdir( $handle ) ) !== false )
        {
            if ( preg_match( "#^guild_action_(.*).xml\$#i", $file, $matches ) )
            {
                $action_key = preg_replace( "#[^a-z0-9]#i", "", $matches[1] );
                $action_xml["{$action_key}"] = $file;
            }
        }
        closedir( $handle );
    }
    
    $action_categories = array( );
    
    foreach ( $action_xml as $xml => $xml_file )
    {
        $o_xml = simplexml_load_file( "modules_action/".$xml_file."" );
        foreach ( $o_xml as $action_cat )
        {
            $action_group = $action_cat['group'];
            $action_categories["{$action_group}"] = $action_cat['title'];
        }
    }
    
    ksort( $action_categories );
    
    $count_cat = '0';
    foreach ( $action_categories as $cat => $cat_value )
    {
    
        $form .= "<optgroup label='".$cat_value."'>";
        foreach ( $action_xml as $xml => $xml_file )
        {
            $o_xml = simplexml_load_file( "modules_action/".$xml_file."" );
            foreach ( $o_xml as $action_cat )
            {
                foreach ( $action_cat as $action_script )
                {
                    if ( $action_script['group'] == $cat )
                    {
                        $form .= "<option value='".$action_script['link']."&guild=".$_GET['guild']."'>".$action_script[0]."</option>";
                    }
                }
            }
        }
        $count_cat++;
        $form .= "</optgroup>";
    }						
}
else
{

}
$smarty->assign("form", $form); 
?>
