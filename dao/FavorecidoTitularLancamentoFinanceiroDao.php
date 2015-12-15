<?php
class FavorecidoTitularLancamentoFinanceiroDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveFavorecidoTitularLancamentoFinanceiro(FavorecidoTitularLancamentoFinanceiroTO $favTitLanFinTO) {
		if(!$favTitLanFinTO->cod_favorecido_fornecedor)
			$favTitLanFinTO->cod_favorecido_fornecedor = 'NULL';
		if(!$favTitLanFinTO->cod_favorecido_colaborador)
			$favTitLanFinTO->cod_favorecido_colaborador = 'NULL';
		if(!$favTitLanFinTO->cod_favorecido_terceiro)
			$favTitLanFinTO->cod_favorecido_terceiro = 'NULL';
		if(!$favTitLanFinTO->cod_titular_fornecedor)
			$favTitLanFinTO->cod_titular_fornecedor = 'NULL';
		if(!$favTitLanFinTO->cod_titular_colaborador)
			$favTitLanFinTO->cod_titular_colaborador = 'NULL';
		if(!$favTitLanFinTO->cod_titular_terceiro)
			$favTitLanFinTO->cod_titular_terceiro = 'NULL';
		if(!$favTitLanFinTO->cod_origem_correspondente)
			$favTitLanFinTO->cod_origem_correspondente = 'NULL';

		$sql = "INSERT INTO tb_favorecido_titular_lancamento_financeiro (cod_lancamento_financeiro, cod_favorecido_fornecedor, cod_favorecido_colaborador, cod_favorecido_terceiro, cod_titular_fornecedor, cod_titular_colaborador, cod_titular_terceiro, cod_origem_correspondente, vlr_correspondente, dsc_observacao_adicional) 
			VALUES (". $favTitLanFinTO->cod_lancamento_financeiro .", ". $favTitLanFinTO->cod_favorecido_fornecedor .", ". $favTitLanFinTO->cod_favorecido_colaborador .", ". $favTitLanFinTO->cod_favorecido_terceiro .", ". $favTitLanFinTO->cod_titular_fornecedor .", ". $favTitLanFinTO->cod_titular_colaborador .", ". $favTitLanFinTO->cod_titular_terceiro .", ". $favTitLanFinTO->cod_origem_correspondente .", ". $favTitLanFinTO->vlr_correspondente .", '". $favTitLanFinTO->dsc_observacao_adicional ."');";

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}

	public function getFavorecidosTitularesByCodLancamentoFinanceiro($busca=null){
		$sql = "SELECT 
					ftlf.*, 
					torg.dsc_origem,
					femp.nme_fantasia 		as nme_fantasia_favorecido, 
				    fcol.nme_colaborador 	as nme_colaborador_favorecido, 
				    fter.nme_terceiro 		as nme_terceiro_favorecido,
				    temp.nme_fantasia 		as nme_fantasia_titular, 
				    tcol.nme_colaborador 	as nme_colaborador_titular,
				    tter.nme_terceiro		as nme_terceiro_titular
				FROM tb_favorecido_titular_lancamento_financeiro 	AS ftlf
				LEFT JOIN tb_origem 								AS torg ON torg.cod_origem 		= ftlf.cod_origem_correspondente
				LEFT JOIN tb_empresa 								AS femp ON femp.cod_empresa 	= ftlf.cod_favorecido_fornecedor
				LEFT JOIN tb_colaborador							AS fcol ON fcol.cod_colaborador = ftlf.cod_favorecido_colaborador
				LEFT JOIN tb_terceiro 								AS fter ON fter.cod_terceiro 	= ftlf.cod_favorecido_terceiro
				LEFT JOIN tb_empresa 								AS temp ON temp.cod_empresa 	= ftlf.cod_titular_fornecedor
				LEFT JOIN tb_colaborador							AS tcol ON tcol.cod_colaborador = ftlf.cod_titular_colaborador
				LEFT JOIN tb_terceiro 								AS tter ON tter.cod_terceiro 	= ftlf.cod_titular_terceiro";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$sql .= " ORDER BY nme_fantasia_titular ASC, nme_colaborador_titular ASC, nme_terceiro_titular ASC";

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

	public function updateFavorecidoTitularLancamentoFinanceiro(FavorecidoTitularLancamentoFinanceiroTO $favTitLanFinTO) {
		if(!$favTitLanFinTO->cod_favorecido_fornecedor)
			$favTitLanFinTO->cod_favorecido_fornecedor = 'NULL';
		if(!$favTitLanFinTO->cod_favorecido_colaborador)
			$favTitLanFinTO->cod_favorecido_colaborador = 'NULL';
		if(!$favTitLanFinTO->cod_favorecido_terceiro)
			$favTitLanFinTO->cod_favorecido_terceiro = 'NULL';
		if(!$favTitLanFinTO->cod_titular_fornecedor)
			$favTitLanFinTO->cod_titular_fornecedor = 'NULL';
		if(!$favTitLanFinTO->cod_titular_colaborador)
			$favTitLanFinTO->cod_titular_colaborador = 'NULL';
		if(!$favTitLanFinTO->cod_titular_terceiro)
			$favTitLanFinTO->cod_titular_terceiro = 'NULL';
		if(!$favTitLanFinTO->cod_origem_correspondente)
			$favTitLanFinTO->cod_origem_correspondente = 'NULL';
		if(!$favTitLanFinTO->vlr_correspondente)
			$favTitLanFinTO->vlr_correspondente = 'NULL';

		$sql = "UPDATE tb_favorecido_titular_lancamento_financeiro
				SET cod_lancamento_financeiro = ". $favTitLanFinTO->cod_lancamento_financeiro .",
					cod_favorecido_fornecedor = ". $favTitLanFinTO->cod_favorecido_fornecedor .",
					cod_favorecido_colaborador = ". $favTitLanFinTO->cod_favorecido_colaborador .",
					cod_favorecido_terceiro = ". $favTitLanFinTO->cod_favorecido_terceiro .",
					cod_titular_fornecedor = ". $favTitLanFinTO->cod_titular_fornecedor .",
					cod_titular_colaborador = ". $favTitLanFinTO->cod_titular_colaborador .",
					cod_titular_terceiro = ". $favTitLanFinTO->cod_titular_terceiro .",
					cod_origem_correspondente =	". $favTitLanFinTO->cod_origem_correspondente .",
					vlr_correspondente = ". $favTitLanFinTO->vlr_correspondente .",
					dsc_observacao_adicional ='". $favTitLanFinTO->dsc_observacao_adicional ."'";
		
		if($favTitLanFinTO->cod_favorecido_lancamento_financeiro != "")
			$sql .= " WHERE cod_favorecido_lancamento_financeiro = ". $favTitLanFinTO->cod_favorecido_lancamento_financeiro;
		else if($favTitLanFinTO->cod_lancamento_financeiro != "")
			$sql .= " WHERE cod_lancamento_financeiro = ". $favTitLanFinTO->cod_lancamento_financeiro;

		//Flight::halt(500, $sql);die;

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}

	public function deleteFavorecidoTitularLancamentoFinanceiro(FavorecidoTitularLancamentoFinanceiroTO $favTitLanFinTO) {
		$sql = "UPDATE tb_favorecido_titular_lancamento_financeiro 
				SET flg_excluido = 1 
				WHERE cod_favorecido_lancamento_financeiro = ". $favTitLanFinTO->cod_favorecido_lancamento_financeiro;

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}
}