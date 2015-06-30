<?php

class EmpreendimentoDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getEmpreendimentos(){
		$sql = "SELECT * FROM tb_empreendimento";


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
			$sql .= " WHERE nme_empreendimento LIKE '%$search%' OR num_empreendimento LIKE '%$search%'";



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