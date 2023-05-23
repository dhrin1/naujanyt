<?php  
/**
 * 
 */
class Datahelper extends configuration
{
	
	public  function SQLCUD($sql, $param = [])
	{
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute($param);
		return $stmt;
	}

	public function SQLROWS($sql, $param = [])
	{
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute($param);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function SQLROW($sql, $param = [])
	{
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute($param);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
}

?>