<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['admin_name']) && empty($_SESSION['admin_name']))
{
	header('Location: login.php');
	die();
}
if ( $_GET['get'] == "logout" )
{
	session_destroy();
	header( "Location: login.php" );
	exit();
}
ob_start();
require_once ('engine/class_config.php');
require_once ('engine/global_functions4.php');



if(!is_dir("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/"))
{
	mkdir("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/", 0777);
}

if(!file_exists("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/config.ini"))
{
	$default_config_ini = file_get_contents('engine/config.ini');
	$file = fopen("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/config.ini", 'w');
	fwrite($file, $default_config_ini);
	fclose($file);
}

if(!file_exists("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/permissions.ini"))
{
	$default_config_ini = file_get_contents('engine/permissions.ini');
	$file = fopen("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/permissions.ini", 'w');
	fwrite($file, $default_config_ini);
	fclose($file);
}


$config = new ConfigMagik("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/config.ini");
$config->PROCESS_SECTIONS = true;
$config->PROTECTED_MODE   = false;
$config->SYNCHRONIZE      = true;

$perm = new ConfigMagik("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/permissions.ini");
$perm->PROCESS_SECTIONS = false;
$perm->PROTECTED_MODE   = false;
$perm->SYNCHRONIZE      = true;



$dac_api = "0";
$dac_api_key = '3B90E4C1C4D4D204ECB30CDB0F0A2E50';

if($dac_api == '1')
{
	$request = 'http://localhost:8080/dac_api/dac_api.php?api_key='.$dac_api_key.'&command='.base64_encode($command).'';
	$response = file_get_contents($request);
	$jsonobj = json_decode($response);
}
else
{
	require_once ('engine/class_mssql.php');
	$db = new database_class();
	$db->mssql_host = $_SESSION["db_host"];
	$db->mssql_user = $_SESSION["db_user"];
	$db->mssql_pasw = base64_decode($_SESSION["db_pasw"]);
}



ini_set( "display_errors", "On" );
error_reporting( E_ERROR | E_WARNING | E_PARSE );
ini_set('log_errors', '1');
ini_set('error_log', 'logs/php_error_log_' . date("m_d_y") . '.log'); 
	
$GLOBALS["msg_redirect"] = $config->get('msg_redirect', 'settings_dac_settings');
$GLOBALS["admin_name"] = $_SESSION['admin_name'];

if ( $_GET['frame'] == "header" )
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="style/<?php echo $config->get('style', 'settings_dac_settings'); ?>/header.css" />
        <title>DAC</title>
    </head>
    <body>
    	<?php include("modules/header.php"); ?>
    </body>
</html>
<?php        
}
else if ( $_GET['frame'] == "navigation" )
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
        <link rel="stylesheet" type="text/css" href="style/<?php echo $config->get('style', 'settings_dac_settings'); ?>/left_side.css" />
        <title>DAC</title>
    </head>
    <body>
    	<?php include( "modules/left_side.php" ); ?>
	</body>
</html>
<?php
}
else if ( $_GET['frame'] == "body" || isset( $_GET['get'] ) )
{
?>	

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="style/<?php echo $config->get('style', 'settings_dac_settings'); ?>/style.css" />
        <script type="text/javascript" src="script/global.js"></script>
        <title>DAC</title>
    </head>
    <body>
		<?php
        if ( !isset( $_GET['get'] ) ) 
        {
            $m_am = "home";
        }
        else
        {
            $m_am = safe_input( $_GET['get'], "_" );
        }
        ?>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    <div align="center" style="margin-top: 20px; margin-bottom: 20px;">
                    <?php
                    if ( is_file( "modules/".$m_am.".php" ) )
                    {
                        $current_module = $m_am . "_php";
                        
                        if(file_exists("servers/".$_SESSION["server"]."/".$_SESSION['admin_name']."/admin.txt"))
                        {
                            include( "modules/".$m_am.".php" );
                        }
                        elseif(!$perm->get($current_module, ''))
                        {
                            echo notice_message_admin('Sorry, you dont have permission for <b>'.$m_am.'</b>.', '0', '2', 'index.php?get=home');
                        }
                        elseif($perm->get($current_module, '') == 'no_access')
                        {
                            echo notice_message_admin('Sorry, you dont have permission for <b>'.$m_am.'</b>.', '0', '2', 'index.php?get=home');
                        }
                        else
                        {
                        }
                    }
                    else
                    {
                        ?>
                        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                            <tr>
                                <td class="cat"><div align="left"><b>ERROR</b></div></td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-top: 20px; padding-bottom: 20px;">Module <b><?php echo $m_am; ?>.php</b> could not be found.</td> 
                            </tr>
                        </table>
                    <?php 
                    }
                    ?>	
                    </div>
                </td>
            </tr>
        </table>
	</body>
</html>
<?php } else { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>DAC</title>
    </head>
    <frameset rows="42,*"  framespacing="0" border="0" frameborder="0" frameborder="no" border="0">
        <frame src="index.php?frame=header" name="header" scrolling="no" noresize="noresize" frameborder="0" marginwidth="10" marginheight="0" border="no" />
        <frameset cols="230,*" framespacing="0" border="0" frameborder="0" frameborder="no" border="0">
            <frame src="index.php?frame=navigation" name="navigation" scrolling="yes" frameborder="0" marginwidth="0" marginheight="0" border="no" style="overflow: auto; overflow-x: auto; overflow-y:hidden; height:900; width: auto;" />
            <frame src="index.php?frame=body" name="body" scrolling="yes" frameborder="0" marginwidth="10" marginheight="10" border="no" style="overflow: auto; overflow-x: auto; overflow-x:hidden; height:900; width: auto;" />
        </frameset>
    </frameset>
    <noframes>
        <body>
            <p>Your browser does not support frames. Please get <a href="http://www.mozilla.org">FireFox</a>!</p>
        </body>
    </noframes>
</html>
<?php            
}
ob_end_flush();
?>