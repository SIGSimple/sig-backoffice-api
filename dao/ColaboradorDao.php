<?php

class ColaboradorDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getColaboradores($busca=null){
		$sql = "SELECT 
					col.cod_colaborador, 
				    col.num_matricula, 
				    col.nme_colaborador, 
				    CAST(col.flg_portador_necessidades_especiais AS UNSIGNED) AS flg_portador_necessidades_especiais,
				    col.cod_empresa_contratante,
				    col.cod_contrato,
				    emp.nme_fantasia,
				    col.cod_contrato,
				    org.dsc_origem,
				    col.cod_regime_contratacao,
				    trc.dsc_regime_contratacao,
					col.cod_departamento,
				    dpt.nme_departamento,
				    col.flg_cm, 
				    col.cod_local_trabalho,
				    ltr.nme_local_trabalho,
				    col.cod_grade_horario,
				    grh.nme_grade_horario,
				    CAST(col.flg_ativo AS UNSIGNED) AS flg_ativo,
				    CAST(col.flg_trabalho_fim_semana AS UNSIGNED) AS flg_trabalho_fim_semana,
				    CAST(col.flg_trabalho_feriado AS UNSIGNED) AS flg_trabalho_feriado,
				    CAST(col.flg_ajusta_folha_ponto AS UNSIGNED) AS flg_ajusta_folha_ponto,
				    col.dta_admissao,
				    col.dta_demissao,
				    col.num_ctps,
				    col.num_serie_ctps,
				    col.cod_estado_ctps,
				    est_ctps.sgl_estado as sgl_estado_ctps,
				    est_ctps.nme_estado as nme_estado_ctps,
				    col.dta_emissao_ctps,
					col.num_rg,
					col.num_cpf,
				    col.num_pis,
				    col.num_titulo_eleitor,
				    col.num_zona_eleitoral,
				    col.num_secao_eleitoral,
				    col.num_reservista,
				    col.dsc_endereco,
				    col.num_endereco,
				    col.nme_bairro,
				    col.dsc_complemento,
				    cid_mor.nme_cidade as nme_cidade_moradia,
				    col.cod_cidade_moradia,
				    col.cod_estado_moradia,
				    est_mor.sgl_estado as sgl_estado_moradia,
				    est_mor.nme_estado as nme_estado_moradia,
				    col.cod_cidade_naturalidade,
				    col.cod_estado_naturalidade,
				    col.cod_estado_moradia,
				    col.num_cep,
				    col.dta_nascimento,
				    cid_nat.nme_cidade as nme_cidade_naturalidade,
				    est_nat.sgl_estado as sgl_estado_naturalidade,
				    est_nat.nme_estado as nme_estado_naturalidade,
				    col.num_cnh,
				    col.nme_categoria_cnh,
				    col.dta_validade_cnh,
				    col.flg_sexo,
				    col.cod_banco,
				    bnc.nme_banco,
				    col.num_agencia,
				    col.num_digito_agencia,
				    col.num_conta_corrente,
				    col.num_digito_conta_corrente,
					col.cod_sindicato,
				    sdc.nme_sindicato,
				    col.pth_arquivo_cnh,
				    col.pth_arquivo_rg,
				    col.pth_arquivo_foto,
				    col.pth_arquivo_cpf,
				    col.pth_arquivo_entidade,
				    col.pth_arquivo_curriculo,
				    col.pth_arquivo_reservista,
				    col.cod_entidade,
				    ent.nme_entidade,
				    col.num_entidade,
				    col.qtd_horas_contratadas,
				    CAST(col.flg_hora_extra AS UNSIGNED) AS flg_hora_extra,
				    CAST(col.flg_ensino_superior AS UNSIGNED) AS flg_ensino_superior,
				    vfm.nme_funcao as nme_funcao_medicao,
				    vfc.nme_funcao as nme_funcao_clt,
				    vfc.vlr_salario as vlr_slario_clt

				FROM tb_colaborador 			AS col
				LEFT JOIN tb_empresa 			AS emp 			ON emp.cod_empresa 						= col.cod_empresa_contratante
				LEFT JOIN tb_origem 			AS org			ON org.cod_origem 						= col.cod_contrato
				LEFT JOIN tb_regime_contratacao AS trc 			ON trc.cod_regime_contratacao 			= col.cod_regime_contratacao
				LEFT JOIN tb_departamento 		AS dpt			ON dpt.cod_departamento 				= col.cod_departamento
				LEFT JOIN tb_local_trabalho   	AS ltr 			ON ltr.cod_local_trabalho 				= col.cod_local_trabalho
				LEFT JOIN tb_grade_horario		AS grh 			ON grh.cod_grade_horario				= col.cod_grade_horario
				LEFT JOIN tb_estado				AS est_ctps	 	ON est_ctps.cod_estado 					= col.cod_estado_ctps
				LEFT JOIN tb_cidade				AS cid_mor 		ON cid_mor.cod_cidade					= col.cod_cidade_moradia
				LEFT JOIN tb_estado				AS est_mor  	ON est_mor.cod_estado					= col.cod_estado_moradia
				LEFT JOIN tb_cidade				AS cid_nat		ON cid_nat.cod_cidade					= col.cod_cidade_naturalidade
				LEFT JOIN tb_estado				AS est_nat		ON est_nat.cod_estado					= col.cod_estado_naturalidade
				LEFT JOIN tb_banco				AS bnc			ON bnc.cod_banco						= col.cod_banco
				LEFT JOIN tb_sindicato			AS sdc			ON sdc.cod_sindicato					= col.cod_sindicato
				LEFT JOIN tb_entidade			AS ent			ON ent.cod_entidade						= col.cod_entidade
				LEFT JOIN vw_funcao_medicao 	as vfm 			ON vfm.cod_colaborador					= col.cod_colaborador
				LEFT JOIN vw_funcao_clt 		as vfc 			ON vfc.cod_colaborador					= col.cod_colaborador";

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
				$sql .= " WHERE nme_colaborador LIKE '%$search%' OR nme_fantasia LIKE '%$search%' OR nme_departamento LIKE '%$search%'";

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