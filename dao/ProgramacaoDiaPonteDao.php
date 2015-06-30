<?php

class ProgramacaoDiaPonteDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getProgramacoesDiaPonte($busca=null){
		$sql = "SELECT pdp.*
				FROM tb_programacao_dia_ponte 			AS pdp
				INNER JOIN tb_local_trabalho_dia_ponte 	AS ltd ON ltd.cod_programacao_dia_ponte = pdp.cod_programacao_dia_ponte
				INNER JOIN tb_colaborador 				AS col ON col.cod_local_trabalho = ltd.cod_local_trabalho";

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