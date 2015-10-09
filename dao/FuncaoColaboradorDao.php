<?php
class FuncaoColaboradorDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveFuncaoColaborador(FuncaoColaboradorTO $funcaoColaboradorTO) {
		$sql = "INSERT INTO tb_alteracao_funcao_colaborador (cod_colaborador, cod_funcao, vlr_salario, cod_motivo_alteracao_funcao, dta_alteracao) 
				VALUES (:cod_colaborador, :cod_funcao, :vlr_salario, :cod_motivo_alteracao_funcao, :dta_alteracao);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':cod_colaborador', 						$funcaoColaboradorTO->cod_colaborador,						PDO::PARAM_INT);
		$insert->bindValue(':cod_funcao', 							$funcaoColaboradorTO->cod_funcao,	 						PDO::PARAM_INT);
		$insert->bindValue(':vlr_salario', 							$funcaoColaboradorTO->vlr_salario,	 						PDO::PARAM_STR);
		$insert->bindValue(':cod_motivo_alteracao_funcao', 			$funcaoColaboradorTO->cod_motivo_alteracao_funcao, 			PDO::PARAM_INT);
		$insert->bindValue(':dta_alteracao', 						$funcaoColaboradorTO->dta_alteracao, 						PDO::PARAM_STR);

		return $insert->execute();
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

	public function getFuncoesColaborador($cod_colaborador){		
		$sql = "SELECT
					afc.cod_alteracao_funcao,
					fun.cod_funcao,
					fun.num_funcao,
					fun.nme_funcao, 
    				afc.vlr_salario, 
    				afc.dta_alteracao,
    				maf.cod_motivo_alteracao_funcao,
    				maf.nme_motivo_alteracao_funcao
    				
				FROM tb_alteracao_funcao_colaborador 	AS afc
				INNER JOIN tb_funcao 					AS fun ON fun.cod_funcao = afc.cod_funcao
				INNER JOIN tb_colaborador 				AS col ON col.cod_colaborador = afc.cod_colaborador
				INNER JOIN tb_motivo_alteracao_funcao 	AS maf ON maf.cod_motivo_alteracao_funcao = afc.cod_motivo_alteracao_funcao
				WHERE col.cod_colaborador = $cod_colaborador";
				

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount() > 0) {
				return parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), "all");
			}
			else
				return false;
		}
		else
			return false;

	}
}
?>