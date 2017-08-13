<?php
namespace App\Core;

use PDO;
use App\Db;

abstract class Model
{
	protected $db;
	protected $table;
	
	function __construct()
	{
		/*$db_config = require(__DIR__ . "/../database.php");

		try {
			$this->db = new PDO(
				"mysql:host={$db_config["host"]};dbname={$db_config["database"]};charset=utf8",
				$db_config["user"],
				$db_config["password"]
			);
			var_dump($this->db);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}*/
		$this->db = self::getDB();
	}

	protected static function getDB()
	{
		static $db = null;

		if($db === null){
			//$db_config = require(__DIR__ . "/../database.php");
			try {
				$db = new PDO(
					"mysql:host=" . Db::DB_HOST . ";dbname=" . Db::DB_NAME . ";charset=utf8",
					Db::DB_USER,
					Db::DB_PASSWORD
				);
				//var_dump($db);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}

		return $db;
	}

	public function findAll()
	{
		$sql = "SELECT * FROM $this->table ORDER BY id DESC";

		$query = $this->db->query($sql);

		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function find($id)
	{
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$query = $this->db->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function findBy($field, $value)
	{
		$sql = "SELECT * FROM $this->table WHERE $field = :$value";
		$query = $this->db->prepare($sql);
		$query->bindParam(':$value', $value, PDO::PARAM_STR);
		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function query($sql)
	{
		$query = $this->db->query($sql);

		if($query->rowCount() > 1) return $query->fetchAll(PDO::FETCH_OBJ);
		elseif($query->rowCount() == 1) return $query->fetch(PDO::FETCH_OBJ);

		return false;
	}

}
