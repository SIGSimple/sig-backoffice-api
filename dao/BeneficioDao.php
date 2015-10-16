<?php
class BeneficioDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function updateBeneficio(BeneficioTO $benTO) {
		$sql = "UPDATE tb_beneficio
				SET cod_tipo_beneficio = :cod_tipo_beneficio,
					cod_referencia_beneficio = :cod_referencia_beneficio;
				WHERE cod_colaborador = :cod_colaborador;";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':cod_colaborador', 			$benTO->cod_colaborador,	 		PDO::PARAM_INT);
		$insert->bindValue(':cod_tipo_beneficio', 		$benTO->cod_tipo_beneficio,	 		PDO::PARAM_INT);
		$insert->bindValue(':cod_referencia_beneficio', $benTO->cod_referencia_beneficio, 	PDO::PARAM_INT);

		return $insert->execute();
	}

	public function saveBeneficio(BeneficioTO $benTO) {
		$sql = "INSERT INTO tb_beneficio (cod_colaborador, cod_tipo_beneficio, cod_referencia_beneficio)
				VALUES (:cod_colaborador, :cod_tipo_beneficio, :cod_referencia_beneficio);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':cod_colaborador', 			$benTO->cod_colaborador,	 		PDO::PARAM_INT);
		$insert->bindValue(':cod_tipo_beneficio', 		$benTO->cod_tipo_beneficio,	 		PDO::PARAM_INT);
		$insert->bindValue(':cod_referencia_beneficio', $benTO->cod_referencia_beneficio, 	PDO::PARAM_INT);

		return $insert->execute();
	}

	public function getBeneficiosColaborador($busca=null){
		$sql = "SELECT * 
				FROM tb_beneficio 						AS ben
				INNER JOIN tb_tipo_beneficio 			AS ttb ON ttb.cod_tipo_beneficio = ben.cod_tipo_beneficio
				INNER JOIN tb_origem_desconto_beneficio AS tod ON tod.cod_origem_desconto_beneficio = ttb.cod_origem_desconto
				LEFT JOIN tb_plano_saude 				AS tps ON tps.cod_plano_saude = ben.cod_referencia_beneficio
				left join tb_empresa					as tep on tep.cod_empresa = tps.cod_empresa";
		
		$nolimit = false;
		$limit = 5;
		$offset = 0;
		$order = "asc";
		$search = "";

		if(is_array($busca) && count($busca) > 0) {
			if(isset($busca['nolimit'])) {
				$nolimit = true;
				unset($busca['nolimit']);
			}

			if(isset($busca['limit'])) {
				$limit = $busca['limit'];
				unset($busca['limit']);
			}	

			if(isset($busca['offset'])) {
				$offset = $busca['offset'];
				unset($busca['offset']);
			}	

			if(isset($busca['order'])) {
				$order = $busca['order'];
				unset($busca['order']);
			}	

			if(isset($busca['search'])) {
				$search = $busca['search'];
				unset($busca['search']);
			}

			if($search != "") {
				$sql .= " WHERE nme_tipo_beneficio LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
			}
			else if(count($busca) > 0) {
				$where = prepareWhere($busca);
				$sql .= " WHERE " . $where;
			}
		}
		
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$result = $select->fetchALL(PDO::FETCH_ASSOC);

				if($order != "asc")
					$result = array_reverse($result);

				$sizeOfResult = count($result);

				if(!$nolimit)
					$result = array_slice($result, $offset, $limit);

				$data = array();
				$data['total'] 	= $sizeOfResult;
				$data['rows'] 	= $result;

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