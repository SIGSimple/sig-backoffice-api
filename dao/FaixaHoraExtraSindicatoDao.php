<?php

class FaixaHoraExtraSindicatoDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getFaixaHoraExtraSindicato($busca=null){
		$sql = "SELECT * 
				FROM tb_faixa_hora_extra_sindicato AS fhe";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$data = $select->fetchALL(PDO::FETCH_ASSOC);
				$data = parse_arr_values($data, "all");
				return $data;
			}
			else
				return false;
		}
		else
			return false;

	}
}

?>