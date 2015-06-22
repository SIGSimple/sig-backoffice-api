<?php

class EscalaHoraExtraSindicatoDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getEscalaHoraExtraSindicato($busca=null){
		$sql = "SELECT * 
				FROM tb_escala_hora_extra_sindicato AS ehe
				INNER JOIN tb_dia_semana 			AS tds ON tds.cod_dia_semana = ehe.cod_dia_semana";

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