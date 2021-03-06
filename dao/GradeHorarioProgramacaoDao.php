<?php
class GradeHorarioProgramacaoDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getGradeHorarioProgramacoes($busca=null){
		$sql = "SELECT * 
				FROM tb_grade_horario_programacao 	as ghp
				INNER JOIN tb_dia_semana 			as tds on tds.cod_dia_semana = ghp.cod_dia_semana";
		
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
				/*$sql .= " WHERE hor_entrada LIKE '%$search%' OR hor_saida LIKE '%$search%' OR hor_entrada_intervalo LIKE '%$search%' OR 'hor_retorno_intervalo LIKE %$search%' ";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}*/
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