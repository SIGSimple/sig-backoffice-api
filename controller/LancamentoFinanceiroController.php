<?php

class LancamentoFinanceiroController {
	public static function addLancamentoFinanceiro() {
		$lanFinTO = new LancamentoFinanceiroTO();
		$lanFinTO->cod_lancamento_financeiro 	= (isset($_POST['cod_lancamento_financeiro'])) ? $_POST['cod_lancamento_financeiro'] : '';
		$lanFinTO->num_nota_fatura 				= (isset($_POST['num_nota_fatura'])) ? $_POST['num_nota_fatura'] : '';
		$lanFinTO->num_lancamento_contabil 		= (isset($_POST['num_lancamento_contabil'])) ? $_POST['num_lancamento_contabil'] : '';
		$lanFinTO->num_documento_banco 			= (isset($_POST['num_documento_banco'])) ? $_POST['num_documento_banco'] : '';
		$lanFinTO->dsc_lancamento 				= (isset($_POST['dsc_lancamento'])) ? $_POST['dsc_lancamento'] : '';
		$lanFinTO->vlr_orcado 					= (isset($_POST['vlr_orcado'])) ? $_POST['vlr_orcado'] : '';
		$lanFinTO->vlr_previsto 				= (isset($_POST['vlr_previsto'])) ? $_POST['vlr_previsto'] : '';
		$lanFinTO->vlr_realizado 				= (isset($_POST['vlr_realizado'])) ? $_POST['vlr_realizado'] : '';
		$lanFinTO->vlr_juros 					= (isset($_POST['vlr_juros'])) ? $_POST['vlr_juros'] : '';
		$lanFinTO->vlr_desconto 				= (isset($_POST['vlr_desconto'])) ? $_POST['vlr_desconto'] : '';
		$lanFinTO->dta_emissao 					= (isset($_POST['dta_emissao'])) ? $_POST['dta_emissao'] : '';
		$lanFinTO->dta_competencia 				= (isset($_POST['dta_competencia'])) ? $_POST['dta_competencia'] : '';
		$lanFinTO->dta_vencimento 				= (isset($_POST['dta_vencimento'])) ? $_POST['dta_vencimento'] : '';
		$lanFinTO->dta_pagamento 				= (isset($_POST['dta_pagamento'])) ? $_POST['dta_pagamento'] : '';
		$lanFinTO->cod_natureza_operacao 		= (isset($_POST['cod_natureza_operacao'])) ? $_POST['cod_natureza_operacao'] : '';
		$lanFinTO->cod_conta_contabil 			= (isset($_POST['cod_conta_contabil'])) ? $_POST['cod_conta_contabil'] : '';
		$lanFinTO->cod_tipo_lancamento 			= (isset($_POST['cod_tipo_lancamento'])) ? $_POST['cod_tipo_lancamento'] : '';
		$lanFinTO->cod_origem_despesa 			= (isset($_POST['cod_origem_despesa'])) ? $_POST['cod_origem_despesa'] : '';
		$lanFinTO->dsc_observacao 				= (isset($_POST['dsc_observacao'])) ? $_POST['dsc_observacao'] : '';
		$lanFinTO->flg_lancamento_aberto 		= (isset($_POST['flg_lancamento_aberto'])) ? $_POST['flg_lancamento_aberto'] : "";
		
		$lanFinTO->flg_lancamento_recorrente 	= (isset($_POST['flg_lancamento_recorrente'])) ? $_POST['flg_lancamento_recorrente'] : "";
		
		$lanFinTO->cod_tipo_recorrencia 		= (isset($_POST['cod_tipo_recorrencia'])) ? $_POST['cod_tipo_recorrencia'] : "";
		
		$lanFinTO->qtd_dias_recorrencia 		= (isset($_POST['qtd_dias_recorrencia'])) ? $_POST['qtd_dias_recorrencia'] : "";
		$lanFinTO->qtd_parcelas 				= (isset($_POST['qtd_parcelas'])) ? $_POST['qtd_parcelas'] : "";
		$lanFinTO->cod_lancamento_pai 			= (isset($_POST['cod_lancamento_pai'])) ? $_POST['cod_lancamento_pai'] : "";

		$lanFinTO->cod_empreendimento 			= (isset($_POST['cod_empreendimento'])) ? (int)$_POST['cod_empreendimento'] : 0;

		if($lanFinTO->flg_lancamento_aberto === "true" || $lanFinTO->flg_lancamento_aberto === "1")
			$lanFinTO->flg_lancamento_aberto = 1;
		else
			$lanFinTO->flg_lancamento_aberto = 0;

		if($lanFinTO->flg_lancamento_recorrente === "true" || $lanFinTO->flg_lancamento_recorrente === "1")
			$lanFinTO->flg_lancamento_recorrente = 1;
		else
			$lanFinTO->flg_lancamento_recorrente = 0;

		// Validando os campos obrigatórios
		$validator = new DataValidator();

		$validator->set_msg('A data de emissão é obrigatória')
				  ->set('dta_emissao', $lanFinTO->dta_emissao)
				  ->is_required();

		$validator->set_msg('A descrição do lançamento é obrigatório')
				  ->set('dsc_lancamento', $lanFinTO->dsc_lancamento)
				  ->is_required();

		$validator->set_msg('A data de vencimento é obrigatória')
				  ->set('dta_vencimento', $lanFinTO->dta_vencimento)
				  ->is_required();

		/*$validator->set_msg('A natureza da operação é obrigatória')
				  ->set('cod_natureza_operacao', $lanFinTO->cod_natureza_operacao)
				  ->is_required();*/

		$validator->set_msg('O valor Orçado é obrigatório')
				  ->set('vlr_orcado', $lanFinTO->vlr_orcado)
				  ->is_required();

		if($lanFinTO->flg_lancamento_recorrente == 1) {
			$validator->set_msg('O tipo de recorrência é obrigatório')
					  ->set('cod_tipo_recorrencia', $lanFinTO->cod_tipo_recorrencia)
					  ->is_required();

			$validator->set_msg('A quantidade de parcelas é obrigatória')
					  ->set('qtd_parcelas', $lanFinTO->qtd_parcelas)
					  ->is_required();
		}

		$cod_favorecido = "";

		if(isset($_POST['favorecido'])) {
			switch ($_POST['favorecido']['type']) {
				case 'empresas':
					$cod_favorecido  	= $_POST['favorecido']['data']['cod_empresa'];
					break;
				case 'colaboradores':
					$cod_favorecido 	= $_POST['favorecido']['data']['cod_colaborador'];
					break;
				case 'terceiros':
					$cod_favorecido  	= $_POST['favorecido']['data']['cod_terceiro'];
					break;
			}

			$filtro = array(
				'nolimit'=>'1', 
				'tlf->num_nota_fatura' => $lanFinTO->num_nota_fatura,
				'(ftlf->cod_favorecido_fornecedor' => array(
					'exp' => "=". $cod_favorecido ." OR ftlf.cod_favorecido_colaborador=". $cod_favorecido ." OR ftlf.cod_favorecido_terceiro=". $cod_favorecido . ")"
				)
			);
			$lanFinDao = new LancamentoFinanceiroDao();
			$notasExistentes = $lanFinDao->getLancamentosFinanceiros($filtro)['rows'];

			if(count($notasExistentes) > 0) {
				$validator->set_msg('Já existe uma lançamento com o mesmo número de NF informado para este favorecido')
						  ->set('num_nota_fatura', $lanFinTO->num_nota_fatura)
						  ->set_custom_error();
			}
		}

		if(!$validator->validate()){ // Se retornar false, significa que algum campo obrigatório não foi preenchido
			// Envia os campos não preenchidos com a respectiva mensagem de erro para o front-end
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		LancamentoFinanceiroController::processSaveLancamentoFinanceiro($lanFinTO);
	}

	private static function processSaveLancamentoFinanceiro($lanFinTO, $cod_lancamento_pai=null, $num_parcela_processar=0, $statusCode=200, $successMessage="Lançamento registrado com sucesso!") {
		if((!$lanFinTO->flg_lancamento_recorrente) || (($lanFinTO->flg_lancamento_recorrente) && ($num_parcela_processar < (int)$lanFinTO->qtd_parcelas))) {
			$lanFinDao = new LancamentoFinanceiroDao();

			/*if(!$lanFinTO->cod_lancamento_financeiro && $lanFinTO->flg_lancamento_recorrente) { // É novo lançamento recorrente?
				if($num_parcela_processar == 0) { // É a primeira parcela?
					$lanFinTO->dsc_lancamento = $lanFinTO->dsc_lancamento ." (1/". $lanFinTO->qtd_parcelas .")";
				}
				else if($num_parcela_processar > 0) {
					$lanFinTO->dsc_lancamento = substr($lanFinTO->dsc_lancamento, 0, strlen($lanFinTO->dsc_lancamento)-6)	." (". ($num_parcela_processar+1) ."/". $lanFinTO->qtd_parcelas .")";
				}
			}*/

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
						$favTitLanFinTO->cod_favorecido_lancamento_financeiro 	= (isset($favorecidoItem['cod_favorecido_lancamento_financeiro'])) ? $favorecidoItem['cod_favorecido_lancamento_financeiro'] : null;
						$favTitLanFinTO->cod_lancamento_financeiro 				= $lanFinTO->cod_lancamento_financeiro;
						$favTitLanFinTO->vlr_correspondente 					= $favorecidoItem['vlr_correspondente'];
						$favTitLanFinTO->dsc_observacao_adicional 				= (isset($favorecidoItem['dsc_observacao_adicional'])) ? $favorecidoItem['dsc_observacao_adicional'] : "";
						$favTitLanFinTO->cod_origem_correspondente 				= (isset($favorecidoItem['cod_origem_correspondente'])) ? $favorecidoItem['cod_origem_correspondente'] : "";

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
								$favTitLanFinTO->cod_titular_colaborador 	= $favorecidoItem['titularMovimento']['data']['cod_colaborador'];
								break;
							case 'terceiros':
								$favTitLanFinTO->cod_titular_terceiro 		= $favorecidoItem['titularMovimento']['data']['cod_terceiro'];
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
					$favTitLanFinTO->cod_lancamento_financeiro 				= $lanFinTO->cod_lancamento_financeiro;
					$favTitLanFinTO->vlr_correspondente 					= ($lanFinTO->vlr_realizado != "") ? $lanFinTO->vlr_realizado : $lanFinTO->vlr_previsto;
					$favTitLanFinTO->dsc_observacao_adicional 				= $lanFinTO->dsc_observacao;
					$favTitLanFinTO->cod_origem_correspondente 				= $lanFinTO->cod_origem_despesa;
					
					if(isset($_POST['favorecido'])) {
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
					}

					if(isset($_POST['titularMovimento'])) {
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
					}

					$favTitLanFinDAO = new FavorecidoTitularLancamentoFinanceiroDao();
					if($statusCode == 201) { // insert
						if(!$favTitLanFinDAO->saveFavorecidoTitularLancamentoFinanceiro($favTitLanFinTO)) {
							Flight::halt(500, 'Erro ao associar Favorecido/Titular do Movimento ao Lançamento');
						}
					}
					else if($statusCode == 200) { // update
						if(!$favTitLanFinDAO->updateFavorecidoTitularLancamentoFinanceiro($favTitLanFinTO)) {
							Flight::halt(500, 'Erro ao atualizar Favorecido/Titular do Movimento');
						}	
					}
				}

				if($_POST['flg_lancamento_recorrente'] === "true" || $_POST['flg_lancamento_recorrente'] === "1") { // Se o lançamento for parcelado...
					$addMoreItems = true;

					if($statusCode == 201 && $cod_lancamento_pai == null && ($lanFinTO->cod_lancamento_pai == "" || $lanFinTO->cod_lancamento_pai == null || $lanFinTO->cod_lancamento_pai == "NULL")) // é um novo registro
						$cod_lancamento_pai = $lanFinTO->cod_lancamento_financeiro;
					else if($statusCode == 200) { // esta atualizando
						$addMoreItems = false;
						
						/*$cod_lancamento_pai = $lanFinTO->cod_lancamento_pai;
						if(!$cod_lancamento_pai)
							$cod_lancamento_pai = $lanFinTO->cod_lancamento_financeiro;

						$filtro = array('nolimit'=>'1', 'cod_lancamento_financeiro' => array('exp' => "=". $lanFinTO->cod_lancamento_financeiro ." OR cod_lancamento_pai=". $cod_lancamento_pai ." OR cod_lancamento_financeiro=". $cod_lancamento_pai));
						$itensAssociados = $lanFinDao->getLancamentosFinanceiros($filtro)['rows'];

						if((int)$lanFinTO->qtd_parcelas > count($itensAssociados)) { // se aumentou a quantidade de parcelas...
							foreach ($itensAssociados as $index => $value) {
								$lanFinDao->atualizaQtdParcelasLancamentoFinanceiro(
										$lanFinTO->qtd_parcelas, 
										$lanFinTO->vlr_orcado, 
										$lanFinTO->vlr_previsto, 
										$lanFinTO->vlr_realizado, 
										$value['cod_lancamento_financeiro']);
							}

							$lanFinTO->dta_vencimento = $itensAssociados[count($itensAssociados)-1]['dta_vencimento']; // pego a data de vencimento do último lançamento
							$num_parcela_processar = count($itensAssociados)-1;
						}
						else if((int)$lanFinTO->qtd_parcelas < count($itensAssociados)) { // se diminuiu a quantidade de parcelas
							$addMoreItems = false;
							
							foreach ($itensAssociados as $index => $value) {
								$lanFinDao->atualizaQtdParcelasLancamentoFinanceiro(
										$lanFinTO->qtd_parcelas, 
										$lanFinTO->vlr_orcado, 
										$lanFinTO->vlr_previsto, 
										$lanFinTO->vlr_realizado, 
										$value['cod_lancamento_financeiro']);
							}

							$countItemsToDelete = count($itensAssociados) - (int)$lanFinTO->qtd_parcelas;
							$countDelete = 0;
							for ($i=count($itensAssociados); $i > 0; $i--) { 
								if($countDelete < $countItemsToDelete) {
									$lanFinDao->deleteLancamentoFinanceiro($itensAssociados[$i-1]['cod_lancamento_financeiro'], null, 'NULL', false);
									$countDelete++;
								}
								else
									break;
							}
						}*/
					}

					if($addMoreItems) {
						$lanFinTO->cod_lancamento_financeiro = null;
						$lanFinTO->cod_lancamento_pai = $cod_lancamento_pai;
						$date = new DateTime(str_replace("'", "", $lanFinTO->dta_vencimento));
						$date->add(new DateInterval('P'. $lanFinTO->qtd_dias_recorrencia .'D'));
						$lanFinTO->dta_vencimento 			= $date->format('Y-m-d');
						$lanFinTO->dta_competencia 			= "";
						$lanFinTO->dta_emissao 				= "";
						$lanFinTO->dta_pagamento 			= "";
						$lanFinTO->num_nota_fatura  		= "";
						$lanFinTO->num_documento_banco  	= "";
						$lanFinTO->num_lancamento_contabil  = "";
						$lanFinTO->vlr_realizado 			= null;
						$lanFinTO->vlr_previsto 			= null;
						$lanFinTO->vlr_juros 				= null;
						$lanFinTO->vlr_desconto 			= null;

						$num_parcela_processar++;

						LancamentoFinanceiroController::processSaveLancamentoFinanceiro($lanFinTO, $cod_lancamento_pai, $num_parcela_processar, $statusCode, $successMessage);
					}
				}
			}
		}
		else
			Flight::halt($statusCode, $successMessage);
	}

	public static function confirmaPagamentoLancamentoFinanceiro() {
		$lanFinTO = new LancamentoFinanceiroTO();
		$lanFinTO->cod_lancamento_financeiro 	= (isset($_POST['cod_lancamento_financeiro'])) ? $_POST['cod_lancamento_financeiro'] : '';
		$lanFinTO->dsc_observacao 				= (isset($_POST['dsc_observacao'])) ? $_POST['dsc_observacao'] : '';
		$lanFinTO->vlr_realizado 				= (isset($_POST['vlr_realizado'])) ? $_POST['vlr_realizado'] : '';
		$lanFinTO->dta_pagamento 				= (isset($_POST['dta_pagamento'])) ? $_POST['dta_pagamento'] : '';

		// Validando os campos obrigatórios
		$validator = new DataValidator();

		$validator->set_msg('A data de pagamento é obrigatória')
				  ->set('dta_pagamento', $lanFinTO->dta_pagamento)
				  ->is_required();

		$validator->set_msg('O valor realizado é obrigatório')
				  ->set('vlr_realizado', $lanFinTO->vlr_realizado)
				  ->is_required();

		if(!$validator->validate()){ // Se retornar false, significa que algum campo obrigatório não foi preenchido
			// Envia os campos não preenchidos com a respectiva mensagem de erro para o front-end
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		$lanFinDao = new LancamentoFinanceiroDao();
		if(!$lanFinDao->confirmaPagamentoLancamentoFinanceiro($lanFinTO))
			Flight::halt(500, 'Erro ao confirmar pagamento.');

		Flight::halt(200, 'Pagamento confirmado com sucesso!');
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
		
		$_GET['deleteNextRecords'] = ($_GET['deleteNextRecords'] === "true") ? 1 : 0;

		if($colaboradorDao->deleteLancamentoFinanceiro($_GET['cod_lancamento_financeiro'], $_GET['cod_lancamento_pai'], $_GET['cod_usuario'], $_GET['deleteNextRecords']))
			Flight::halt(200, 'Lançamento excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir lançamento! Contate o administrador do sistema.');
	}
}