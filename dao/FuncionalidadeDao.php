<?php

class FuncionalidadeDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getFuncionalidades($busca=null) {
		$sql = "SELECT * 
				FROM tb_funcionalidade 				AS fld
				INNER JOIN tb_funcionalidade_perfil AS tfp ON tfp.cod_funcionalidade = fld.cod_funcionalidade
				INNER JOIN tb_modulo 				AS mdl ON mdl.cod_modulo = fld.cod_modulo";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0)
				return $select->fetchALL(PDO::FETCH_ASSOC);
			else
				return false;
		}
		else
			return false;
	}
}

?>