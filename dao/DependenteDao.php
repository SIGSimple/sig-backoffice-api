<?php

class DependenteDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getDependentes($busca=null){
		$sql = "SELECT 
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