<?php

class EmpresaDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 
	
	public function getEmpresas() {
		$sql = "SELECT emp.*, cid.nme_cidade, est.sgl_estado, est.nme_estado 
				FROM tb_empresa as emp
				INNER JOIN tb_cidade as cid on cid.cod_cidade = emp.cod_cidade
				INNER JOIN tb_estado as est on est.cod_estado = emp.cod_estado";

		if(isset($_GET['limit']))
			$limit = $_GET['limit'];
		else
			$limit = 5;

		if(isset($_GET['offset']))
			$offset = $_GET['offset'];
		else
			$offset = 0;

		if(isset($_GET['order']))
			$order = $_GET['order'];
		else
			$order = "asc";

		if(isset($_GET['search']))
			$search = $_GET['search'];
		else
			$search = "";

		if($search != "")
			$sql .= " WHERE nme_razao_social LIKE '%$search%' OR nme_fantasia LIKE '%$search%'";


		$select = $this->conn->prepare($sql);		
		if($select->execute()){
			if($select->rowCount()>0) {
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