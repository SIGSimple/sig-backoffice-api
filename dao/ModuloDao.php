<?php

class ModuloDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getModulos($busca=null) {
		$sql = "SELECT * FROM tb_modulo ";

		$limit = 5;
		$offset = 0;
		$order = "asc";
		$search = "";

		if(is_array($busca) && count($busca) > 0) {
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
				$sql .= " WHERE nme_modulo LIKE '%$search%' OR tlt_modulo LIKE '%$search%'";

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

		$sql .= " ORDER BY cod_modulo";

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0){
				$result = $select->fetchALL(PDO::FETCH_ASSOC);

				if($order != "asc")
					$result = array_reverse($result);

				$sizeOfResult = count($result);

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