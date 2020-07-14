<?php

class DB {

	private $host = 'localhost';
	private $user = 'root';
	private $pwd = '';
	private $dbname = 'crud';
	private $con;

	public function connect() {

		try { 
		
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

		$this->con = new PDO($dsn, $this->user, $this->pwd);
		$this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) { 
			echo 'Connection error: ' . $e->getMessage();
		}

		return $this->con;
	}


}
?>