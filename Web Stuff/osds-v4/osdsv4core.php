<?php
// Start Session and object for all pages
// => I need to use ob_start for header location for some reason :(
// -----------------------------------
session_start();
ob_start();
// -----------------------------------
// Making OSDS less retard proof
// -----------------------------------
if (!extension_loaded('mssql'))
{
	echo 'ERROR! You didnt load the <b>php_mssql.dll</b> in the <b>php.ini</b> file!';
	die();
}

// -----------------------------------
// Create a class instance for all pages
// -----------------------------------
$db = new DbConnect();
$Config = new ConfigMagik( 'config.ini', true, true);

// -----------------------------------
// Include files
// -----------------------------------
include ("array_map.php"); // $array_map
include ("array_class.php"); // $array_class
include ("array_map_img.php"); // $array_map_img
include ("array_map_predefined.php"); // $array_map_pre
include ("array_country.php"); // $array_country
include ("array_level.php"); // $array_level
include ("array_reborn.php"); // $array_reborn
include ("array_guild_level.php"); // $array_guild_level

// -----------------------------------
// General Core Tasks
// => if($_POST) is set, becuz of errors
// -----------------------------------
if (isset($_POST['login']))
{
	if(empty($_REQUEST['accname']))
	{
			echo '<SCRIPT LANGUAGE="JavaScript">alert("You didnt enter a username.\nPlease try again.")</script>';
			echo "<script type='text/javascript'>window.location='login.php';</script>";
			die();
	}
	
	if(empty($_REQUEST['accpass']))
	{
			echo '<SCRIPT LANGUAGE="JavaScript">alert("You didnt enter a passowrd.\nPlease try again.")</script>';
			echo "<script type='text/javascript'>window.location='login.php';</script>";
			die();
	}

	if (isValid($_REQUEST["accname"]) == true && isValid($_REQUEST["accpass"]) == true)
	{
		login($_POST['accname'], $_POST['accpass']);
	} else {
		echo '<SCRIPT LANGUAGE="JavaScript">alert("Hack attempt detected!")</script>';
		echo "<script type='text/javascript'>window.location='login.php';</script>";
		die();
	}
}	


// -----------------------------------
// Lets see if we can compress the pages?
// -----------------------------------
if(!extension_loaded('zlib')){
	@ini_set('zlib.output_compression_level', 1);  
	@ob_start('ob_gzhandler'); 
}

// -----------------------------------
// Inbox System
// -----------------------------------
inbox();

// -----------------------------------
// Debug session
// ==> THIS IS FOR DEVELOPMENT ONLY !!!!!!!!
// -----------------------------------
$debug_session = false;
if ( $debug_session )
{
	echo '<div class="error msg"><b>DEBUG SESSION INFO</b><br>';
	foreach($_SESSION as $key=>$value)
	{
		echo "<b>Session:</b> " . $key . " - " . $value . "<br>";
	}
	echo "<b>Session ID:</b> " .session_id()."<br>";
	echo '</div>';
}

// -----------------------------------
// Auth & UserGroup System
// -----------------------------------
auth_user();
//auth_permissions();
//UserGroup();


// -----------------------------------
// Error System
// -----------------------------------
errorReporting();

// -----------------------------------
// CLASSES DO NOT EDIT !!!
// -----------------------------------
class DbConnect
{
	var $theQuery;
	var $link;
	
	function __construct()
	{
		$Config = new ConfigMagik( 'config.ini', true, true);
		
		$db_host = $Config->get( 'mssql_settings_host', 'GENERAL');
		$db_user = $Config->get( 'mssql_settings_user', 'GENERAL');
		$db_pass = $Config->get( 'mssql_settings_passw', 'GENERAL');
			
		$this->link = mssql_connect($db_host, $db_user, $db_pass);
		register_shutdown_function(array(&$this, 'close'));
	}

	function query($query)
	{
		$this->theQuery = $query;
		// run the query
		$result = mssql_query($query, $this->link);
		
		$Config = new ConfigMagik( 'config.ini', true, true);
		$mssql_query_log = $Config->get( 'mssql_settings_log', 'GENERAL');

		if ($mssql_query_log == 'true')
		{
			$this->mssql_log($query);
		}
		
		if (!$result)
		{
			$result = "<div class='error msg'><b>MSSQL ERROR:</b> " . mssql_get_last_message() . "</div>";
			$this->mssql_error_log($result, $query);
		}
		
		return $result;
	}

	function fetchArray($result)
	{
		return mssql_fetch_array($result);
	}
	
	function fetchRow($result)
	{
		return mssql_fetch_row($result);
	}

	function fetchNum($result)
	{
		return mssql_num_rows($result);
	}
	
	function close()
	{
		mssql_close($this->link);
	}

