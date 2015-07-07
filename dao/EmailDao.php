<?php

class EmailDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getEmails($busca=null){
		$sql = "SELECT * FROM tb_email";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				return $select->fetchALL(PDO::FETCH_ASSOC);
			}
			else
				return false;
		}
		else
			return false;

	}
}

?>