<?php  
/**
	Created by: Alhdrin Gungon
	Date: 		February 24, 2020
	Status:     undifiend
 * 
 */
class configuration
{
	private $servername;
	private $databasename;
	private $username;
	private $password;

	protected function connect()
	{
		$this->servername = "localhost";
		$this->databasename = "naujanyt";
		$this->username = "root";
		$this->password = "";

		$server = $this->servername;
		$dbname = $this->databasename;
		$user   = $this->username;
		$pass   = $this->password;

		try {
			$dsn = "mysql:host=".$server.';dbname='.$dbname;
			$pdo = new PDO($dsn, $user, $pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			throw new PDOException("Error Processing Requests", $e->getMessage());
		}
		
	}
	

}

?>