	function mssql_log($query)
	{
		$file_today = 'logs/mssql_query_log_' . date("m_d_y") . '.log';
	
		if (file_exists($file_today))
		{
			$_string  = "\n==============================================================================";
			$_string .= "\n URL: ". $_SERVER['REQUEST_URI'];
			$_string .= "\n Date: ". date( 'r' );
			$_string .= "\n User: ". $_SESSION['user_id'];
			$_string .= "\n IP Address: " . $_SERVER['REMOTE_ADDR'];
			$_string .= "\n Query: " . $query;
			$_string .= "\n==============================================================================";
	
			$fh = fopen( $file_today, "a" );
			fwrite( $fh, $_string, strlen( $_string ) );
			fclose( $fh );
			
		} else {
		
			// Create a new File
			$file_name_new = 'logs/mssql_query_log_' . date("m_d_y") . '.log';
			$nothing = "";
			$f = fopen( $file_name_new, "w" );
			fwrite( $f, $nothing );
			fclose( $f );
	
			$_string  = "\n==============================================================================";
			$_string .= "\n URL: ". $_SERVER['REQUEST_URI'];
			$_string .= "\n Date: ". date( 'r' );
			$_string .= "\n User: ". $_SESSION['user_id'];
			$_string .= "\n IP Address: " . $_SERVER['REMOTE_ADDR'];
			$_string .= "\n Query: " . $query;
			$_string .= "\n==============================================================================";
	
			$fh = fopen( $file_today, "a" );
			fwrite( $fh, $_string, strlen( $_string ) );
			fclose( $fh );
		}
	}
	
	function mssql_error_log($error, $query)
	{
		$file_today = 'logs/mssql_error_log_' . date("m_d_y") . '.log';
	
		if (file_exists($file_today))
		{
			$_string  = "\n==============================================================================";
			$_string .= "\n URL: ".  $_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'];
			$_string .= "\n Date: ". date( 'r' );
			$_string .= "\n User: ". $_SESSION['user_id'];
			$_string .= "\n IP Address: " . $_SERVER['REMOTE_ADDR'];
			$_string .= "\n Query: " . $query;
			$_string .= "\n Error: " . $error;
			$_string .= "\n==============================================================================";
	
			$fh = fopen( $file_today, "a" );
			fwrite( $fh, $_string, strlen( $_string ) );
			fclose( $fh );
			
		} else {
		
			// Create a new File
			$file_name_new = 'logs/mssql_query_log_' . date("m_d_y") . '.log';
			$nothing = "";
			$f = fopen( $file_name_new, "w" );
			fwrite( $f, $nothing );
			fclose( $f );
	
			$_string  = "\n==============================================================================";
			$_string .= "\n URL: ".  $_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'];
			$_string .= "\n Date: ". date( 'r' );
			$_string .= "\n User: ". $_SESSION['user_id'];
			$_string .= "\n IP Address: " . $_SERVER['REMOTE_ADDR'];
			$_string .= "\n Query: " . $query;
			$_string .= "\n Error: " . $error;
			$_string .= "\n==============================================================================";
	
			$fh = fopen( $file_today, "a" );
			fwrite( $fh, $_string, strlen( $_string ) );
			fclose( $fh );
		}
	
	}
	// end of db class
}

class ConfigMagik
{
	var $PATH             = null;
	var $VARS             = array();
	var $SYNCHRONIZE      = false;
	var $PROCESS_SECTIONS = true;
	var $PROTECTED_MODE   = true;
	var $ERRORS           = array();

	/**
	* @desc   Constructor of this class.
	* @param  string $path Path to ini-file to load at startup.
	* NOTE:   If the ini-file can not be found, it will try to generate a 
	*         new empty one at the location indicated by path passed to 
	*         constructor-method of this class.
	* @param  bool $synchronize TRUE for constant synchronisation of memory and file (disabled by default).
	* @param  bool $process_sections TRUE or FALSE to enable or disable sections in your ini-file (enabled by default).
	* @return void Returns nothing, like any other constructor-method ¦¬] .
	*/
	function ConfigMagik( $path=null, $synchronize=false, $process_sections=true){
		// check whether to enable processing-sections or not
		if ( isset( $process_sections)) $this->PROCESS_SECTIONS = $process_sections;
		// check whether to enable synchronisation or not
		if ( isset( $synchronize)) $this->SYNCHRONIZE = $synchronize;
		// if a path was passed and file exists, try to load it
		if ( $path!=null) {
			// set passed path as class-var
			$this->PATH = $path;
			if ( !is_file( $path)) {
				// conf-file seems not to exist, try to create an empty new one
				$fp_new = @fopen( $path, 'w', false);
				if ( !$fp_new) {
					$err = "ConfigMagik::ConfigMagik() - Could not create new config-file('$path'), error.";
					array_push( $this->ERRORS, $err);
					die( $err);
				}else{
					fclose( $fp_new);
				}
			}else{
				// try to load and parse ini-file at specified path
				$loaded = $this->load( $path);
				if ( !$loaded) exit();
			}
		}
	}

