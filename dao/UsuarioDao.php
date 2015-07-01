<?php

class UsuarioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getUsuarios($busca=null){
		$sql = "SELECT DISTINCT 
					usu.cod_usuario, 
					usu.nme_usuario, 
					usu.nme_login, 
					per.cod_perfil, 
					per.nme_perfil, 
					usu.cod_colaborador, 
					emp.cod_empreendimento, 
					emp.nme_empreendimento
				FROM tb_usuario 						AS usu
				INNER JOIN tb_usuario_empreendimento 	AS tue ON tue.cod_usuario = usu.cod_usuario
				INNER JOIN tb_empreendimento 			AS emp ON emp.cod_empreendimento = tue.cod_empreendimento
				INNER JOIN tb_usuario_perfil 			AS tup ON tup.cod_usuario = usu.cod_usuario
				INNER JOIN tb_perfil 					AS per ON per.cod_perfil = tup.cod_perfil";
		
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
				$sql .= " WHERE nme_usuario LIKE '%$search%' OR nme_login LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
			}
			else if(count($busca) > 0) {
				if(isset($busca['nme_senha']))
					$busca['nme_senha'] = md5($busca['nme_senha']);

				$where = prepareWhere($busca);
				$sql .= " WHERE " . $where;
			}
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$result = parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');

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