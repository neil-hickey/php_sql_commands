<?php
// Our database class
class Database
{
	/**
	 * Constructor - Connects to the database server and selects a database
	 *
	 */
	function __construct() 
	{
		$this->connect();
	}

	/**
	 * Connect to and select database
	 *
	 * @uses the constants defined in config_constants.php
	 */	
	function connect()
	{
		$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);

		if (!$connect) {
			die('Could not connect: ' . mysql_error());
		}

		$db_selected = mysql_select_db(DB_NAME, $link);

		if (!$db_selected) {
			die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
		}
	}	
}

// Instantiate our database class
$db = new Database();

?>
