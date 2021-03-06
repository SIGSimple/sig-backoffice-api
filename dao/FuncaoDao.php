<?php
class FuncaoDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 


	public function saveFuncao(FuncaoTO $funcaoTO) {
		$sql = "INSERT INTO tb_funcao (num_funcao, nme_funcao, dsc_funcao, cod_empreendimento) 
				VALUES (:num_funcao, :nme_funcao, :dsc_funcao, :cod_empreendimento);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':num_funcao', 			$funcaoTO->num_funcao,	 		PDO::PARAM_STR);
		$insert->bindValue(':nme_funcao', 			$funcaoTO->nme_funcao,	 		PDO::PARAM_STR);
		$insert->bindValue(':dsc_funcao', 			$funcaoTO->dsc_funcao, 			PDO::PARAM_STR);
		$insert->bindValue(':cod_empreendimento', 	$funcaoTO->cod_empreendimento,	PDO::PARAM_INT);

		return $insert->execute();
	}

	public function getFuncoes($busca=null){
		$sql = "SELECT * FROM tb_funcao";
		
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
				$sql .= " WHERE nme_funcao LIKE '%$search%'";

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