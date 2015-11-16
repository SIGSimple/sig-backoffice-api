<?php

class LancamentoFinanceiroController {
	public static function addLancamentoFinanceiro() {
		$lanFinTO = new LancamentoFinanceiroTO();
		$lanFinTO->cod_lancamento_financeiro 	= (isset($_POST['cod_lancamento_financeiro'])) ? $_POST['cod_lancamento_financeiro'] : '';
		$lanFinTO->num_nota_fatura 				= (isset($_POST['num_nota_fatura'])) ? $_POST['num_nota_fatura'] : '';
		$lanFinTO->num_lancamento_contabil 		= (isset($_POST['num_lancamento_contabil'])) ? $_POST['num_lancamento_contabil'] : '';
		$lanFinTO->num_documento_banco 			= (isset($_POST['num_documento_banco'])) ? $_POST['num_documento_banco'] : '';
		$lanFinTO->dsc_lancamento 				= (isset($_POST['dsc_lancamento'])) ? $_POST['dsc_lancamento'] : '';
		$lanFinTO->vlr_previsto 				= (isset($_POST['vlr_previsto'])) ? $_POST['vlr_previsto'] : '';
		$lanFinTO->vlr_realizado 				= (isset($_POST['vlr_realizado'])) ? $_POST['vlr_realizado'] : '';
		$lanFinTO->dta_emissao 					= (isset($_POST['dta_emissao'])) ? $_POST['dta_emissao'] : '';
		$lanFinTO->dta_competencia 				= (isset($_POST['dta_competencia'])) ? $_POST['dta_competencia'] : '';
		$lanFinTO->dta_vencimento 				= (isset($_POST['dta_vencimento'])) ? $_POST['dta_vencimento'] : '';
		$lanFinTO->dta_pagamento 				= (isset($_POST['dta_pagamento'])) ? $_POST['dta_pagamento'] : '';
		$lanFinTO->cod_natureza_operacao 		= (isset($_POST['cod_natureza_operacao'])) ? $_POST['cod_natureza_operacao'] : '';
		$lanFinTO->cod_conta_contabil 			= (isset($_POST['cod_conta_contabil'])) ? $_POST['cod_conta_contabil'] : '';
		$lanFinTO->cod_tipo_lancamento 			= (isset($_POST['cod_tipo_lancamento'])) ? $_POST['cod_tipo_lancamento'] : '';
		$lanFinTO->cod_origem_despesa 			= (isset($_POST['cod_origem_despesa'])) ? $_POST['cod_origem_despesa'] : '';
		$lanFinTO->dsc_observacao 				= (isset($_POST['dsc_observacao'])) ? $_POST['dsc_observacao'] : '';
		$lanFinTO->flg_lancamento_aberto 		= (isset($_POST['flg_lancamento_aberto'])) ? (int)$_POST['flg_lancamento_aberto'] : 0;
		$lanFinTO->cod_empreendimento 			= (isset($_POST['cod_empreendimento'])) ? (int)$_POST['cod_empreendimento'] : 0;

		// Validando os campos obrigatórios
		$validator = new DataValidator();

		/*$validator->set_msg('O número da Nota/Fatura é obrigatório')
				  ->set('num_nota_fatura', $colTO->num_nota_fatura)
				  ->is_required();*/

		if(!$validator->validate()){ // Se retornar false, significa que algum campo obrigatório não foi preenchido
			// Envia os campos não preenchidos com a respectiva mensagem de erro para o front-end
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		$lanFinDao = new LancamentoFinanceiroDao();
		if(!$lanFinTO->cod_lancamento_financeiro) {
			$statusCode = 201;
			$successMessage = 'Lançamento registrado com sucesso!';
			// Grava o lançamento financeiro
			$lanFinTO->cod_lancamento_financeiro = $lanFinDao->saveLancamentoFinanceiro($lanFinTO);
			if(!$lanFinTO->cod_lancamento_financeiro != '')
				Flight::halt(500, 'Erro ao registrar lançamento.');
		}
		else {
			$statusCode = 200;
			$successMessage = 'Lançamento atualizado com sucesso!';
			if(!$lanFinDao->updateLancamentoFinanceiro($lanFinTO))
				Flight::halt(500, 'Erro ao atualizar lançamento.');
		}

		if($lanFinTO->cod_lancamento_financeiro) { // Só se já tiver gravado o lançamento financeiro
			// Grava os favorecidos/titulares do movimento
			if($_POST['flg_lancamento_aberto'] === "true") { // Se o lançamento for rateado...
				$favorecidos = $_POST['favorecidos'];

				foreach ($favorecidos as $key => $favorecidoItem) {
					$favTitLanFinTO = new FavorecidoTitularLancamentoFinanceiroTO();
					$favTitLanFinTO->cod_favorecido_lancamento_financeiro 	= $favorecidoItem['cod_favorecido_lancamento_financeiro'];
					$favTitLanFinTO->cod_lancamento_financeiro 				= $lanFinTO->cod_lancamento_financeiro;
					$favTitLanFinTO->vlr_correspondente 					= $favorecidoItem['vlr_correspondente'];
					$favTitLanFinTO->dsc_observacao_adicional 				= $favorecidoItem['dsc_observacao_adicional'];
					$favTitLanFinTO->cod_origem_correspondente 				= $favorecidoItem['cod_origem_correspondente'];

					switch ($favorecidoItem['favorecido']['type']) {
						case 'empresas':
							$favTitLanFinTO->cod_favorecido_fornecedor 	= $favorecidoItem['favorecido']['data']['cod_empresa'];
							break;
						case 'colaboradores':
							$favTitLanFinTO->cod_favorecido_colaborador = $favorecidoItem['favorecido']['data']['cod_colaborador'];
							break;
						case 'terceiros':
							$favTitLanFinTO->cod_favorecido_terceiro 	= $favorecidoItem['favorecido']['data']['cod_terceiro'];
							break;
					}

					switch ($favorecidoItem['titularMovimento']['type']) {
						case 'empresas':
							$favTitLanFinTO->cod_titular_fornecedor 	= $favorecidoItem['titularMovimento']['data']['cod_empresa'];
							break;
						case 'colaboradores':
							$favTitLanFinTO->cod_titular_colaborador = $favorecidoItem['titularMovimento']['data']['cod_colaborador'];
							break;
						case 'terceiros':
							$favTitLanFinTO->cod_titular_terceiro 	= $favorecidoItem['titularMovimento']['data']['cod_terceiro'];
							break;
					}

					$favTitLanFinDAO = new FavorecidoTitularLancamentoFinanceiroDao();
					if(!$favTitLanFinTO->cod_favorecido_lancamento_financeiro) { // insert
						if(!$favTitLanFinDAO->saveFavorecidoTitularLancamentoFinanceiro($favTitLanFinTO)) {
							Flight::halt(500, 'Erro ao associar Favorecido/Titular do Movimento ao Lançamento');
						}
					}
					else if($favTitLanFinTO->cod_favorecido_lancamento_financeiro && $favorecidoItem['flg_removido'] == "false") { // update
						if(!$favTitLanFinDAO->updateFavorecidoTitularLancamentoFinanceiro($favTitLanFinTO)) {
							Flight::halt(500, 'Erro ao atualizar Favorecido/Titular do Movimento');
						}	
					}
					else if($favTitLanFinTO->cod_favorecido_lancamento_financeiro && $favorecidoItem['flg_removido'] == "true") { // delete
						if(!$favTitLanFinDAO->deleteFavorecidoTitularLancamentoFinanceiro($favTitLanFinTO)) {
							Flight::halt(500, 'Erro ao excluir Favorecido/Titular do Movimento!');
						}
					}
				}
			}
			else { // Se não...
				$favTitLanFinTO = new FavorecidoTitularLancamentoFinanceiroTO();
				$favTitLanFinTO->cod_lancamento_financeiro 	= $lanFinTO->cod_lancamento_financeiro;
				$favTitLanFinTO->vlr_correspondente 		= ($lanFinTO->vlr_realizado != "") ? $lanFinTO->vlr_realizado : $lanFinTO->vlr_previsto;
				$favTitLanFinTO->dsc_observacao_adicional 	= $lanFinTO->dsc_observacao;
				$favTitLanFinTO->cod_origem_correspondente 	= $lanFinTO->cod_origem_despesa;
				
				switch ($_POST['favorecido']['type']) {
					case 'empresas':
						$favTitLanFinTO->cod_favorecido_fornecedor 	= $_POST['favorecido']['data']['cod_empresa'];
						break;
					case 'colaboradores':
						$favTitLanFinTO->cod_favorecido_colaborador = $_POST['favorecido']['data']['cod_colaborador'];
						break;
					case 'terceiros':
						$favTitLanFinTO->cod_favorecido_terceiro 	= $_POST['favorecido']['data']['cod_terceiro'];
						break;
				}

				switch ($_POST['titularMovimento']['type']) {
					case 'empresas':
						$favTitLanFinTO->cod_titular_fornecedor 	=  $_POST['titularMovimento']['data']['cod_empresa'];
						break;
					case 'colaboradores':
						$favTitLanFinTO->cod_titular_colaborador = $_POST['titularMovimento']['data']['cod_colaborador'];
						break;
					case 'terceiros':
						$favTitLanFinTO->cod_titular_terceiro 	= $_POST['titularMovimento']['data']['cod_terceiro'];
						break;
				}

				$favTitLanFinDAO = new FavorecidoTitularLancamentoFinanceiroDao();
				if(!$favTitLanFinDAO->saveFavorecidoTitularLancamentoFinanceiro($favTitLanFinTO)) {
					Flight::halt(500, 'Erro ao associar Favorecido/Titular do Movimento ao Lançamento');
				}
			}
		}

		Flight::halt($statusCode, $successMessage);
	}

	public static function getLancamentosFinanceiros() {
		$dao = new LancamentoFinanceiroDao();
		$items = $dao->getLancamentosFinanceiros($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum lançamento encontrado.');
	}

	public static function getSaldoAnterior($dta_referencia) {
		$dao = new LancamentoFinanceiroDao();
		$items = $dao->getSaldoAnterior($dta_referencia);
		if($items)
			Flight::json($items[0]);
		else
			Flight::halt(404, 'Nenhum saldo anterior encontrado.');
	}

	public static function deleteLancamentoFinanceiro() {
		$colaboradorDao = new LancamentoFinanceiroDao();
		
		if($colaboradorDao->deleteLancamentoFinanceiro($_GET['cod_lancamento_financeiro'], $_GET['cod_usuario']))
			Flight::halt(200, 'Lançamento excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir lançamento! Contate o administrador do sistema.');
	}
}