	/**
	* @desc					  Retrieves the value for a given key.
	* @param  string $key     Key or name of directive to set in current config.
	* @param  string $section Name of section to set key/value-pair therein.
	* NOTE:                   Section must only be specified when sections are used in your ini-file.
	* @return mixed           Returns the value or NULL on failure.
	* NOTE:                   An empty directive will always return an empty string.
	*                         Only when directive can not be found, NULL is returned.
	*/
	function get( $key=null, $section=null){
		// if section was passed, change the PROCESS_SECTION-switch (FIX: 11/08/2004 BennyZaminga)
		if ( $section) $this->PROCESS_SECTIONS = true;
		else           $this->PROCESS_SECTIONS = false;
		// get requested value
		if ( $this->PROCESS_SECTIONS) {
			$value = $this->VARS[$section][$key];
		}else{
			$value = $this->VARS[$key];
		}
		// if value was not found (false), return NULL (FIX: 11/08/2004 BennyZaminga)
		if ( $value===false) {
			return null;
		}
		// return found value 
		return $value;
	}

	/**
	* @desc   Sets the value for a given key (in given section, if any specified).
	* @param  string $key     Key or name of directive to set in current config.
	* @param  mixed  $value   Value of directive to set in current config.
	* @param  string $section Name of section to set key/value-pair therein.
	* NOTE:   Section must only be specified when sections are enabled in your ini-file.
	* @return bool            Returns TRUE on success, FALSE on failure.
	*/
	function set( $key, $value, $section=null){
		// when sections are enabled and user tries to genarate non-sectioned vars, 
		// throw an error, this is definitely not allowed.
		if ( $this->PROCESS_SECTIONS and !$section) {
			$err = "ConfigMagik::set() - Passed no section when in section-mode, nothing was set.";
			array_push( $this->ERRORS, $err);
			return false;
		}
		// check if section was passed
		if ( $section===true) $this->PROCESS_SECTIONS = true;
		// set key with given value in given section (if enabled)
		if ( $this->PROCESS_SECTIONS) {
			$this->VARS[$section][$key] = $value;
		}else{
			$this->VARS[$key]           = $value;
		}
		// synchronize memory with file when enabled
		if ( $this->SYNCHRONIZE) {
			$this->save();
		}
		return true;
	}
	
	/**
	 * @desc   Remove a directive (key and it's value) from current config.
	 * @param  string $key     Name of key to remove form current config.
	 * @param  string $section Optional name of section (if used).
	 * @return bool            Returns TRUE on success, FALSE on failure.
	 */
	function removeKey( $key, $section=null){
		// check if section was passed and it's valid
		if ( $section!=null){
			if ( in_array( $section, array_keys( $this->VARS))==false){
				$err = "ConfigMagik::removeKey() - Could not find section('$section'), nothing was removed.";
				array_push( $this->ERRORS, $err);
				return false;
			}
			// look if given key exists in given section
			if ( in_array( $key, array_keys( $this->VARS[$section]))===false) {
				$err = "ConfigMagik::removeKey() - Could not find key('$key'), nothing was removed.";
				array_push( $this->ERRORS, $err);
				return false;
			}
			// remove key from section
			$pos = array_search( $key, array_keys( $this->VARS[$section]), true);
			array_splice( $this->VARS[$section], $pos, 1);
			return true;
		}else{
			// look if given key exists
			if ( in_array( $key, array_keys( $this->VARS))===false) {
				$err = "ConfigMagik::removeKey() - Could not find key('$key'), nothing was removed.";
				array_push( $this->ERRORS, $err);
				return false;
			}
			// remove key (sections disabled)
			$pos = array_search( $key, array_keys( $this->VARS), true);
			array_splice( $this->VARS, $pos, 1);
			// synchronisation-stuff
			if ( $this->SYNCHRONIZE) $this->save();
			// return
			return true;
		}
	}
	
	/**
	 * @desc   Remove entire section from current config.
	 * @param  string $section Name of section to remove.
	 * @return bool            Returns TRUE on success, FALSE on failure.
	 */
	function removeSection( $section){
		// check if section exists
		if ( in_array( $section, array_keys( $this->VARS), true)===false) {
			$err = "ConfigMagik::removeSection() - Section('$section') could not be found, nothing removed.";
			array_push( $this->ERRORS, $err);
			return false;
		}
		// find position of $section in current config
		$pos = array_search( $section, array_keys( $this->VARS), true);
		// remove section from current config
		array_splice( $this->VARS, $pos, 1);
		// synchronisation-stuff
		if ( $this->SYNCHRONIZE) $this->save();
		// return
		return true;
	}

