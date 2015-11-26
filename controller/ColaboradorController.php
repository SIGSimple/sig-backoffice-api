<?php

class ColaboradorController {
	public static function addNewColaborador() {
		// Capturando os valores do front-end
		$colTO = new ColaboradorTO();
		$colTO->cod_colaborador 					= (isset($_POST['cod_colaborador'])) ? $_POST['cod_colaborador'] : "";
		$colTO->num_matricula 						= (isset($_POST['num_matricula'])) ? $_POST['num_matricula'] : "";
		$colTO->nme_colaborador 					= (isset($_POST['nme_colaborador'])) ? $_POST['nme_colaborador'] : "";
		$colTO->flg_portador_necessidades_especiais = (isset($_POST['flg_portador_necessidades_especiais'])) ? $_POST['flg_portador_necessidades_especiais'] : "";
		$colTO->cod_empresa_contratante 			= (isset($_POST['empresaContratante'])) ? $_POST['empresaContratante']['cod_empresa'] : "";
		$colTO->cod_contrato 						= (isset($_POST['contrato'])) ? $_POST['contrato']['cod_origem'] : "";
		$colTO->cod_regime_contratacao 				= (isset($_POST['cod_regime_contratacao'])) ? $_POST['cod_regime_contratacao'] : "";
		$colTO->cod_departamento 					= (isset($_POST['cod_departamento'])) ? $_POST['cod_departamento'] : "";
		$colTO->cod_estado_civil 					= (isset($_POST['cod_estado_civil'])) ? $_POST['cod_estado_civil'] : "";
		$colTO->flg_cm 								= (isset($_POST['flg_cm'])) ? $_POST['flg_cm'] : "";
		$colTO->cod_local_trabalho 					= (isset($_POST['localTrabalho'])) ? $_POST['localTrabalho']['cod_local_trabalho'] : "";
		$colTO->cod_grade_horario 					= (isset($_POST['gradeHorario'])) ? $_POST['gradeHorario']['cod_grade_horario'] : "";
		$colTO->flg_ativo 							= (isset($_POST['flg_ativo'])) ? $_POST['flg_ativo'] : "";
		$colTO->dta_admissao 						= (isset($_POST['dta_admissao'])) ? $_POST['dta_admissao'] : "";
		$colTO->dta_demissao 						= (isset($_POST['dta_demissao'])) ? $_POST['dta_demissao'] : "";
		$colTO->num_ctps 							= (isset($_POST['num_ctps'])) ? $_POST['num_ctps'] : "";
		$colTO->num_serie_ctps 						= (isset($_POST['num_serie_ctps'])) ? $_POST['num_serie_ctps'] : "";
		$colTO->cod_estado_ctps 					= (isset($_POST['cod_estado_ctps'])) ? $_POST['cod_estado_ctps'] : "";
		$colTO->dta_emissao_ctps 					= (isset($_POST['dta_emissao_ctps'])) ? $_POST['dta_emissao_ctps'] : "";
		$colTO->num_rg 								= (isset($_POST['num_rg'])) ? $_POST['num_rg'] : "";
		$colTO->num_cpf 							= (isset($_POST['num_cpf'])) ? $_POST['num_cpf'] : "";
		$colTO->num_pis 							= (isset($_POST['num_pis'])) ? $_POST['num_pis'] : "";
		$colTO->num_titulo_eleitor 					= (isset($_POST['num_titulo_eleitor'])) ? $_POST['num_titulo_eleitor'] : "";
		$colTO->num_zona_eleitoral 					= (isset($_POST['num_zona_eleitoral'])) ? $_POST['num_zona_eleitoral'] : "";
		$colTO->num_secao_eleitoral 				= (isset($_POST['num_secao_eleitoral'])) ? $_POST['num_secao_eleitoral'] : "";
		$colTO->num_reservista 						= (isset($_POST['num_reservista'])) ? $_POST['num_reservista'] : "";
		$colTO->dsc_endereco 						= (isset($_POST['dsc_endereco'])) ? $_POST['dsc_endereco'] : "";
		$colTO->num_endereco 						= (isset($_POST['num_endereco'])) ? $_POST['num_endereco'] : "";
		$colTO->nme_bairro 							= (isset($_POST['nme_bairro'])) ? $_POST['nme_bairro'] : "";
		$colTO->dsc_complemento 					= (isset($_POST['dsc_complemento'])) ? $_POST['dsc_complemento'] : "";
		$colTO->cod_cidade_moradia 					= (isset($_POST['cod_cidade_moradia'])) ? $_POST['cod_cidade_moradia'] : "";
		$colTO->cod_estado_moradia 					= (isset($_POST['cod_estado_moradia'])) ? $_POST['cod_estado_moradia'] : "";
		$colTO->num_cep 							= (isset($_POST['num_cep'])) ? $_POST['num_cep'] : "";
		$colTO->dta_nascimento 						= (isset($_POST['dta_nascimento'])) ? $_POST['dta_nascimento'] : "";
		$colTO->cod_cidade_naturalidade 			= (isset($_POST['cod_cidade_naturalidade'])) ? $_POST['cod_cidade_naturalidade'] : "";
		$colTO->cod_estado_naturalidade 			= (isset($_POST['cod_estado_naturalidade'])) ? $_POST['cod_estado_naturalidade'] : "";
		$colTO->num_cnh 							= (isset($_POST['num_cnh'])) ? $_POST['num_cnh'] : "";
		$colTO->nme_categoria_cnh 					= (isset($_POST['nme_categoria_cnh'])) ? $_POST['nme_categoria_cnh'] : "";
		$colTO->dta_validade_cnh 					= (isset($_POST['dta_validade_cnh'])) ? $_POST['dta_validade_cnh'] : "";
		$colTO->flg_sexo 							= (isset($_POST['flg_sexo'])) ? $_POST['flg_sexo'] : "";
		$colTO->cod_banco 							= (isset($_POST['banco'])) ? $_POST['banco']['cod_banco'] : "";
		$colTO->num_agencia 						= (isset($_POST['num_agencia'])) ? $_POST['num_agencia'] : "";
		$colTO->num_digito_agencia 					= (isset($_POST['num_digito_agencia'])) ? $_POST['num_digito_agencia'] : "";
		$colTO->num_conta_corrente 					= (isset($_POST['num_conta_corrente'])) ? $_POST['num_conta_corrente'] : "";
		$colTO->num_digito_conta_corrente 			= (isset($_POST['num_digito_conta_corrente'])) ? $_POST['num_digito_conta_corrente'] : "";
		$colTO->cod_sindicato 						= (isset($_POST['sindicato'])) ? $_POST['sindicato']['cod_sindicato'] : "";
		$colTO->cod_entidade 						= (isset($_POST['entidade'])) ? $_POST['entidade']['cod_entidade'] : "";
		$colTO->num_entidade 						= (isset($_POST['num_entidade'])) ? $_POST['num_entidade'] : "";
		$colTO->qtd_horas_contratadas 				= (isset($_POST['qtd_horas_contratadas'])) ? $_POST['qtd_horas_contratadas'] : "";
		$colTO->cod_empreendimento 					= (isset($_POST['cod_empreendimento'])) ? $_POST['cod_empreendimento'] : "";
		$colTO->flg_hora_extra 						= (isset($_POST['flg_hora_extra'])) ? $_POST['flg_hora_extra'] : "";
		$colTO->flg_trabalho_fim_semana 			= (isset($_POST['flg_trabalho_fim_semana'])) ? $_POST['flg_trabalho_fim_semana'] : "";
		$colTO->flg_trabalho_feriado 				= (isset($_POST['flg_trabalho_feriado'])) ? $_POST['flg_trabalho_feriado'] : "";
		$colTO->flg_ajusta_folha_ponto 				= (isset($_POST['flg_ajusta_folha_ponto'])) ? $_POST['flg_ajusta_folha_ponto'] : "";
		$colTO->flg_ensino_superior 				= (isset($_POST['flg_ensino_superior'])) ? $_POST['flg_ensino_superior'] : "";
		
		// ANEXOS
		/*$colTO->files = array();
		$colTO->files['file_foto'] 					= (isset($_POST['files']['file_foto'])) 				? $_POST['files']['file_foto'] : null;
		$colTO->files['file_rg'] 					= (isset($_POST['files']['file_rg'])) 					? $_POST['files']['file_rg'] : null;
		$colTO->files['file_cpf'] 					= (isset($_POST['files']['file_cpf'])) 					? $_POST['files']['file_cpf'] : null;
		$colTO->files['file_pis'] 					= (isset($_POST['files']['file_pis'])) 					? $_POST['files']['file_pis'] : null;
		$colTO->files['file_certidao'] 				= (isset($_POST['files']['file_certidao'])) 			? $_POST['files']['file_certidao'] : null;
		$colTO->files['file_cartao_sus'] 			= (isset($_POST['files']['file_cartao_sus'])) 			? $_POST['files']['file_cartao_sus'] : null;
		$colTO->files['file_comprovante_endereco'] 	= (isset($_POST['files']['file_comprovante_endereco'])) ? $_POST['files']['file_comprovante_endereco'] : null;
		$colTO->files['file_comprovante_bancario'] 	= (isset($_POST['files']['file_comprovante_bancario'])) ? $_POST['files']['file_comprovante_bancario'] : null;
		$colTO->files['file_contrato_trabalho'] 	= (isset($_POST['files']['file_contrato_trabalho'])) 	? $_POST['files']['file_contrato_trabalho'] : null;
		$colTO->files['file_diploma'] 				= (isset($_POST['files']['file_diploma'])) 				? $_POST['files']['file_diploma'] : null;
		$colTO->files['file_curriculo'] 			= (isset($_POST['files']['file_curriculo'])) 			? $_POST['files']['file_curriculo'] : null;
		$colTO->files['file_historico_escolar']		= (isset($_POST['files']['file_historico_escolar'])) 	? $_POST['files']['file_historico_escolar'] : null;
		$colTO->files['file_titulo_eleitor'] 		= (isset($_POST['files']['file_titulo_eleitor'])) 		? $_POST['files']['file_titulo_eleitor'] : null;
		$colTO->files['file_cnh'] 					= (isset($_POST['files']['file_cnh'])) 					? $_POST['files']['file_cnh'] : null;
		$colTO->files['file_reservista'] 			= (isset($_POST['files']['file_reservista'])) 			? $_POST['files']['file_reservista'] : null;*/

		// Arrays auxiliares de telefones e funções
		$telefones 		= (isset($_POST['telefones'])) ? $_POST['telefones'] : array();
		$funcoes 		= (isset($_POST['funcoes'])) ? $_POST['funcoes'] : array();
		$emails 		= (isset($_POST['emails'])) ? $_POST['emails'] : array();
		$dependentes 	= (isset($_POST['dependentes'])) ? $_POST['dependentes'] : array();

		// Plano de Saúde
		$beneficioTO = null;
		if(isset($_POST['planoSaude'])) {
			$beneficioTO = new BeneficioTO();
			$beneficioTO->cod_tipo_beneficio = 9; // ASSISTÊNCIA MÉDICA
			$beneficioTO->cod_referencia_beneficio = $_POST['planoSaude']['cod_plano_saude'];
		}

		// Validando os campos obrigatórios
		$validator = new DataValidator();

		$validator->set_msg('O número da Matrícula é obrigatório')
				  ->set('num_matricula', $colTO->num_matricula)
				  ->is_required();

		$validator->set_msg('O nome do Colaborador é obrigatório')
				  ->set('nme_colaborador', $colTO->nme_colaborador)
				  ->is_required();
		
		$validator->set_msg('O nome da Empresa é obrigatório')
				  ->set('empresaContratante', $colTO->cod_empresa_contratante)
				  ->is_required();

		$validator->set_msg('O Regime de Contratação é obrigatório')
				  ->set('cod_regime_contratacao', $colTO->cod_regime_contratacao)
				  ->is_required();

		$validator->set_msg('O Departamento é obrigatório')
				  ->set('cod_departamento', $colTO->cod_departamento)
				  ->is_required();

		$validator->set_msg('O Estado Civil é obrigatório')
				  ->set('cod_estado_civil', $colTO->cod_estado_civil)
				  ->is_required();

		$validator->set_msg('A data de Admissão é obrigatória')
				  ->set('dta_admissao', $colTO->dta_admissao)
				  ->is_required();

		$validator->set_msg('O número da CTPS é obrigatório')
				  ->set('num_ctps', $colTO->num_ctps)
				  ->is_required();

		$validator->set_msg('O número de série da CTPS é obrigatório')
				  ->set('num_serie_ctps', $colTO->num_serie_ctps)
				  ->is_required();

		$validator->set_msg('O estado da CTPS é obrigatório')
				  ->set('cod_estado_ctps', $colTO->cod_estado_ctps)
				  ->is_required();

		$validator->set_msg('A data de emissão da CTPS é obrigatória')
				  ->set('dta_emissao_ctps', $colTO->dta_emissao_ctps)
				  ->is_required();

		$validator->set_msg('O RG é obrigatório')
				  ->set('num_rg', $colTO->num_rg)
				  ->is_required();

		$validator->set_msg('O CPF é obrigatório')
				  ->set('num_cpf', $colTO->num_cpf)
				  ->is_required();

		$validator->set_msg('O PIS é obrigatório')
				  ->set('num_pis', $colTO->num_pis)
				  ->is_required();

		$validator->set_msg('O Titulo de Eleitor é obrigatório')
				  ->set('num_titulo_eleitor', $colTO->num_titulo_eleitor)
				  ->is_required();

		$validator->set_msg('A Zona Eleitoral é obrigatória')
				  ->set('num_zona_eleitoral', $colTO->num_zona_eleitoral)
				  ->is_required();

		$validator->set_msg('A Seção Eleitoral é obrigatória')
				  ->set('num_secao_eleitoral', $colTO->num_secao_eleitoral)
				  ->is_required();

		$validator->set_msg('O Endereço é obrigatório')
				  ->set('dsc_endereco', $colTO->dsc_endereco)
				  ->is_required();

		$validator->set_msg('O Número é obrigatório')
				  ->set('num_endereco', $colTO->num_endereco)
				  ->is_required();

		$validator->set_msg('O Bairro é obrigatório')
				  ->set('nme_bairro', $colTO->nme_bairro)
				  ->is_required();

		$validator->set_msg('A Cidade é obrigatória')
				  ->set('cod_cidade_moradia', $colTO->cod_cidade_moradia)
				  ->is_required();

		$validator->set_msg('O Estado é obrigatório')
				  ->set('cod_estado_moradia', $colTO->cod_estado_moradia)
				  ->is_required();

		$validator->set_msg('O CEP é obrigatório')
				  ->set('num_cep', $colTO->num_cep)
				  ->is_required();

		$validator->set_msg('A Data de Nascimento é obrigatória')
				  ->set('dta_nascimento', $colTO->dta_nascimento)
				  ->is_required();

		$validator->set_msg('A Cidade é obrigatória')
				  ->set('cod_cidade_naturalidade', $colTO->cod_cidade_naturalidade)
				  ->is_required();

		$validator->set_msg('O Estado é obrigatório')
				  ->set('cod_estado_naturalidade', $colTO->cod_estado_naturalidade)
				  ->is_required();

		$validator->set_msg('O Banco é obrigatório')
				  ->set('banco', $colTO->cod_banco)
				  ->is_required();

		$validator->set_msg('O Número da Agência é obrigatório')
				  ->set('num_agencia', $colTO->num_agencia)
				  ->is_required();

		$validator->set_msg('A Conta é obrigatória')
				  ->set('num_conta_corrente', $colTO->num_conta_corrente)
				  ->is_required();

		$validator->set_msg('O Dígito é obrigatório')
				  ->set('num_digito_conta_corrente', $colTO->num_digito_conta_corrente)
				  ->is_required();

		$validator->set_msg('O Sindicato é obrigatório')
				  ->set('sindicato', $colTO->cod_sindicato)
				  ->is_required();

		$validator->set_msg('A Grade de Horário é obrigatória')
				  ->set('gradeHorario', $colTO->cod_grade_horario)
				  ->is_required();

		 $validator->set_msg('O Local de Trabalho é obrigatório')
				  ->set('localTrabalho', $colTO->cod_local_trabalho)
				  ->is_required();

		$validator->set_msg('As Horas Contratadas são obrigatórias')
				  ->set('qtd_horas_contratadas', $colTO->qtd_horas_contratadas)
				  ->is_required();

		$validator->set_msg('O sexo é obrigatório')
				  ->set('flg_sexo', $colTO->flg_sexo)
				  ->is_required();	

		$validator->set_msg('Insira pelo menos um telefone')
				  ->set('telefones', $telefones)
				  ->is_required();

		$validator->set_msg('Insira pelo menos uma função')
				  ->set('funcoes', $funcoes)
				  ->is_required();

		$validator->set_msg('O Contrato é obrigatório')
				  ->set('contrato', $colTO->cod_contrato)
				  ->is_required();

		// ANEXOS - INICIO
		/*$validator->set_msg('A Foto é obrigatória')
				  ->set('file_foto', $colTO->files['file_foto'])
				  ->is_required();*/
		/*$validator->set_msg('O RG é obrigatório')
				  ->set('file_rg', $colTO->files['file_rg'])
				  ->is_required();

		$validator->set_msg('O CPF é obrigatório')
				  ->set('file_cpf', $colTO->files['file_cpf'])
				  ->is_required();

		$validator->set_msg('O PIS é obrigatório')
				  ->set('file_pis', $colTO->files['file_pis'])
				  ->is_required();

		$validator->set_msg('A Certidão é obrigatória')
				  ->set('file_certidao', $colTO->files['file_certidao'])
				  ->is_required();

		$validator->set_msg('O Cartão do SUS é obrigatório')
				  ->set('file_cartao_sus', $colTO->files['file_cartao_sus'])
				  ->is_required();

		$validator->set_msg('O Comprovante de Endereço é obrigatório')
				  ->set('file_comprovante_endereco', $colTO->files['file_comprovante_endereco'])
				  ->is_required();

		$validator->set_msg('O Comprovante Bancário é obrigatório')
				  ->set('file_comprovante_bancario', $colTO->files['file_comprovante_bancario'])
				  ->is_required();

		$validator->set_msg('O Contrato de Trabalho é obrigatório')
				  ->set('file_contrato_trabalho', $colTO->files['file_contrato_trabalho'])
				  ->is_required();

		$validator->set_msg('O Diploma é obrigatório')
				  ->set('file_diploma', $colTO->files['file_diploma'])
				  ->is_required();

		$validator->set_msg('O Currículo é obrigatório')
				  ->set('file_curriculo', $colTO->files['file_curriculo'])
				  ->is_required();

		$validator->set_msg('O Histórico Escolar é obrigatório')
				  ->set('file_historico_escolar', $colTO->files['file_historico_escolar'])
				  ->is_required();

		$validator->set_msg('O Título de Eleitor é obrigatório')
				  ->set('file_titulo_eleitor', $colTO->files['file_titulo_eleitor'])
				  ->is_required();

		$validator->set_msg('O CNH é obrigatório')
				  ->set('file_cnh', $colTO->files['file_cnh'])
				  ->is_required();

		$validator->set_msg('A Reservista é obrigatória')
				  ->set('file_reservista', $colTO->files['file_reservista'])
				  ->is_required();*/
		// ANEXOS - FIM
		  
		if(!$validator->validate()){ // Se retornar false, significa que algum campo obrigatório não foi preenchido
			// Envia os campos não preenchidos com a respectiva mensagem de erro para o front-end
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		// Grava os dados do colaborador
		$colaboradorDao = new ColaboradorDao();
		if(!$colTO->cod_colaborador) {
			$colTO->cod_colaborador = $colaboradorDao->saveColaborador($colTO);
			
			// Grava os telefones do colaborador
			$telefoneDao = new TelefoneDao();
			foreach ($telefones as $index => $telefone) {
				$telefoneTO = new TelefoneTO();
				$telefoneTO->cod_colaborador	= $colTO->cod_colaborador;
				$telefoneTO->num_ddd 			= $telefone['num_ddd'];
				$telefoneTO->num_telefone 		= $telefone['num_telefone'];
				$telefoneTO->cod_tipo_telefone 	= $telefone['tipoTelefone']['cod_tipo_telefone'];
				$telefoneDao->saveTelefone($telefoneTO);
			}

			// Grava os emails do colaborador
			$emailDao = new EmailDao();
			foreach ($emails as $index => $email) {
				$emailTO = new EmailTO();
				$emailTO->cod_colaborador		= $colTO->cod_colaborador;
				$emailTO->end_email 			= $email['end_email'];
				$emailDao->saveEmail($emailTO);
			}

			// Grava as funções do colaborador
			$funColDao = new FuncaoColaboradorDao();
			foreach ($funcoes as $index => $funcao) {
				$funColTO = new FuncaoColaboradorTO();
				$funColTO->cod_colaborador 				= $colTO->cod_colaborador;
				$funColTO->cod_funcao 					= $funcao['funcao']['cod_funcao'];
				$funColTO->vlr_salario 					= $funcao['vlr_salario'];
				$funColTO->nme_motivo_alteracao_funcao 	= $funcao['motivoAlteracaoFuncao']['nme_motivo_alteracao_funcao'];
				$funColTO->dta_alteracao 				= $funcao['dta_alteracao'];
				$funColDao->saveFuncaoColaborador($funColTO);
			}

			// Grava os dependentes do colaborador
			$depDao = new DependenteDao();
			foreach ($dependentes as $index => $dep) {
				$depTO = new DependenteTO();
				$depTO->cod_colaborador 				= $colTO->cod_colaborador;
				$depTO->cod_tipo_dependencia 			= $dep['tipoDependencia']['cod_tipo_dependencia'];
				$depTO->nme_dependente 					= $dep['nme_dependente'];
				// $depTO->pth_documento 					= $dep['pth_documento'];
				$depTO->dta_nascimento 					= $dep['dta_nascimento'];
				$depTO->flg_plano_saude 				= $dep['flg_plano_saude'];
				$depTO->cod_plano_saude 				= (isset($dep['planoSaude'])) ? $dep['planoSaude']['cod_plano_saude']: NULL;
				$depTO->flg_deduz_irrf 					= $dep['flg_deduz_irrf'];
				$depTO->flg_curso_superior 				= (isset($dep['flg_curso_superior'])) ? $dep['flg_curso_superior'] : 0;
				$depDao->saveDependente($depTO);
			}

			// Salva o plano de saúde do colaborador
			if($beneficioTO != null) {
				$beneficioTO->cod_colaborador = $colTO->cod_colaborador;
				$benDao = new BeneficioDao();
				if(!$benDao->saveBeneficio($beneficioTO))
					Flight::halt(500, 'Erro ao salvar o plano de saúde ['. $_POST['planoSaude']['nme_plano_saude'] .'] de ['. $colTO->nme_colaborador .']');
			}

			// Salva os anexos no banco de dados
			$anexoDao = new AnexoColaboradorDao();

			foreach ($colTO->files as $key => $file) {
				$anexoTO = new AnexoTO();
				$anexoTO->cod_colaborador 		= $colTO->cod_colaborador;
				$anexoTO->nme_anexo 			= $file['nme_anexo'];
				$anexoTO->pth_anexo 			= $file['pth_anexo'];
				$anexoTO->dsc_tipo_anexo 		= $file['dsc_tipo_anexo'];
				$anexoTO->dsc_contexto_anexo 	= $key;
				if(!$anexoDao->saveAnexoColaborador($anexoTO))
					Flight::halt(500, 'Erro ao salvar anexo [ '. $key .' ]'); die;
			}

		}
		else {
			$colaboradorDao->updateColaborador($colTO);

			// Atualizando os telefones do colaborador
			$telefoneDao = new TelefoneDao();
			foreach ($telefones as $key => $telefone) {
				if(isset($telefone['flg_removido']) && $telefone['flg_removido'] === "true") {
					if(!$telefoneDao->deleteTelefone($telefone['cod_telefone'])) {
						Flight::halt(500, 'Erro ao excluir o telefone [('. $telefone['num_ddd'].') '. $telefone['num_telefone'] .']');
						die;
					}
				}
				else if(isset($telefone['cod_telefone'])) {
					$telefoneTO = new TelefoneTO();
					$telefoneTO->cod_telefone 		= $telefone['cod_telefone'];
					$telefoneTO->num_ddd 			= $telefone['num_ddd'];
					$telefoneTO->num_telefone 		= $telefone['num_telefone'];
					$telefoneTO->cod_tipo_telefone 	= $telefone['tipoTelefone']['cod_tipo_telefone'];
					
					if(!$telefoneDao->updateTelefone($telefoneTO)) {
						Flight::halt(500, 'Erro ao atualizar o telefone [('. $telefoneTO->num_ddd.') '. $telefoneTO->num_telefone .']');
						die;
					}
				}
				else {
					$telefoneTO = new TelefoneTO();
					$telefoneTO->cod_colaborador 	= $colTO->cod_colaborador;
					$telefoneTO->num_ddd 			= $telefone['num_ddd'];
					$telefoneTO->num_telefone 		= $telefone['num_telefone'];
					$telefoneTO->cod_tipo_telefone 	= $telefone['tipoTelefone']['cod_tipo_telefone'];
					
					if(!$telefoneDao->saveTelefone($telefoneTO)) {
						Flight::halt(500, 'Erro ao salvar o telefone [('. $telefoneTO->num_ddd.') '. $telefoneTO->num_telefone .']');
						die;
					}
				}
			}

			// Atualizando os e-mails do colaborador
			$emailDao = new EmailDao();
			foreach ($emails as $key => $email) {
				if(isset($email['flg_removido']) && $email['flg_removido'] === "true") {
					if(!$emailDao->deleteEmail($email['cod_email'])) {
						Flight::halt(500, 'Erro ao excluir o email ['. $email['end_email'] .']');
						die;
					}
				}
				else if(isset($email['cod_email'])) {
					$emailTO = new EmailTO();
					$emailTO->cod_email 	= $email['cod_email'];
					$emailTO->end_email 	= $email['end_email'];
					
					if(!$emailDao->updateEmail($emailTO)) {
						Flight::halt(500, 'Erro ao atualizar o email ['. $emailTO->end_email .']');
						die;
					}
				}
				else {
					$emailTO = new EmailTO();
					$emailTO->cod_colaborador 	= $colTO->cod_colaborador;
					$emailTO->end_email 		= $email['end_email'];
					
					if(!$emailDao->saveEmail($emailTO)) {
						Flight::halt(500, 'Erro ao salvar o email ['. $emailTO->end_email .']');
						die;
					}
				}
			}

			// Atualizando as funções do colaborador
			$funcaoDao = new FuncaoColaboradorDao();
			foreach ($funcoes as $key => $funcao) { 
				if(isset($funcao['flg_removido']) && $funcao['flg_removido'] === "true") {
					if(!$funcaoDao->deleteFuncaoColaborador($funcao['cod_alteracao_funcao'])) {
						Flight::halt(500, 'Erro ao excluir a função ['. $funcao['funcao']['nme_funcao'] .']');
						die;
					}
				}
				else if(!isset($funcao['cod_alteracao_funcao'])){
					$funColTO = new FuncaoColaboradorTO();
					$funColTO->cod_colaborador 					= $colTO->cod_colaborador;
					$funColTO->cod_funcao 						= $funcao['funcao']['cod_funcao'];
					$funColTO->vlr_salario 						= $funcao['vlr_salario'];
					$funColTO->cod_motivo_alteracao_funcao 		= $funcao['motivoAlteracaoFuncao']['cod_motivo_alteracao_funcao'];
					$funColTO->dta_alteracao 					= $funcao['dta_alteracao'];
					
					if(!$funcaoDao->saveFuncaoColaborador($funColTO)) {
						Flight::halt(500, 'Erro ao salvar a funcao [('. $funColTO->cod_funcao.') ');
						die;
					}
				}
			}

			// Atualizando os dependentes do colaborador
			$depDao = new DependenteDao();
			foreach ($dependentes as $key => $dep) {
				if(isset($dep['flg_removido']) && $dep['flg_removido'] === "true") {
					if(!$depDao->deleteDependente($dep['cod_dependente'])) {
						Flight::halt(500, 'Erro ao excluir o dependente ['. $dep['nme_dependente'] .']');
						die;
					}
				}
				else if(isset($dep['flg_atualizado']) && $dep['flg_atualizado'] === "true") {
					$depTO = new DependenteTO();
					$depTO->cod_dependente 					= $dep['cod_dependente'];
					$depTO->cod_tipo_dependencia 			= $dep['tipoDependencia']['cod_tipo_dependencia'];
					$depTO->nme_dependente 					= $dep['nme_dependente'];
					// $depTO->pth_documento 					= $dep['pth_documento'];
					$depTO->dta_nascimento 					= $dep['dta_nascimento'];
					$depTO->flg_plano_saude 				= $dep['flg_plano_saude'];
					$depTO->cod_plano_saude 				= (isset($dep['planoSaude'])) ? $dep['planoSaude']['cod_plano_saude']: NULL;
					$depTO->flg_deduz_irrf 					= $dep['flg_deduz_irrf'];
					$depTO->flg_curso_superior 				= (isset($dep['flg_curso_superior'])) ? $dep['flg_curso_superior'] : 0;
					
					if($depDao->updateDependente($depTO) === false) {
						Flight::halt(500, 'Erro ao atualizar o dependente ['. $depTO->nme_dependente .']');
						die;
					}
				}
				else if(!isset($dep['cod_dependente'])) {
					$depTO = new DependenteTO();
					$depTO->cod_colaborador 				= $colTO->cod_colaborador;
					$depTO->cod_tipo_dependencia 			= $dep['tipoDependencia']['cod_tipo_dependencia'];
					$depTO->nme_dependente 					= $dep['nme_dependente'];
					// $depTO->pth_documento 					= $dep['pth_documento'];
					$depTO->dta_nascimento 					= $dep['dta_nascimento'];
					$depTO->flg_plano_saude 				= $dep['flg_plano_saude'];
					$depTO->cod_plano_saude 				= (isset($dep['planoSaude'])) ? $dep['planoSaude']['cod_plano_saude']: NULL;
					$depTO->flg_deduz_irrf 					= $dep['flg_deduz_irrf'];
					$depTO->flg_curso_superior 				= (isset($dep['flg_curso_superior'])) ? $dep['flg_curso_superior'] : 0;
					
					if(!$depDao->saveDependente($depTO)) {
						Flight::halt(500, 'Erro ao salvar o dependente ['. $depTO->nme_dependente .']');
						die;
					}
				}
			}

			// Salva o plano de saúde do colaborador
			if($beneficioTO != null) {
				$beneficioTO->cod_colaborador = $colTO->cod_colaborador;
				$benDao = new BeneficioDao();
				if(!$benDao->updateBeneficio($beneficioTO))
					Flight::halt(500, 'Erro ao atualizar o plano de saúde ['. $_POST['planoSaude']['nme_plano_saude'] .'] de ['. $colTO->nme_colaborador .']');
			}
		}

		Flight::halt(200, 'Colaborador salvo com sucesso!');
	}

	public static function getColaboradores() {
		$colaboradorDao = new ColaboradorDao();
		$colaborador = $colaboradorDao->getColaboradores($_GET);
		if($colaborador)
			Flight::json($colaborador);
		else
			Flight::halt(404, 'Nenhum colaborador encontrado.');
	}

	public static function sendDataToUpdate() {
		$destinatarios[] = array(
			"nome"	=> "Filipe Coelho",
			"email"	=> "filipe.coelho@intermultiplas.com.br"
		);
		
		
		// Atualiza a lista de telefones do colaborador
		if(isset($_POST['cooperator']['telefones'])) {
			$telefoneDao = new TelefoneDao();
			foreach ($_POST['cooperator']['telefones'] as $key => $telefone) {
				if(isset($telefone['flg_removido']) && $telefone['flg_removido'] === "true") {
					if(!$telefoneDao->deleteTelefone($telefone['cod_telefone'])) {
						Flight::halt(500, 'Erro ao excluir o telefone [('. $telefone['num_ddd'].') '. $telefone['num_telefone'] .']');
						die;
					}
				}
				else if(isset($telefone['cod_telefone'])) {
					$telefoneTO = new TelefoneTO();
					$telefoneTO->cod_telefone 		= $telefone['cod_telefone'];
					$telefoneTO->num_ddd 			= $telefone['num_ddd'];
					$telefoneTO->num_telefone 		= $telefone['num_telefone'];
					$telefoneTO->cod_tipo_telefone 	= $telefone['cod_tipo_telefone'];
					
					if(!$telefoneDao->updateTelefone($telefoneTO)) {
						Flight::halt(500, 'Erro ao atualizar o telefone [('. $telefoneTO->num_ddd.') '. $telefoneTO->num_telefone .']');
						die;
					}
				}
				else if(isset($_POST['cooperator']['cod_colaborador'])) {
					$telefoneTO = new TelefoneTO();
					$telefoneTO->cod_colaborador 	= $_POST['cooperator']['cod_colaborador'];
					$telefoneTO->num_ddd 			= $telefone['num_ddd'];
					$telefoneTO->num_telefone 		= $telefone['num_telefone'];
					$telefoneTO->cod_tipo_telefone 	= $telefone['tipoTelefone']['cod_tipo_telefone'];
					
					if(!$telefoneDao->saveTelefone($telefoneTO)) {
						Flight::halt(500, 'Erro ao salvar o telefone [('. $telefoneTO->num_ddd.') '. $telefoneTO->num_telefone .']');
						die;
					}
				}
			}
		}


		// Atualiza a lista de e-mails do colaborador
		if(isset($_POST['cooperator']['emails'])) {
			$emailDao = new EmailDao();
			foreach ($_POST['cooperator']['emails'] as $key => $email) {
				if(isset($email['flg_removido']) && $email['flg_removido'] === "true") {
					if(!$emailDao->deleteEmail($email['cod_email'])) {
						Flight::halt(500, 'Erro ao excluir o email ['. $emailTO->end_email .']');
						die;
					}
				}
				else if(isset($email['cod_email'])) {
					$emailTO = new EmailTO();
					$emailTO->cod_email 	= $email['cod_email'];
					$emailTO->end_email 	= $email['end_email'];
					
					if(!$emailDao->updateEmail($emailTO)) {
						Flight::halt(500, 'Erro ao atualizar o email ['. $emailTO->end_email .']');
						die;
					}
				}
				else if(isset($_POST['cooperator']['cod_colaborador'])) {
					$emailTO = new EmailTO();
					$emailTO->cod_colaborador 	= $_POST['cooperator']['cod_colaborador'];
					$emailTO->end_email 		= $email['end_email'];
					
					if(!$emailDao->saveEmail($emailTO)) {
						Flight::halt(500, 'Erro ao salvar o email ['. $emailTO->end_email .']');
						die;
					}
				}
			}
		}
        



        if(sendMail('[SIG BackOffice] Solicitação de Alteração de Dados', 'conferencia_dados.php', $destinatarios, $_POST))
        	Flight::halt(200, 'Dados enviado com sucesso!<br/>Alterações como E-mail e Telefone serão atualizadas no próximo login.');
        else
        	Flight::halt(500, 'Ocorreu algum erro ao tentar enviar o e-mail!<br/>Tente novamente.');
	}

	public static function deleteColaborador() {
		$colaboradorDao = new ColaboradorDao();
		
		if($colaboradorDao->deleteColaborador($_GET['cod_colaborador'], $_GET['cod_usuario']))
			Flight::halt(200, 'Colaborador excluído com sucesso!');
		else
			Flight::halt(500, 'Falha ao excluir colaborador! Contate o administrador do sistema.');
	}
}

?>