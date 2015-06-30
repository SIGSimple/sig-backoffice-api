<?php

class FeriadoDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getFeriadosByMesEstadoCidade($num_mes, $cod_estado, $cod_cidade) {
		$sql = "SELECT fer.nme_feriado, fer.num_dia_feriado, ttf.nme_tipo_feriado
				FROM tb_feriado 			AS fer
				INNER JOIN tb_tipo_feriado 	AS ttf ON ttf.cod_tipo_feriado = fer.cod_tipo_feriado
				WHERE fer.num_mes_feriado = $num_mes
					AND (fer.cod_tipo_feriado = 1 
						OR (fer.cod_estado = $cod_estado AND fer.cod_cidade is null) 
				        OR (fer.cod_estado = $cod_estado AND fer.cod_cidade = $cod_cidade))";

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