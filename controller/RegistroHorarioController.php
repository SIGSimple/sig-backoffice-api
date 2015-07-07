<?php

class RegistroHorarioController {

	public static function getRegistrosHorario() {
		$registroHorarioDao = new RegistroHorarioDao();
		$items = $registroHorarioDao->getRegistrosHorario($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum registro de horário encontrado');
	}

	public static function updateRegistroHorario() {
		if(isset($_POST['records'])) {
			$itemsToSave = array();

			foreach ($_POST['records'] as $index => $record) {
				$record = parse_arr_values($record, 'all');

				$registroHorarioTO   = new RegistroHorarioTO();

				$registroHorarioTO->cod_registro_horario				 		= $record["cod_registro_horario"];
				$registroHorarioTO->cod_tipo_registro_horario				 	= $record["cod_tipo_registro_horario"];
				$registroHorarioTO->hor_entrada				 					= $record["hor_entrada"];
				$registroHorarioTO->hor_saida_intervalo				 			= $record["hor_saida_intervalo"];
				$registroHorarioTO->hor_retorno_intervalo				 		= $record["hor_retorno_intervalo"];
				$registroHorarioTO->hor_saida				 					= $record["hor_saida"];
				$registroHorarioTO->hor_extra				 					= $record["hor_extra"];
				$registroHorarioTO->qtd_hora_adicional_noturno				 	= $record["qtd_hora_adicional_noturno"];
				$registroHorarioTO->qtd_hora_extra_dia_inicio				 	= $record["qtd_hora_extra_dia_inicio"];
				$registroHorarioTO->qtd_hora_extra_dia_fim				 		= $record["qtd_hora_extra_dia_fim"];
				$registroHorarioTO->qtd_horas_trabalhadas				 		= $record["qtd_horas_trabalhadas"];
				$registroHorarioTO->qtd_total_hora_extra				 		= $record["qtd_total_hora_extra"];
				$registroHorarioTO->qtd_tempo_compensacao				 		= $record["qtd_tempo_compensacao"];
				$registroHorarioTO->qtd_horas_negativas					 		= $record["qtd_horas_negativas"];
				$registroHorarioTO->flg_hora_extra				 				= $record["flg_hora_extra"];
				$registroHorarioTO->flg_terminou_mesmo_dia				 		= $record["flg_terminou_mesmo_dia"];
				$registroHorarioTO->flg_compensacao				 				= $record["flg_compensacao"];
				$registroHorarioTO->flg_feriado				 					= $record["flg_feriado"];
				$registroHorarioTO->flg_registrado				 				= $record["flg_registrado"];
				$registroHorarioTO->flg_fim_semana				 				= $record["flg_fim_semana"];
				$registroHorarioTO->nme_anexo 									= (isset($record['nme_anexo'])) 		? $record['nme_anexo'] 		: "";
				$registroHorarioTO->pth_anexo 									= (isset($record['pth_anexo'])) 		? $record['pth_anexo'] 		: "";
				$registroHorarioTO->dsc_tipo_anexo 								= (isset($record['dsc_tipo_anexo'])) 	? $record['dsc_tipo_anexo'] : "";

				array_push($itemsToSave, $registroHorarioTO);
			}

			foreach ($itemsToSave as $index => $item) {
				$registroHorarioDao = new RegistroHorarioDao();
				$item->cod_registro_horario = $registroHorarioDao->updateRegistroHorario($item);
				if(!$item->cod_registro_horario)
					Flight::halt(500, 'Erro ao atualizar os registros!');
			}

			Flight::halt(201, 'Registros atualizados com sucesso!');
		}
		else
			Flight::halt(500, 'Nenhum registro encontrado para atualizar!');
	}

	public static function setRegistroHorario() {
		if(isset($_POST['records'])) {
			$itemsToSave = array();

			foreach ($_POST['records'] as $index => $record) {
				$record = parse_arr_values($record, 'all');

				$registroHorarioTO   = new RegistroHorarioTO();

				$registroHorarioTO->cod_colaborador				 				= $record["cod_colaborador"];
				$registroHorarioTO->cod_tipo_registro_horario				 	= $record["cod_tipo_registro_horario"];
				$registroHorarioTO->dta_registro				 				= $record["dta_registro"];
				$registroHorarioTO->hor_entrada				 					= $record["hor_entrada"];
				$registroHorarioTO->hor_saida_intervalo				 			= $record["hor_saida_intervalo"];
				$registroHorarioTO->hor_retorno_intervalo				 		= $record["hor_retorno_intervalo"];
				$registroHorarioTO->hor_saida				 					= $record["hor_saida"];
				$registroHorarioTO->hor_extra				 					= $record["hor_extra"];
				$registroHorarioTO->qtd_hora_adicional_noturno				 	= $record["qtd_hora_adicional_noturno"];
				$registroHorarioTO->qtd_hora_extra_dia_inicio				 	= $record["qtd_hora_extra_dia_inicio"];
				$registroHorarioTO->qtd_hora_extra_dia_fim				 		= $record["qtd_hora_extra_dia_fim"];
				$registroHorarioTO->qtd_horas_trabalhadas				 		= $record["qtd_horas_trabalhadas"];
				$registroHorarioTO->qtd_total_hora_extra				 		= $record["qtd_total_hora_extra"];
				$registroHorarioTO->qtd_tempo_compensacao				 		= $record["qtd_tempo_compensacao"];
				$registroHorarioTO->qtd_horas_negativas				 			= $record["qtd_horas_negativas"];
				$registroHorarioTO->flg_hora_extra				 				= $record["flg_hora_extra"];
				$registroHorarioTO->flg_terminou_mesmo_dia				 		= $record["flg_terminou_mesmo_dia"];
				$registroHorarioTO->flg_compensacao				 				= $record["flg_compensacao"];
				$registroHorarioTO->flg_feriado				 					= $record["flg_feriado"];
				$registroHorarioTO->flg_registrado				 				= $record["flg_registrado"];
				$registroHorarioTO->flg_fim_semana				 				= $record["flg_fim_semana"];
				$registroHorarioTO->nme_anexo 									= $record['nme_anexo'];
				$registroHorarioTO->pth_anexo 									= $record['pth_anexo'];
				$registroHorarioTO->dsc_tipo_anexo 								= $record['dsc_tipo_anexo'];

				array_push($itemsToSave, $registroHorarioTO);
			}

			foreach ($itemsToSave as $index => $item) {
				$registroHorarioDao = new RegistroHorarioDao();
				$item->cod_registro_horario = $registroHorarioDao->setRegistroHorario($item);
				if(!$item->cod_registro_horario)
					Flight::halt(500, 'Erro ao salvar os registros!');
			}

			Flight::halt(201, 'Registros salvos com sucesso!');
		}
		else
			Flight::halt(500, 'Nenhum registro encontrado para salvar!');
	}
	
}

?>