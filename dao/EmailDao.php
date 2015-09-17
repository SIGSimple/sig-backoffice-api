<?php

class EmailDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveEmail(EmailTO $emailTO) {
		$sql = "INSERT INTO tb_email (cod_colaborador, end_email) 
				VALUES (:cod_colaborador, :end_email);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_colaborador', 	$emailTO->cod_colaborador,	PDO::PARAM_INT);
		$insert->bindValue(':end_email', 		$emailTO->end_email,	 	PDO::PARAM_STR);

		return $insert->execute();
	}

	public function updateEmail(EmailTO $emailTO) {
		$sql = "UPDATE tb_email
				SET end_email 	= :end_email
				WHERE cod_email = :cod_email;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_email', $emailTO->cod_email, PDO::PARAM_INT);
		$insert->bindValue(':end_email', 	$emailTO->end_email,	PDO::PARAM_STR);

		return $insert->execute();
	}

	public function deleteEmail($cod_email) {
		$sql = "DELETE FROM tb_email WHERE cod_email = :cod_email;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_email', $cod_email, PDO::PARAM_INT);

		return $insert->execute();
	}

	public function getEmailsMensagem() {
		$sql = "SELECT col.nme_colaborador, usu.nme_login, max(end_email) AS end_email
				FROM tb_email 		AS eml
				JOIN tb_colaborador AS col ON col.cod_colaborador = eml.cod_colaborador
				JOIN tb_usuario 	AS usu ON usu.cod_colaborador = col.cod_colaborador
				GROUP BY eml.cod_colaborador
				ORDER BY 1";

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