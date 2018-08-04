<?php
class Link {
	public $mysqli;

	const DB_SERVER=DB_HOST;
	const DB_USER=DB_USER;
	const DB_PASSWORD=DB_PASSWORD;
	const DB_DB=DB_DB;
	
	private $dbh;

	
	public function __construct() {
		// Set DSN
		$this->mysqli=new mysqli(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD,self::DB_DB);
	}
	
	
}