	/**
	* @desc   Loads and parses ini-file from filesystem.
	* @param  string $path Optional path to ini-file to load.
	* NOTE:   When not provided, path passed to constructor will be used.
	* @return bool Returns TRUE on success, FALSE on failure.
	*/
	function load( $path=null){
		// if path was specified, check if valid else abort
		if ( $path!=null and !is_file( $path)) {
			$err = "ConfigMagik::load() - Path('$path') is invalid, nothing loaded.";
			array_push( $this->ERRORS, $err);
			echo $err;
			return false;
		}elseif ( $path==null){
			// no path was specified, fall back to class-var
			$path = $this->PATH;
		}
		/* 
		 * PHP's own method is used for parsing the ini-file instead of own code. 
		 * It's robust enough ;-)
		 */
		$this->VARS = parse_ini_file( $path, $this->PROCESS_SECTIONS);
		return true;
	}

	/**
	* @desc   Writes ini-file to filesystem as file.
	* @param  string $path Optional path to write ini-file to.
	* NOTE:   When not provided, path passed to constructor will be used.
	* @return bool Returns TRUE on success, FALSE on failure.
	*/
	function save( $path=null){
		// if no path was specified, fall back to class-var
		if ( $path==null) $path = $this->PATH;

		$content  = "";
		
		// PROTECTED_MODE-prefix
		if ( $this->PROTECTED_MODE) {
			$content .= "<?PHP\n; /*\n; -- BEGIN PROTECTED_MODE\n";
		}
		
		// config-header
		$content .= "; Last modified: ".date('d M Y H:i s')."\n";
		
		// check if there are sections to process
		if ( $this->PROCESS_SECTIONS) {
			foreach ( $this->VARS as $key=>$elem) {
				$content .= "[".$key."]\n";
				foreach ( $elem as $key2=>$elem2) {
					$content .= $key2." = \"".$elem2."\"\n";
				}
			}
		}else{
			foreach ( $this->VARS as $key=>$elem) {
				$content .= $key." = \"".$elem."\"\n";
			}
		}
		
		// add PROTECTED_MODE-ending
		if ( $this->PROTECTED_MODE) {
			$content .= "\n; -- END PROTECTED_MODE\n; */\n?>\n";	
		}

		// write to file
		if ( !$handle = @fopen( $path, 'w')) {
			$err = "ConfigMagik::save() - Could not open file('$path') for writing, error.";
			array_push( $this->ERRORS, $err);
			return false;
		}
		if ( !fwrite( $handle, $content)) {
			$err = "ConfigMagik::save() - Could not write to open file('$path'), error.";
			array_push( $this->ERRORS, $err);
			return false;
		}else{
			// push a message onto error-stack
			$err = "ConfigMagik::save() - Sucessfully saved to file('$path').";
			array_push( $this->ERRORS, $err);
		}
		fclose( $handle);
		return true;
	}
	
	/**
	 * @desc   Renders this Object as formatted string (TEXT or HTML).
	 * @param  string $output_type Type of desired output. Can be 'TEXT' or 'HTML'.
	 * @return string Returns a formatted string according to chosen output-type.
	 */
	function toString( $output_type='TEXT'){
		// check requested output-type
		if ( strtoupper( $output_type)!=='TEXT' and strtoupper( $output_type)!=='HTML') {
			$err = "ConfigMagik::toString() - Unknown OutputType('$output_type') was requested, falling back to TEXT.";
			array_push( $this->ERRORS, $err);
			$output_type = 'TEXT';
		}
		if ( strtoupper( $output_type) === 'TEXT') {
			// render object as TEXT
			$out  = "";
			ob_start();
			print_r( $this->VARS);
			$out .= ob_get_clean();
			return $out;
		}elseif ( strtoupper( $output_type) === 'HTML'){
			// render object as HTML
			$out  = "<table style='background:#FFEECC;border:1px solid black;' width=60%>\n";
			if ( $this->PROCESS_SECTIONS){
				// render with sections
				$out .= "\t<tr><th style='border:1px solid white;'>Section</th><th style='border:1px solid white;'>Key</th><th style='border:1px solid white;'>Value</th></tr>\n";
				$sections = $this->listSections();
				$num_sections = 0;
				$num_keys     = 0;
				foreach ( $sections as $section){
					$out .= "\t<tr><td style='border:1px solid white;' colspan=3>$section</td></tr>\n";
					$keys = $this->listKeys( $section);
					foreach ( $keys as $key){
						$val  = $this->get( $key, $section);
						$out .= "\t<tr><td>&nbsp;</td><td style='border:1px solid maroon;'>$key</td><td style='border:1px solid brown;'>$val</td></tr>\n";
						$num_keys++;
					}
					$num_sections++;
				}
				// summary of table (with sections)
				$out .= "\t<tr><td style='border:1px solid white;' colspan=3 align=right><code>There are <b>$num_keys keys</b> in <b>$num_sections sections</b>.</code></td></tr>\n";
			}else{
				// render without sections
				$keys     = $this->listKeys();
				$num_keys = 0;
				$out .= "\t<tr><th style='border:1px solid white;'>Key</th><th style='border:1px solid white;'>Value</th></tr>\n";
				foreach ( $keys as $key){
					$val  = $this->get( $key);
					$out .= "\t<tr><td style='border:1px solid maroon;'>$key</td><td style='border:1px solid brown;'>$val</td></tr>\n";
					$num_keys++;
				}
				// summary of table (without sections)
				$out .= "\t<tr><td style='border:1px solid white;' colspan=2 align=right><code>There are <b>$num_keys keys</b>.</code></td></tr>\n";
			}
			
			// close table
			$out .= "</table>";
			return $out;
		}
	}
	
