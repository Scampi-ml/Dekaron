<?php
// If configuration not loaded, quit
if(!defined('MSSQL_HOST'))
	die;

// If server does not have the mssql extension enabled, quit
if(!extension_loaded('mssql'))
	die;

/////////////////////////////////////////////
// CLASS: mssql
//   
// DESCRIPTION: a class used to connect to
//   and communicate with a mssql database
//   with the mssql extension
/////////////////////////////////////////////
class mssql
{

	private $conn;
	private $db;
	private $is_connected = false;

	// connect() : connect to mssql server
	public function connect($host='', $user='', $pass='')
	{
		if(!$host)
		{
			$host = MSSQL_HOST;
			$user = MSSQL_USER;
			$pass = MSSQL_PASS;
		}

 		$this->conn = mssql_connect($host, $user, $pass);
		//if(!$conn)
		//	return error('ERROR : Cannot connect to MSSQL Server at '.$host);

		$this->db = mssql_select_db('account', $this->conn);
		//if(!$this->db)
		//	return error('ERROR : Cannot connect to MSSQL Database at '.$host);

		$this->is_connected = true;
		return true;
	}

	// query() : send a query to mssql server
	public function query($query)
	{
		if(!$this->isConnected())
			connect();

		$r = mssql_query($query);
		//if(!$r)
		//	error($query.' : '.mssql_get_last_message());
		return $r;
	}

	// use() : change the database context
	public function useDB($dbname)
	{
		if(!$this->isConnected())
			connect();
		$this->db = mssql_select_db($dbname, $this->conn);
		//if(!$this->db)
		//	error('ERROR : Cannot connect to MSSQL Database at '.$host);
	}

	// error() : prints an error message and quits
	public function error($err)
	{
		return "<p style='color:#ce0000'><em>$err</em></p>";
	}

	// isConnected() : returns true is connected to mssql, false if not
	public function isConnected()
	{
		return $this->is_connected;
	}

	public function get_last_message(){
		return mssql_get_last_message();
	}

	public function numrows($r){
		return mssql_num_rows($r);
	}

	public function numfields($r){
		return mssql_num_fields($r);
	}

	public function fetch_row($r){
		return mssql_fetch_row($r);
	}

	public function fetch_array($r){
		return mssql_fetch_array($r);
	}

	public function rows_affected($r){
		return mssql_rows_affected($r);
	}

};

?>