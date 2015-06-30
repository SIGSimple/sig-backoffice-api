<?php
class FuncaoColaboradorDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getUltimaFuncao($cod_colaborador){
		$sql = "SELECT nme_funcao, vlr_salario, dta_alteracao
				FROM tb_alteracao_funcao_colaborador 	AS afc
				INNER JOIN tb_funcao 					AS fun ON fun.cod_funcao = afc.cod_funcao
				RIGHT JOIN tb_colaborador 				AS col ON col.cod_colaborador = afc.cod_colaborador
				WHERE col.cod_colaborador = $cod_colaborador
				ORDER BY dta_alteracao DESC
				LIMIT 1";

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount() > 0 && $select->rowCount() == 1) {
				return parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), "all")[0];
			}
			else
				return false;
		}
		else
			return false;

	}
}
?>