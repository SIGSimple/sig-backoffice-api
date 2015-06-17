<?php

class ModuloDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getModulos() {
		$sql = "SELECT * FROM tb_modulo ORDER BY cod_modulo;";
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0)
				return $select->fetchAll(PDO::FETCH_ASSOC);
			else
				return false;
		}
		else
			return false;
	}
}

?>