	/**
	 * @desc                   Lists all keys.
	 * @param  string $section Optional section (needed only when using sections).
	 * @return array           Returns a numeric array containing the keys as string.
	 */
	function listKeys( $section=null){
		// check if section was passed
		if ( $section!==null){
			// check if passed section exists
			$sections = $this->listSections();
			if ( in_array( $section, $sections)===false) {
				$err = "ConfigMagik::listKeys() - Section('$section') could not be found.";
				array_push( $this->ERRORS, $err);
				return false;
			}
			// list all keys in given section
			$list = array();
			$all  = array_keys( $this->VARS[$section]);
			foreach ( $all as $possible_key){
				if ( !is_array( $this->VARS[$possible_key])) {
					array_push( $list, $possible_key);
				}
			}
			return $list;
		}else{
			// list all keys (section-less)
			return array_keys( $this->VARS);
		}
	}
	
	/**
	 * @desc   List all sections (if any).
	 * @param  void
	 * @return array Returns a numeric array with all section-names as stings therein.
	 */
	function listSections(){
		$list = array();
		// separate sections from normal keys
		$all  = array_keys( $this->VARS);
		foreach ( $all as $possible_section){
			if ( is_array( $this->VARS[$possible_section])) {
				array_push( $list, $possible_section);
			}
		}
		return $list;
	}
}

// -----------------------------------
// FUNCTIONS DO NOT EDIT !!!
// -----------------------------------


function capitalFirstLetter($string)
{
	$capstring = ucfirst(strtolower($string));
	return $capstring;
}

