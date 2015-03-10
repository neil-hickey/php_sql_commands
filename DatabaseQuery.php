<?php

class DatabaseQuery 
{
	/**
	 * Insert data into the database
	 *
	 * @param string $table The name of the table to insert data into
	 * @param array $fields An array of the fields to insert data into
	 * @param array $values An array of the values to be inserted
	 */
	function insert($table, $fields, $values) 
	{
		$fields = implode(", ", $fields);
		$values = implode("', '", $values);
		// useful link - http://www.w3schools.com/php/php_mysql_insert.asp
		$query = "INSERT INTO $table ($fields) VALUES ('', '$values')";

		if (!mysql_query($query)) {
			die('Error: ' . mysql_error());
		} 
		else {
			return TRUE;
		}
	}
	
	/**
	 * Update data in the database
	 *
	 * @param string $table The name of the table to insert data into
	 * @param array $fields An array of the fields to insert data into
	 * @param array $values An array of the values to be inserted
	 * @param string $id the ID of the row to update
	 */
	function update($table, $fields, $values, $id) 
	{
		// Combine $fields and $values into a single array
		$combine = array_combine($fields, $values);
		
		// Loop through new array create the MySQL SET value
		// useful link - http://www.w3schools.com/php/php_mysql_update.asp
		foreach ( $combine as $k => $v ) {
			$set .= $k . "=". $v . ", ";
		}
		
		// Remove the trailing comma.
		$set = substr($set, 0, -2);
		
		//Our now properly formed MySQL statement
		$query = "UPDATE $table SET $set WHERE ID = '" . $id . "'";

		if (!mysqli_query($query)) {
			die('Error: ' . mysql_error());
		} 
		else {
			return TRUE;
		}
	}
	
	/**
	 * Select data from the database
	 *
	 * Grabs the requested data from the database.
	 *
	 * @param string $table The name of the table to select data from
	 * @param string $columns The columns to return
	 * @param array $where The field(s) to search a specific value for
	 * @param array $equals The value being searched for
	 */
	function get($query) 
	{
		$resource = $this->select($query);
		
		// Loop through to grab the rows
		// useful link - http://www.w3schools.com/php/php_mysql_select.asp
		while($row[] = mysqli_fetch_assoc( $resource ));
		// delete last value
		array_pop($row);
		
		return $row;
	}

	function select($query) { return mysqli_query($query); }

}

?>
