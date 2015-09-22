<?php

class TelefoneDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveTelefone(TelefoneTO $telefoneTO) {
		$sql = "INSERT INTO tb_telefone (cod_colaborador, num_ddd, num_telefone, cod_tipo_telefone) 
				VALUES (:cod_colaborador, :num_ddd, :num_telefone, :cod_tipo_telefone);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':cod_colaborador', 		$telefoneTO->cod_colaborador,	PDO::PARAM_INT);
		$insert->bindValue(':num_ddd', 				$telefoneTO->num_ddd,	 		PDO::PARAM_STR);
		$insert->bindValue(':num_telefone', 		$telefoneTO->num_telefone,	 	PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_telefone', 	$telefoneTO->cod_tipo_telefone, PDO::PARAM_INT);

		return $insert->execute();
	}

	public function updateTelefone(TelefoneTO $telefoneTO) {
		$sql = "UPDATE tb_telefone
				SET num_ddd 			= :num_ddd,
					num_telefone 		= :num_telefone,
					cod_tipo_telefone 	= :cod_tipo_telefone
				WHERE cod_telefone = :cod_telefone;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_telefone', 		$telefoneTO->cod_telefone,	 	PDO::PARAM_INT);
		$insert->bindValue(':num_ddd', 				$telefoneTO->num_ddd,	 		PDO::PARAM_STR);
		$insert->bindValue(':num_telefone', 		$telefoneTO->num_telefone,	 	PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_telefone', 	$telefoneTO->cod_tipo_telefone,	PDO::PARAM_INT);

		return $insert->execute();
	}

	public function deleteTelefone($cod_telefone) {
		$sql = "DELETE FROM tb_telefone WHERE cod_telefone = :cod_telefone;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_telefone', $cod_telefone, PDO::PARAM_INT);

		return $insert->execute();
	}

	public function getTelefones($busca=null){
		$sql = "SELECT * 
				FROM tb_telefone AS tel
				INNER JOIN tb_tipo_telefone as ttt on ttt.cod_tipo_telefone = tel.cod_tipo_telefone";

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