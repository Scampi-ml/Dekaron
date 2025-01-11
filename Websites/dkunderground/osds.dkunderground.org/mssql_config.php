<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>OSDS V5 | Dekaron Control Panel</title>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="./style.css" media="all" rel="stylesheet" type="text/css" />
<script src="./js/jquery-1.2.6.pack.js" type="text/javascript"></script>
<!--[if lt IE 7]>
       <script type="text/javascript" src="./js/supersleight-min.js"></script>
       <script type="text/javascript" src="./js/jquery.dropdown.js"></script>
       <style type="text/css" media="screen">
       @import url("http://theme.idowebdesign.ca/immaculee/blue/ie6.css");
           
    	</style>
        
	<![endif]-->
<script type="text/javascript">
    
	$(function() {
		$("body").addClass("has-script");
       
    });
	
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<div id="container">
  <!-- header -->
  <div id="header">
    <h1><a href="index.php"></a></h1>
  </div>
  <?php include ('menu.php'); ?>
  <div id="subbar" class="clearfix">
    <h1>OSDS V5 MSSQL Encode</h1>
  </div>
  <!-- end mainbar -->
  <div id="content" class="page clearfix">
    <div id="main">
      <div class="block">
            <center class="style2">
             We do not save login / password / server information, if you loose this information, you have to re-encode it.<br />
			 All information cannot be decoded!
            </center>
            
            <?php
//
// testbed for encrypt/decrypt routines
//

require 'class_enc_dec.php';
$crypt = new encryption_class;





function createSn($length, $characters='ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789')
{
	// ---------------------------------------------------------------------
// create_sn
// Example: create_sn(5,'abcd1234') => returns something like: '2b4d3'
// echo create_sn(15,'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789')
// ---------------------------------------------------------------------

	if ($characters == ''){ return ''; }
	$chars_length = strlen($characters)-1;
	
	mt_srand((double)microtime()*1000000);
	
	$pwd = '';
	while(strlen($pwd) < $length){
		$rand_char = mt_rand(0, $chars_length);
		$pwd .= $characters[$rand_char];
	}
	
	return $pwd;

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $key      = &$_POST['key'];
   
   // for me
   $server = &$_POST['server'];
   $user = &$_POST['user'];
   $password = &$_POST['password'];
   
   $pswdlen  = '16';
   $adj      = '1.75';
   $crypt->setAdjustment($adj);
   $mod      = '3';
   $crypt->setModulus($mod);
} else {
   unset($_SESSION['encrypt_result']);
   $key      = createsn('16','ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz');;
   $user      = NULL;
   $server      = NULL;
   $password = NULL;
   $pswdlen  = '16';
} // if

$adj = $crypt->getAdjustment();
$mod = $crypt->getModulus();
$encrypt_result = &$_SESSION['encrypt_result'];
$errors = array();

if (isset($_POST['encrypt']))
{
    $encrypt_result1 = $crypt->encrypt($key, $server, $pswdlen);
	$encrypt_result2 = $crypt->encrypt($key, $user, $pswdlen);
	$encrypt_result3 = $crypt->encrypt($key, $password, $pswdlen);
	
    $errors = $crypt->errors;
    $_SESSION['encrypt_result'] = $encrypt_result;
} 

?>
<fieldset>
<legend>OSDS V5 Config Wizard</legend>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<table>
    <tr class="even">
    	<td><strong>Key:</strong></td>
        <td><input type="text" name="key" size="40" value="<?php echo $key ?>" maxlength="16" />
        <br><small>This is a key for the mssql decryption.</small></td>
    </tr>
    <tr class="even">
    	<td><strong>MSSQL Server:</strong></td>
        <td><input type="text" name="server" size="40" value="<?php echo $server ?>" maxlength="16"/>
        <br><small>Your mssql server, this is mostly 'localhost' or an IP address</small></td></tr>
    <tr class="even">
    	<td><strong>MSSQL User:</strong></td>
        <td><input type="text" name="user" size="40" value="<?php echo $user ?>" maxlength="16" />
        <br><small>Your mssql user, this is mostly 'sa'</small></td></tr>
    <tr class="even">
    	<td><strong>MSSQL Password:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="text" name="password" size="40" value="<?php echo $password ?>"  maxlength="16"/>
        <br><small>Your mssql password</small></td></tr>
    <tr class="even">
    	<td>&nbsp;</td>
        <td></td>
    </tr>
    <tr class="even">
    	<td><input type="submit" name="encrypt" value="Create config" /></td>
        <td></td>
    </tr>
</table>
</fieldset>
<br>
<?php
if($errors)
{
	echo '<p style="color:red;">';
	foreach ($errors as $error)
	{
	   echo $error .'<br/>';
	} 
	echo '</p>';
}


if (isset($_POST['encrypt']) && !$errors)
{
echo '<b>Copy and pase this code in your "osds_config.php".</b><br><br>';
echo '<div style="border: solid 1px #000000;">';
	$str = "";
	$str.= "<?php\r\n";
	$str.= "\$CONFIG_KEY = \"$key\";\r\n";
	$str.= "\$CONFIG_MSSQL_CONNECT_SERVER = \"$encrypt_result1\";\r\n";
	$str.= "\$CONFIG_MSSQL_CONNECT_USER = \"$encrypt_result2\";\r\n";
	$str.= "\$CONFIG_MSSQL_CONNECT_PASSWORD = \"$encrypt_result3\";\r\n";
	$str.= "?>\r\n";


	highlight_string($str);
	echo '</div>';
	
	echo '<br>';

	echo '<br><br>';
	echo 'Save this file in: <br><br><strong>C:\Program Files\osdsv5\Data</strong> (32bit windows)<br><strong>C:\Program Files (x86)\osdsv5\Data</strong> (64bit windows)';

	



}

?>

</form>

            
            
      </div>
    </div>
    <?php include ('side.php'); ?>
  </div>
</div>
<!-- end content -->
</div>
<!--end container-->
</body>
</html>
