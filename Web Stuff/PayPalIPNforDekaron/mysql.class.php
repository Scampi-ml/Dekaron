<?php 
// If configuration not loaded, quit
if(!defined('MYSQL_HOST'))
	die;
/////////////////////////////////////////////
// CLASS: mysql
//   
// DESCRIPTION: a class used to connect to
//   and communicate with a mysql database
/////////////////////////////////////////////

class mysql
{
	private $queryCount = 0;	// count of processed queries
	private $conn;			// connection
	private $database;		// database name
	private $is_connected = false;	// Connection made to DB?
	private $query = '';		// query string
	private $q_start = 0;		// query start time
	private $q_finish = 0;		// query finish time
	private $q_time = 0;		// query time
	
	
	//////////////////////////////////////////////////
	// connect() : establishes a connection to
	//	mysql server
	//   
	// PARAMS \\
	//  in > $host : address of database
	//  in > $user : user name
	//  in > $pass : user password
	//  in > $db   : database name
	//  in > $stop : should the script stop if
	//               connect failes?
	//
	//  return : true if successful connection made
	//	     false if connection failed
	//////////////////////////////////////////////////
	public function connect($host='',$user='',$pass='',$db='',$stop=1)
	{
		// If no parameters passed in use defaults
		if(!$host)
		{
			$host=MYSQL_HOST;
			$user=MYSQL_USER;
			$pass=MYSQL_PASS;
			$db=MYSQL_DB;
		}
		
		$this->database = $db;
		
		if($stop) // if stop on fail
		{
			$this->conn = mysql_connect($host, $user, $pass);
			
			if($this->conn)
			{
				if(!mysql_select_db($db, $this->conn))
				{
					//global $err_string;
					//$err_string = 'ERROR : Can not select database \'$db\'';
					//include GLOBAL_DIR.'err.htm';  // Display error page 
					die; // return false
				}
			}
			
			$this->is_connected = true;
			$this->query("SET NAMES 'utf8'");
			return true;
		}
		else
		{
			$this->conn = @mysql_connect($host, $user, $pass);
			if($this->conn)
			{
				if(!mysql_select_db($db, $this->conn))
					return false;
				$this->is_connected = true;
				$this->query("SET NAMES 'utf8'");
				return true;
			}
			else
				return false;
		}		
	}
	
	
	//////////////////////////////////////////////////
	// query() : query the connected mysql database
	//   
	// PARAMS \\
	//  in > $query : string to send as query
	//  in > $err	: should we break on error?
	//
	//  return : query result if success
	//	     false if query failed
	//////////////////////////////////////////////////
	public function query($query, $err=1)
	{
		if(!$this->isConnected())
			$this->connect();
		
		//$this->startQuery($query);
		$r = mysql_query($query, $this->conn);
		//$this->finishQuery();
		
		if(!$r)
		{
			if($err)
			{	
				die($this->error($query, mysql_error()));	
			}
			else
			{
				echo $this->error(mysql_error());
				return false;
			}
		}
		
		$this->queryCount++;
		return $r;
	}
	
	
	//////////////////////////////////////////////////
	// queryr() : query the connected mysql database
	//   
	// PARAMS \\
	//  in > $query : string to send as query
	//  in > $err	: should we break on error?
	//
	//  return : query result if success
	//	     false if query failed, or numrows = 0
	//////////////////////////////////////////////////
	public function queryr($query, $err=1)
	{
		if(!$this->isConnected())
			$this->connect();
		
		$this->startQuery($query);
		$r = mysql_query($query, $this->conn);
		$this->finishQuery();
		
		if(!$r)
		{
			if($err)
			{	
				die($this->error($query, mysql_error()));	
			}
			else
			{
				echo $this->error(mysql_error());
				return false;
			}
		}
		
		$this->queryCount++;
		
		return (mysql_num_rows($r)==0) ? false : $r;
	}
	
	
	//////////////////////////////////////////////////
	// queryz() : query the connected mysql database
	//   
	// PARAMS \\
	//  in > $query : string to send as query
	//  in > $err	: should we break on error?
	//
	//  return : query result if success
	//	     false if query failed or no affected
	//////////////////////////////////////////////////
	public function queryz($query, $err=1)
	{
		if(!$this->isConnected())
			$this->connect();
		
		$this->startQuery($query);
		$r = mysql_query($query, $this->conn);
		$this->finishQuery();
		
		if(!$r)
		{
			if($err)
			{	
				die($this->error($query, mysql_error()));	
			}
			else
			{
				echo $this->error(mysql_error());
				return false;
			}
		}
		
		$this->queryCount++;
		$r=mysql_affected_rows($r);
		return ($r==0) ? false : $r;
	}
	
	
	//////////////////////////////////////////////////
	// GENERAL USE MYSQL FUNCTIONS
	//////////////////////////////////////////////////
	
	public function esc($r)
	{
		if(!$this->isConnected())
			$this->connect();
		return mysql_real_escape_string($r, $this->conn);
	}
	
	public function result($r)
	{
		return mysql_result($r,0);	
	}
	
	public function num_rows($r)
	{
		return mysql_num_rows($r);	
	}
	
	public function fetch_row($r)
	{
		return mysql_fetch_row($r);	
	}
	
	public function fetch_object($r)
	{
		return mysql_fetch_object($r);	
	}
	
	public function fetch_assoc($r)
	{
		return mysql_fetch_assoc($r);	
	}
	
	public function insert_id()
	{
		return mysql_insert_id($this->conn);	
	}
	
	private function error($err)
	{
		//global $auth;
		//if($auth->lvl >= UL_ADMIN)
			return "<p style='color:#ce0000'><em>MySQL Error</em></p>".$error.mysql_errno($this->conn).' '.mysql_error($this->conn);
		//return "<p style='color:#ce0000'><em>MySQL Error</em></p>Please report error to administrator.";
	}
	
	private function startQuery($query)
	{
		$this->query = $query;
		$this->q_start = getMicroTime();
		$this->q_time = 0;
		
	}
	
	private function finishQuery()
	{
		if(!$this->query)
			return;
		
		$this->q_finish = getMicrotime();
		
		$elapsed_time = $this->q_finish - $this->q_start;
		$this->q_time += $elapsed_time;
		
		if($log_slow_queries && $slow_query_time > 0)
		{
			$buff = '';
			
			if(!file_exists(MYSQL_SLOW_QUERY_LOG))
				$buff = '<?php exit();?>'."\n";
			
			$buff .= sprintf("%s\t%s\t\n\t%0.6f sec\n\n", date("Y-m-h H:i"), $this->query, $elapsed_time);
			
			if($file = fopen(MYSQL_SLOW_QUERY_LOG, 'a'))
			{
				fwrite($file, $buff);
				fclose($file);
			}
		}
		else
			$this->query=null;
	}
	
	public function isConnected() {
		return $this->is_connected?true:false;
	}
	
	public function close()
	{
		if(!$this->isConnected())
			return;
		mysql_close($this->conn);
	}
};

?>
