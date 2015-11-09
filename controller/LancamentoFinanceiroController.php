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
			// Grava o lançamento financeiro
			$lanFinTO->cod_lancamento_financeiro = $lanFinDao->saveLancamentoFinanceiro($lanFinTO);

			if($lanFinTO->cod_lancamento_financeiro != '') {
				// Se o lançamento for rateado...
				if($_POST['abrirLancamento'] === "true") {
					// Do something else
				}
				else { // Se não...
					$favTitLanFinTO = new FavorecidoTitularLancamentoFinanceiroTO();
					$favTitLanFinTO->cod_lancamento_financeiro 	= $lanFinTO->cod_lancamento_financeiro;
					$favTitLanFinTO->vlr_correspondente 		= $lanFinTO->vlr_previsto;
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
							$favTitLanFinTO->cod_titular_fornecedor 	= $_POST['titularMovimento']['data']['cod_empresa'];
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

				Flight::halt(201, 'Lançamento registrado com sucesso!');
			}
			 else {
				Flight::halt(500, 'Erro ao registrar lançamento.');
			}
		}
		else {
			// Atualizar
		}
	}
}