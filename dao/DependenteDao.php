<?php

class DependenteDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function saveDependente(DependenteTO $depTO) {
		$sql = "INSERT INTO tb_dependente (cod_colaborador, cod_tipo_dependencia, nme_dependente, pth_documento, dta_nascimento, flg_plano_saude, cod_plano_saude, flg_deduz_irrf, flg_curso_superior) 
				VALUES (:cod_colaborador, :cod_tipo_dependencia, :nme_dependente, :pth_documento, :dta_nascimento, :flg_plano_saude, :cod_plano_saude, :flg_deduz_irrf, :flg_curso_superior);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':cod_colaborador', 		$depTO->cod_colaborador,		PDO::PARAM_INT);
		$insert->bindValue(':cod_tipo_dependencia', $depTO->cod_tipo_dependencia,	PDO::PARAM_INT);
		$insert->bindValue(':nme_dependente', 		$depTO->nme_dependente,	 		PDO::PARAM_STR);
		$insert->bindValue(':pth_documento', 		$depTO->pth_documento, 			PDO::PARAM_STR);
		$insert->bindValue(':dta_nascimento', 		$depTO->dta_nascimento, 		PDO::PARAM_STR);
		$insert->bindValue(':flg_plano_saude', 		$depTO->flg_plano_saude, 		PDO::PARAM_INT);
		$insert->bindValue(':cod_plano_saude', 		$depTO->cod_plano_saude, 		PDO::PARAM_INT);
		$insert->bindValue(':flg_deduz_irrf', 		$depTO->flg_deduz_irrf, 		PDO::PARAM_INT);
		$insert->bindValue(':flg_curso_superior', 	$depTO->flg_curso_superior, 	PDO::PARAM_INT);

		return $insert->execute();
	}

	public function updateDependente(DependenteTO $depTO) {
		if(!$depTO->pth_documento)
			$depTO->pth_documento = 'NULL';

		if(!$depTO->cod_plano_saude)
			$depTO->cod_plano_saude = 'NULL';

		$sql = "UPDATE tb_dependente
				SET cod_tipo_dependencia 	= ". $depTO->cod_tipo_dependencia .",
					nme_dependente 			= '". $depTO->nme_dependente ."',
					pth_documento 			= ". $depTO->pth_documento . ",
					dta_nascimento 			= '". $depTO->dta_nascimento ."',
					flg_plano_saude 		= ". $depTO->flg_plano_saude .",
					cod_plano_saude 		= ". $depTO->cod_plano_saude .",
					flg_deduz_irrf 			= ". $depTO->flg_deduz_irrf .",
					flg_curso_superior 		= ". $depTO->flg_curso_superior ."
				WHERE cod_dependente = ". $depTO->cod_dependente .";";

		$update = $this->conn->prepare($sql);

		return $update->execute();
	}

	public function deleteDependente($cod_dependente) {
		$sql = "DELETE FROM tb_dependente WHERE cod_dependente = :cod_dependente;";
		$delete = $this->conn->prepare($sql);
		$delete->bindValue(':cod_dependente', $cod_telefone, PDO::PARAM_INT);
		return $delete->execute();
	}

	public function getDependentes($busca=null){
		$sql = "SELECT 
					dep.cod_dependente,
					dep.cod_tipo_dependencia,
					ttd.nme_tipo_dependencia,
					dep.nme_dependente,
					dep.pth_documento,
					dep.dta_nascimento,
					dep.cod_plano_saude,
					tps.nme_plano_saude,
					CAST(dep.flg_plano_saude AS UNSIGNED) AS flg_plano_saude,
					CAST(dep.flg_deduz_irrf AS UNSIGNED) AS flg_deduz_irrf, 
					CAST(dep.flg_curso_superior AS UNSIGNED) AS flg_curso_superior
				FROM tb_dependente 				AS dep
				INNER JOIN tb_tipo_dependencia 	AS ttd ON ttd.cod_tipo_dependencia = dep.cod_tipo_dependencia
				LEFT JOIN tb_plano_saude 		AS tps ON tps.cod_plano_saude = dep.cod_plano_saude";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				return $select->fetchALL(PDO::FETCH_ASSOC);
			}
			else
				return false;
		}
		else
			return false;

	}
}

?>