function login($accname, $accpass)
{

	$db = new DbConnect();
	error_reporting(E_ALL);
	
	$result = $db->query('SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = "'.$accname.'" AND user_pwd = "'.md5($accpass).'" ');
	$getAcc = $db->fetchArray($result);
	$getAccNum = $db->fetchNum($result);
	
	if($getAccNum == '0')
	{
		session_destroy();
		echo '<SCRIPT LANGUAGE="JavaScript">alert("Username or password invalid!\nPlease try again.")</script>';
		echo "<script type='text/javascript'>window.location='login.php';</script>";
		die();
					
	} else {
		
		if($getAcc['user_admin'] == '1' or $getAcc['user_gm'] == '1')
		{
			$insert_login = $db->query('INSERT INTO osdsv4.dbo.user_login_log (user_id, ip_address, login_time, login_time_detail) VALUES ("'.$accname.'",  "'.getRealIpAddr().'", "'.date("M d - H:i").'", "'.time().'" )  ');
			$insert_session = $db->query('INSERT INTO osdsv4.dbo.user_sessions (session_id, session_ip_address, session_member_name, session_member_id, session_location, session_log_in_time, session_running_time) VALUES ("'.session_id() .'","'.getRealIpAddr().'","'.$getAcc['user_id'].'","'.$getAcc['user_no'].'","'.$_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'].'","'.time().'","'.time().'") ');
			
			if(!$insert_login)
			{
				die('MSSQL error: ' . mssql_get_last_message());
			}
			if(!$insert_session)
			{
				die('MSSQL error: ' . mssql_get_last_message());
			}
							
			$_SESSION['user_id'] = $getAcc['user_id'];
			$_SESSION['user_no'] = $getAcc['user_no'];
			
			
			// lets see if the account is GM or ADMIN
			if($getAcc['user_admin'] == '1')
			{
				$_SESSION['group'] = 'admin';				
			}
			
			if($getAcc['user_gm'] == '1')
			{
				$_SESSION['group'] = 'gm';
			}
			
			header('Location: index.php');
		} else {
			session_destroy();
			echo '<SCRIPT LANGUAGE="JavaScript">alert("Sorry, your account does not have admin or gm access.")</script>';
			echo "<script type='text/javascript'>window.location='login.php';</script>";
			die();
		}
	}
}

function auth_permissions()
{

	$db = new DbConnect();
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile = $parts[count($parts) - 1]; 

	
	$result = $db->query('SELECT * FROM osdsv4.dbo.user_permissions WHERE group_name = "'.$_SESSION['group'].'"  ');
	$getPermissions = $db->fetchArray($result);

	
	$array = array($getPermissions['key']);
	if (is_array($currentFile, $array))
	{
		echo "page is fine";
	} else {
	
		$_SESSION['error'] = array("You dont have access to this page.");
		//header("Location: ".$_SERVER['HTTP_REFERER']);
		//die();
	}
	


}

function UserGroup()
{	
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile = $parts[count($parts) - 1]; 

	if ($currentFile != 'login.php' && $currentFile != 'osdsv4core.php')
	{
		// this is very basic, but i hope to make this way better
		if ($_SESSION['group'] == '')
		{
			session_destroy();
			echo '<SCRIPT LANGUAGE="JavaScript">alert("Sorry, your session does not have access.")</script>';
			echo "<script type='text/javascript'>window.location='login.php';</script>";
			die();
		}
	}
}

function auth_user()
{
	$db = new DbConnect();
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile = $parts[count($parts) - 1]; 

	if ($currentFile != 'login.php' && $currentFile != 'osdsv4core.php')
	{
		if ($_SESSION['user_id'] == '')
		{
			session_destroy();
			echo '<SCRIPT LANGUAGE="JavaScript">alert("Sorry, your user_id is not in the session")</script>';
			echo "<script type='text/javascript'>window.location='login.php';</script>";
			die();
		} else {
			$update_session = $db->query('UPDATE osdsv4.dbo.user_sessions SET session_ip_address = "'.getRealIpAddr().'", session_location = "'.$_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'].'", session_running_time  = "'.time().'" WHERE session_id = "'.session_id() .'" ');
			
			if(!$update_session)
			{
				die('MSSQL error: ' . mssql_get_last_message());
			}
		}
	}												
}

function checkServer()
{
	error_reporting(0);
	$Config = new ConfigMagik( 'config.ini', true, true);
	
	$timeout = $Config->get( 'check_server_status_timeout', 'GENERAL');
	$port = $Config->get( 'check_server_status_port', 'GENERAL');
	$server = $Config->get( 'mssql_server_ip', 'GENERAL');
	
	$ping = fsockopen ($server, $port, $errno, $errstr, $timeout);
	$status = 0;

	if ($ping == 0) {
		fclose($ping);
		// offline
		$status = 0;
	} else {
		fclose($ping);
		// online
		$status = 1;
	}
	return $status;
}

function countPercent($num_amount, $num_total) 
{
	// ---------------------------------------------------------------------
	// count_percent
	// 
	// http://asadream.wordpress.com/tutorials/tutorial-php-calculating-a-percentage/
	// ---------------------------------------------------------------------

	$count1 = $num_amount / $num_total;
	$count2 = $count1 * 100;
	$count = number_format($count2, 0);
	return $count;
}

function createNewid($length, $characters)
{
	if ($characters == ''){ return ''; }
	$chars_length = strlen($characters)-1;
	
	mt_srand((double)microtime()*1000000);
	
	$newid = '';
	while(strlen($newid) < $length){
		$rand_char = mt_rand(0, $chars_length);
		$newid .= $characters[$rand_char];
	}
	
	return $newid;
}

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

function decodeIp($enc_ip)
{
	// ---------------------------------------------------------------------
// decode_ip
// Example: $decoded_ip = decode_ip(bin2hex($coded_ip));
// Thx to ItsNobody
// ---------------------------------------------------------------------

	$ip_pop = explode('.', chunk_split($enc_ip, 2, '.'));
	return hexdec($ip_pop[0]). '.' . hexdec($ip_pop[1]) . '.' . hexdec($ip_pop[2]) . '.' . hexdec($ip_pop[3]);
}

function getRealIpAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
		else {
			$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function isValid($input)
{
// ---------------------------------------------------------------------
// is_valid
// Example: if (isVvalid($_REQUEST["username"]) == true && isVvalid($_REQUEST["pass"]) == true)
// 		{
//			DO SOMETHING
//		}
// ---------------------------------------------------------------------

	$input = strtolower($input);
	
	if (str_word_count($input) > 1)
	{
		$loop = true;
		$input = explode(" ",$input);
	}
	
	$bad_strings = array("--","select","union","insert","update","like","delete","1=1","or");
	
	if ($loop == true)
	{
		foreach($input as $value)
		{
			if (in_array($value,$bad_strings))
			{
				return false;
			} else {
				return true;
			}
		}
	} else {
		if (in_array($input,$bad_strings))
		{
			return false;
		} else {
			return true;
		}
	}
}

function random_password($length, $characters='abcdefgh1234567890')
{
// ---------------------------------------------------------------------
// random_password
// Example: random_password(5,'abcd1234') => returns something like: '2b4d3'
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

function shortText($title)
{
// ---------------------------------------------------------------------
// shortTexrt
// Example:
//			if(strlen($title) > $maxlength){
//				echo shortText($title);
//			}else{
//				echo $title;
//			}
// ---------------------------------------------------------------------

	// if noting is set do
	$maxlength = 33;
	
	$title = $title." ";
	$title = substr($title, 0, $maxlength);
	$title = substr($title, 0, strrpos($title,' '));
	$title = $title."...";
	return $title;
}

function timeAgo($date)
{
// ---------------------------------------------------------------------
// timeago
// $date = "2009-03-04 17:45";
// $result = timeago($date); // 2 days ago
// ---------------------------------------------------------------------

	if(empty($date)) {
		return "No date provided";
	}
	
	$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths         = array("60","60","24","7","4.35","12","10");
	
	$now             = time();
	$unix_date        = strtotime($date);
	
	   // check validity of date
	if(empty($unix_date)) {    
		return "Bad date";
	}

	// is it future date or past date
	if($now > $unix_date) {    
		$difference     = $now - $unix_date;
		$tense         = "ago";
		
	} else {
		$difference     = $unix_date - $now;
		$tense         = "from now";
	}
	
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	
	$difference = round($difference);
	
	if($difference != 1) {
		$periods[$j].= "s";
	}
	
	return "<b>$difference</b> $periods[$j] {$tense}";
}

function updateServerStats()
{
	$file_name = "cache_server_stats.php";
	if(file_exists($file_name))
	{
		
		$handle = fopen($file_name, 'w+');
	
		if(!$handle)
		{
			echo '<div class="error msg">Couldnt open file <b>$file_name!</b></div>';
			echo '</article>';
			include "footer.php";
			die();
		}
		
		$db = new DbConnect();

			
		$query1 = $db->query('SELECT * FROM character.dbo.user_character');
		$stats1 = $db->fetchNum($query1);
		
		$query2 = $db->query('SELECT * FROM account.dbo.user_profile');
		$stats2 = $db->fetchNum($query2);

		$query3 = $db->query('SELECT * FROM account.dbo.user_profile WHERE login_flag = 1100 ');
		$stats3 = $db->fetchNum($query3);
		
		$query4 = $db->query('SELECT * FROM account.dbo.user_profile WHERE login_tag = "N" ');
		$stats4 = $db->fetchNum($query4);
		
		$query5 = $db->query('SELECT * FROM character.dbo.guild_info ');
		$stats5 = $db->fetchNum($query5);
		
		$query6 = $db->query('SELECT * FROM character.dbo.cm_bcd_item ');
		$stats6 = $db->fetchNum($query6);
		
		$query7 = $db->query('SELECT * FROM character.dbo.del_user_char_list ');
		$stats7 = $db->fetchNum($query7);
		
		$query8 = $db->query('SELECT * FROM character.dbo.siege_info ');
		$stats8 = $db->fetchNum($query8);
		
		$stats_time_now = date('Y-m-d H:i:s');
		
		$str = "";
		
		$str.= "<?php\r\n";
		$str.= "\$server_stats_time = \"$stats_time_now\";\r\n";
		$str.= "\$server_stats_total_characters = \"$stats1\";\r\n";
		$str.= "\$server_stats_total_accounts = \"$stats2\";\r\n";
		$str.= "\$server_stats_total_accounts_online = \"$stats3\";\r\n";
		$str.= "\$server_stats_total_banned = \"$stats4\";\r\n";
		$str.= "\$server_stats_total_guilds = \"$stats5\";\r\n";
		$str.= "\$server_stats_total_df = \"$stats6\";\r\n";
		$str.= "\$server_stats_total_del_char = \"$stats7\";\r\n";
		$str.= "\$server_stats_total_siege = \"$stats8\";\r\n";
		$str.= "?>\r\n";
		
		fwrite($handle, $str);
		fclose($handle);
		echo '<div class="success msg">Server stats have been updated!<br>Please refresh the page.</div>';
		
	}
	else
	{
		echo '<div class="error msg">File <b>$file_name</b> doesnt exists!</div>';
		echo '</article>';
		include "footer.php";
		die();
	}
}

function http_file_exists($url)
{
	$f = @fopen($url,"r");
	if($f)
	{
		fclose($f);
		return true;
	}
	return false;
} 

function getDkuNews()
{
	$remote_news = "http://www.dkunderground.org/osdsv4/remote/news.php";
	$valid_news = http_file_exists($remote_news);
	if($valid_news == false)
	{
		$_SESSION['error'] = array('Error Loading Dku News');
	} else {
		echo file_get_contents($remote_news);
	}
}

function printMessages()
{
	$types = array("success","error","warning","information");
	foreach($types as $type)
	{
		if(isset($_SESSION[$type]) && !empty($_SESSION[$type]) && is_array($_SESSION[$type])) 
		{
			foreach($_SESSION[$type] as $msg)
			{
				$shout = strtoupper($type);
				echo "<div class='" . $type . " msg'>" . $msg . "</div>";
			}
			
			unset($_SESSION[$type]);
		}
	}
}

function inbox()
{
	$db = new DbConnect();
	$Config = new ConfigMagik( 'config.ini', true, true);
	
	$inbox_system = $Config->get( 'inbox_settings', 'GENERAL');
	
	
	if($inbox_system == 'true')
	{
		// User must be logged in to have an inbox
		if (isset($_SESSION['user_id']))
		{
		
			$inbox_system_check = $Config->get( 'inbox_settings_check', 'GENERAL');
			
			// when does it need to check for messages?
			if ($inbox_system_check == 'true')
			{
			
				$query = $db->query('SELECT * FROM account.dbo.inbox WHERE user_no = ' . $_SESSION['user_no'] . ' AND viewed = 0 ');
				$messages = $db->fetchNum($query);
				
				
				// are their any new messages ?
				if($messages > 0)
				{
					$_SESSION['information'] = array('You have <b>' . $messages . '</b> new unread message(s) ! <small style="float:right;"><a href="inbox.php">[ Read now ]</a></small>');
					
				}				
			}
		}
	}
}

function getDekaronVersion()
{
	$Config = new ConfigMagik( 'config.ini', true, true);
	$file_url = $Config->get( 'share_root', 'GENERAL') . "". DIRECTORY_SEPARATOR . "version.ini";

	$version_ini = file_get_contents($file_url);
	return $version_ini;
}

function getCurrentFileName()
{
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile2 = $parts[count($parts) - 1];
			
	return $currentFile2;

}

function fetch_script_name()
{
	$script_name = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_ENV['PHP_SELF'];
	
	preg_match( "/[^\/]+$/", $script_name, $matches );
	
	return $matches[0];
}
	
function errorReporting()
{
	// include config class
	$Config = new ConfigMagik( 'config.ini', true, true);
	
	$error_level = $Config->get( 'error_reporting', 'GENERAL');
	
	if($error_level == '1')
	{
		// Report simple running errors
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		ini_set('log_errors', '1');
		ini_set('error_log', 'logs/php_error_log_' . date("m_d_y-h_m_s") . '.log'); 

	}
	elseif ($error_level == '2')
	{
		// Reporting E_NOTICE can be good too (to report uninitialized
		// variables or catch variable name misspellings ...)
		error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		ini_set('log_errors', '1');
		ini_set('error_log', 'logs/php_error_log_' . date("m_d_y-h_m_s") . '.log'); 


	}
	elseif ($error_level == '3')
	{
		// Report all errors except E_NOTICE
		// This is the default value set in php.ini
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('log_errors', '1');
		ini_set('error_log', 'logs/php_error_log_' . date("m_d_y-h_m_s") . '.log'); 


	}
	elseif ($error_level == '4')
	{
		// Report all PHP errors (see changelog)
		error_reporting(E_ALL);
		ini_set('log_errors', '1');
		ini_set('error_log', 'logs/php_error_log_' . date("m_d_y-h_m_s") . '.log'); 

	}
	else
	{
		// Turn off all error reporting
		error_reporting(0);
	}

}

function format_bytes($size)
{
	$units = array(' B', ' KB', ' MB', ' GB', ' TB');
	for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
	return round($size, 2).$units[$i];
}

function create_empty_file($name)
{
	// Create a new File
	$file_name_new = 'cache/' . $name;
	$nothing = "";
	$f = fopen( $file_name_new, "w" );
	fwrite( $f, $nothing );
	fclose( $f );
}

function check_db($db_name)
{
	$db = new DbConnect();
	$check_for_db = $db->query('SELECT * FROM master.dbo.sysdatabases WHERE name = "' . $db_name . '" ');
	$dbs = $db->fetchNum($check_for_db);
	return $dbs;
}

?>