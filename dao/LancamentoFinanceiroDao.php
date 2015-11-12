<?php
class LancamentoFinanceiroDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveLancamentoFinanceiro(LancamentoFinanceiroTO $lanFinTO) {
		if(!$lanFinTO->cod_conta_contabil)
			$lanFinTO->cod_conta_contabil = 'NULL';

		if(!$lanFinTO->cod_natureza_operacao)
			$lanFinTO->cod_natureza_operacao = 'NULL';

		if(!$lanFinTO->cod_origem_despesa)
			$lanFinTO->cod_origem_despesa = 'NULL';

		if(!$lanFinTO->dta_emissao)
			$lanFinTO->dta_emissao = 'NULL';
		else
			$lanFinTO->dta_emissao = "'". $lanFinTO->dta_emissao . "'";

		if(!$lanFinTO->dta_competencia)
			$lanFinTO->dta_competencia = 'NULL';
		else
			$lanFinTO->dta_competencia = "'". $lanFinTO->dta_competencia . "'";

		if(!$lanFinTO->dta_vencimento)
			$lanFinTO->dta_vencimento = 'NULL';
		else
			$lanFinTO->dta_vencimento = "'". $lanFinTO->dta_vencimento . "'";

		if(!$lanFinTO->dta_pagamento)
			$lanFinTO->dta_pagamento = 'NULL';
		else
			$lanFinTO->dta_pagamento = "'". $lanFinTO->dta_pagamento . "'";

		$sql = "INSERT INTO tb_lancamento_financeiro (num_nota_fatura, num_lancamento_contabil, num_documento_banco, dsc_lancamento, vlr_previsto, vlr_realizado, dta_emissao, dta_competencia, dta_vencimento, dta_pagamento, cod_natureza_operacao, cod_conta_contabil, cod_tipo_lancamento, cod_origem_despesa, dsc_observacao, flg_lancamento_aberto) 
			VALUES ('". $lanFinTO->num_nota_fatura ."', '". $lanFinTO->num_lancamento_contabil ."', '". $lanFinTO->num_documento_banco ."', '". $lanFinTO->dsc_lancamento ."', ". $lanFinTO->vlr_previsto .", ". $lanFinTO->vlr_realizado .", ". $lanFinTO->dta_emissao .", ". $lanFinTO->dta_competencia .", ". $lanFinTO->dta_vencimento .", ". $lanFinTO->dta_pagamento .", ". $lanFinTO->cod_natureza_operacao .", ". $lanFinTO->cod_conta_contabil .", ". $lanFinTO->cod_tipo_lancamento .", ". $lanFinTO->cod_origem_despesa .", '". $lanFinTO->dsc_observacao ."', ". $lanFinTO->flg_lancamento_aberto .");";

		//Flight::halt(500, $sql);die;

		$insert = $this->conn->prepare($sql);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function updateLancamentoFinanceiro(LancamentoFinanceiroTO $lanFinTO) {
		if(!$lanFinTO->cod_conta_contabil)
			$lanFinTO->cod_conta_contabil = 'NULL';

		if(!$lanFinTO->cod_natureza_operacao)
			$lanFinTO->cod_natureza_operacao = 'NULL';

		if(!$lanFinTO->cod_origem_despesa)
			$lanFinTO->cod_origem_despesa = 'NULL';

		if(!$lanFinTO->dta_emissao)
			$lanFinTO->dta_emissao = 'NULL';
		else
			$lanFinTO->dta_emissao = "'". $lanFinTO->dta_emissao . "'";

		if(!$lanFinTO->dta_competencia)
			$lanFinTO->dta_competencia = 'NULL';
		else
			$lanFinTO->dta_competencia = "'". $lanFinTO->dta_competencia . "'";

		if(!$lanFinTO->dta_vencimento)
			$lanFinTO->dta_vencimento = 'NULL';
		else
			$lanFinTO->dta_vencimento = "'". $lanFinTO->dta_vencimento . "'";

		if(!$lanFinTO->dta_pagamento)
			$lanFinTO->dta_pagamento = 'NULL';
		else
			$lanFinTO->dta_pagamento = "'". $lanFinTO->dta_pagamento . "'";

		$sql = "UPDATE tb_lancamento_financeiro
				SET num_nota_fatura = '". 			$lanFinTO->num_nota_fatura ."',
					num_lancamento_contabil = '". 	$lanFinTO->num_lancamento_contabil ."',
					num_documento_banco = '". 		$lanFinTO->num_documento_banco ."',
					dsc_lancamento = '". 			$lanFinTO->dsc_lancamento ."',
					vlr_previsto = '". 				$lanFinTO->vlr_previsto ."',
					vlr_realizado = '". 			$lanFinTO->vlr_realizado ."',
					dta_emissao = ". 				$lanFinTO->dta_emissao .",
					dta_competencia = ". 			$lanFinTO->dta_competencia .",
					dta_vencimento = ". 			$lanFinTO->dta_vencimento .",
					dta_pagamento = ". 				$lanFinTO->dta_pagamento .",
					cod_natureza_operacao = ". 		$lanFinTO->cod_natureza_operacao .",
					cod_conta_contabil = ". 		$lanFinTO->cod_conta_contabil .",
					cod_tipo_lancamento = ". 		$lanFinTO->cod_tipo_lancamento .",
					cod_origem_despesa = ". 		$lanFinTO->cod_origem_despesa .",
					dsc_observacao = '". 			$lanFinTO->dsc_observacao ."',
					flg_lancamento_aberto = ". 		$lanFinTO->flg_lancamento_aberto ."
				WHERE cod_lancamento_financeiro = ". $lanFinTO->cod_lancamento_financeiro;

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}

	public function getLancamentosFinanceiros($busca=null){
		$sql = "SELECT 
					tlf.*, 
					ccb.num_item AS num_conta_contabil, 
					ccb.dsc_item AS dsc_conta_contabil, 
					nop.num_item AS num_natureza_operacao, 
					nop.dsc_item AS dsc_natureza_operacao,
					tor.dsc_origem
				FROM tb_lancamento_financeiro 	AS tlf
				LEFT JOIN tb_plano_conta 		AS ccb ON ccb.cod_item = tlf.cod_conta_contabil
				LEFT JOIN tb_plano_conta 		AS nop ON nop.cod_item = tlf.cod_natureza_operacao
				LEFT JOIN tb_origem				AS tor ON tor.cod_origem = tlf.cod_origem_despesa";
		
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
				$sql .= " WHERE dsc_lancamento LIKE '%$search%' OR dsc_conta_contabil LIKE '%$search%' OR dsc_natureza_operacao LIKE '%$search%'";

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

	public function deleteFavorecidoTitularLancamentoFinanceiro($cod_lancamento_financeiro, $cod_usuario) {
		$sql = "UPDATE tb_lancamento_financeiro 
				SET flg_excluido = 1, cod_usuario_ultima_atualizacao = ". $cod_usuario ."
				WHERE cod_lancamento_financeiro = ". $cod_lancamento_financeiro;

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}
}