<?php

class RegistroHorarioDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 
	
	public function getRegistrosHorario($busca=null) {
		$sql = "SELECT
					cod_registro_horario,
				    cod_colaborador,
				    cod_tipo_registro_horario,
				    dta_registro,
					hor_entrada,
					hor_saida_intervalo,
				    hor_retorno_intervalo,
				    hor_saida,
				    hor_extra,
				    dta_lancamento,
				    CAST(flg_hora_extra_valida AS UNSIGNED) AS flg_hora_extra_valida,
				    CAST(flg_falta_justificada_valida AS UNSIGNED) AS flg_falta_justificada_valida,
				    qtd_hora_adicional_noturno,
				    qtd_hora_extra_dia_inicio,
				    qtd_hora_extra_dia_fim,
				    qtd_horas_trabalhadas,
				    qtd_total_hora_extra,
				    qtd_tempo_compensacao,
				    qtd_horas_negativas,
				    CAST(flg_hora_extra AS UNSIGNED) AS flg_hora_extra,
				    CAST(flg_terminou_mesmo_dia AS UNSIGNED) AS flg_terminou_mesmo_dia,
				    CAST(flg_compensacao AS UNSIGNED) AS flg_compensacao,
				    CAST(flg_feriado AS UNSIGNED) AS flg_feriado,
				    CAST(flg_registrado AS UNSIGNED) AS flg_registrado,
				    CAST(flg_fim_semana AS UNSIGNED) AS flg_fim_semana,
				    nme_anexo,
				    pth_anexo,
				    dsc_tipo_anexo
				FROM tb_registro_horario";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$data = parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');

				foreach ($data as $key => $value) {
					$data[$key]['flg_compensacao'] = (boolean)$data[$key]['flg_compensacao'];
					$data[$key]['flg_falta_justificada_valida'] = (boolean)$data[$key]['flg_falta_justificada_valida'];
					$data[$key]['flg_feriado'] 					= (boolean)$data[$key]['flg_feriado'];
					$data[$key]['flg_fim_semana'] 				= (boolean)$data[$key]['flg_fim_semana'];
					$data[$key]['flg_hora_extra'] 				= (boolean)$data[$key]['flg_hora_extra'];
					$data[$key]['flg_hora_extra_valida'] 		= (boolean)$data[$key]['flg_hora_extra_valida'];
					$data[$key]['flg_registrado'] 				= (boolean)$data[$key]['flg_registrado'];
					$data[$key]['flg_terminou_mesmo_dia'] 		= (boolean)$data[$key]['flg_terminou_mesmo_dia'];
				}

				return $data;
			}
			else
				return false;
		}
		else
			return false;
	}

	public function updateRegistroHorario(RegistroHorarioTO $registroHorarioTO) {
		$sql = "UPDATE tb_registro_horario
				SET cod_tipo_registro_horario 		= :cod_tipo_registro_horario,
					hor_entrada 					= :hor_entrada,
					hor_saida_intervalo 			= :hor_saida_intervalo,
					hor_retorno_intervalo 			= :hor_retorno_intervalo,
					hor_saida 						= :hor_saida,
					hor_extra 						= :hor_extra,
					qtd_hora_adicional_noturno 		= :qtd_hora_adicional_noturno,
					qtd_hora_extra_dia_inicio 		= :qtd_hora_extra_dia_inicio,
					qtd_hora_extra_dia_fim 			= :qtd_hora_extra_dia_fim,
					qtd_horas_trabalhadas 			= :qtd_horas_trabalhadas,
					qtd_total_hora_extra 			= :qtd_total_hora_extra,
					qtd_tempo_compensacao 			= :qtd_tempo_compensacao,
					qtd_horas_negativas 			= :qtd_horas_negativas,
					flg_hora_extra 					= :flg_hora_extra,
					flg_terminou_mesmo_dia 			= :flg_terminou_mesmo_dia,
					flg_compensacao 				= :flg_compensacao,
					flg_feriado 					= :flg_feriado,
					flg_registrado 					= :flg_registrado,
					flg_fim_semana 					= :flg_fim_semana,
					nme_anexo 						= :nme_anexo,
					pth_anexo 						= :pth_anexo,
					dsc_tipo_anexo 					= :dsc_tipo_anexo,
					dta_ultima_alteracao 			= now()
				WHERE cod_registro_horario = :cod_registro_horario;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_registro_horario', 		$registroHorarioTO->cod_registro_horario, 			PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_registro_horario', 	$registroHorarioTO->cod_tipo_registro_horario, 		PDO::PARAM_STR);
		$insert->bindValue(':hor_entrada', 					$registroHorarioTO->hor_entrada, 					PDO::PARAM_STR);
		$insert->bindValue(':hor_saida_intervalo', 			$registroHorarioTO->hor_saida_intervalo, 			PDO::PARAM_STR);
		$insert->bindValue(':hor_retorno_intervalo', 		$registroHorarioTO->hor_retorno_intervalo, 			PDO::PARAM_STR);
		$insert->bindValue(':hor_saida', 					$registroHorarioTO->hor_saida, 						PDO::PARAM_STR);
		$insert->bindValue(':hor_extra', 					$registroHorarioTO->hor_extra, 						PDO::PARAM_STR);
		$insert->bindValue(':qtd_hora_adicional_noturno', 	$registroHorarioTO->qtd_hora_adicional_noturno, 	PDO::PARAM_INT);
		$insert->bindValue(':qtd_hora_extra_dia_inicio', 	$registroHorarioTO->qtd_hora_extra_dia_inicio, 		PDO::PARAM_INT);
		$insert->bindValue(':qtd_hora_extra_dia_fim', 		$registroHorarioTO->qtd_hora_extra_dia_fim, 		PDO::PARAM_INT);
		$insert->bindValue(':qtd_horas_trabalhadas', 		$registroHorarioTO->qtd_horas_trabalhadas, 			PDO::PARAM_INT);
		$insert->bindValue(':qtd_total_hora_extra', 		$registroHorarioTO->qtd_total_hora_extra, 			PDO::PARAM_INT);
		$insert->bindValue(':qtd_tempo_compensacao', 		$registroHorarioTO->qtd_tempo_compensacao, 			PDO::PARAM_INT);
		$insert->bindValue(':qtd_horas_negativas', 			$registroHorarioTO->qtd_horas_negativas, 			PDO::PARAM_INT);
		$insert->bindValue(':flg_hora_extra', 				$registroHorarioTO->flg_hora_extra, 				PDO::PARAM_BOOL);
		$insert->bindValue(':flg_terminou_mesmo_dia', 		$registroHorarioTO->flg_terminou_mesmo_dia, 		PDO::PARAM_BOOL);
		$insert->bindValue(':flg_compensacao', 				$registroHorarioTO->flg_compensacao, 				PDO::PARAM_BOOL);
		$insert->bindValue(':flg_feriado', 					$registroHorarioTO->flg_feriado, 					PDO::PARAM_BOOL);
		$insert->bindValue(':flg_registrado', 				$registroHorarioTO->flg_registrado, 				PDO::PARAM_BOOL);
		$insert->bindValue(':flg_fim_semana', 				$registroHorarioTO->flg_fim_semana, 				PDO::PARAM_BOOL);
		$insert->bindValue(':nme_anexo', 					$registroHorarioTO->nme_anexo, 						PDO::PARAM_STR);
		$insert->bindValue(':pth_anexo', 					$registroHorarioTO->pth_anexo, 						PDO::PARAM_STR);
		$insert->bindValue(':dsc_tipo_anexo', 				$registroHorarioTO->dsc_tipo_anexo, 				PDO::PARAM_STR);

		return $insert->execute();
	}

	public function setRegistroHorario(RegistroHorarioTO $registroHorarioTO) {
		$sql = "INSERT INTO tb_registro_horario (
					cod_colaborador, cod_tipo_registro_horario, dta_registro, hor_entrada, hor_saida_intervalo, 
					hor_retorno_intervalo, hor_saida, hor_extra, dta_lancamento, qtd_hora_adicional_noturno, 
					qtd_hora_extra_dia_inicio, qtd_hora_extra_dia_fim, qtd_horas_trabalhadas, qtd_total_hora_extra, qtd_tempo_compensacao, qtd_horas_negativas, flg_hora_extra, 
					flg_terminou_mesmo_dia, flg_compensacao, flg_feriado, flg_registrado, flg_fim_semana, nme_anexo, pth_anexo, dsc_tipo_anexo, dta_ultima_alteracao
				) VALUES (
					:cod_colaborador, :cod_tipo_registro_horario, :dta_registro, :hor_entrada, :hor_saida_intervalo, 
					:hor_retorno_intervalo, :hor_saida, :hor_extra, now(), :qtd_hora_adicional_noturno, 
					:qtd_hora_extra_dia_inicio, :qtd_hora_extra_dia_fim, :qtd_horas_trabalhadas, :qtd_total_hora_extra, :qtd_tempo_compensacao, :qtd_horas_negativas, :flg_hora_extra, 
					:flg_terminou_mesmo_dia, :flg_compensacao, :flg_feriado, :flg_registrado, :flg_fim_semana, :nme_anexo, :pth_anexo, :dsc_tipo_anexo, now()
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_colaborador', 				$registroHorarioTO->cod_colaborador, 				PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_registro_horario', 	$registroHorarioTO->cod_tipo_registro_horario, 		PDO::PARAM_STR);
		$insert->bindValue(':dta_registro', 				$registroHorarioTO->dta_registro, 					PDO::PARAM_STR);
		$insert->bindValue(':hor_entrada', 					$registroHorarioTO->hor_entrada, 					PDO::PARAM_STR);
		$insert->bindValue(':hor_saida_intervalo', 			$registroHorarioTO->hor_saida_intervalo, 			PDO::PARAM_STR);
		$insert->bindValue(':hor_retorno_intervalo', 		$registroHorarioTO->hor_retorno_intervalo, 			PDO::PARAM_STR);
		$insert->bindValue(':hor_saida', 					$registroHorarioTO->hor_saida, 						PDO::PARAM_STR);
		$insert->bindValue(':hor_extra', 					$registroHorarioTO->hor_extra, 						PDO::PARAM_STR);
		$insert->bindValue(':qtd_hora_adicional_noturno', 	$registroHorarioTO->qtd_hora_adicional_noturno, 	PDO::PARAM_INT);
		$insert->bindValue(':qtd_hora_extra_dia_inicio', 	$registroHorarioTO->qtd_hora_extra_dia_inicio, 		PDO::PARAM_INT);
		$insert->bindValue(':qtd_hora_extra_dia_fim', 		$registroHorarioTO->qtd_hora_extra_dia_fim, 		PDO::PARAM_INT);
		$insert->bindValue(':qtd_horas_trabalhadas', 		$registroHorarioTO->qtd_horas_trabalhadas, 			PDO::PARAM_INT);
		$insert->bindValue(':qtd_total_hora_extra', 		$registroHorarioTO->qtd_total_hora_extra, 			PDO::PARAM_INT);
		$insert->bindValue(':qtd_tempo_compensacao', 		$registroHorarioTO->qtd_tempo_compensacao, 			PDO::PARAM_INT);
		$insert->bindValue(':qtd_horas_negativas', 			$registroHorarioTO->qtd_horas_negativas, 			PDO::PARAM_INT);
		$insert->bindValue(':flg_hora_extra', 				$registroHorarioTO->flg_hora_extra, 				PDO::PARAM_BOOL);
		$insert->bindValue(':flg_terminou_mesmo_dia', 		$registroHorarioTO->flg_terminou_mesmo_dia, 		PDO::PARAM_BOOL);
		$insert->bindValue(':flg_compensacao', 				$registroHorarioTO->flg_compensacao, 				PDO::PARAM_BOOL);
		$insert->bindValue(':flg_feriado', 					$registroHorarioTO->flg_feriado, 					PDO::PARAM_BOOL);
		$insert->bindValue(':flg_registrado', 				$registroHorarioTO->flg_registrado, 				PDO::PARAM_BOOL);
		$insert->bindValue(':flg_fim_semana', 				$registroHorarioTO->flg_fim_semana, 				PDO::PARAM_BOOL);
		$insert->bindValue(':nme_anexo', 					$registroHorarioTO->nme_anexo, 						PDO::PARAM_STR);
		$insert->bindValue(':pth_anexo', 					$registroHorarioTO->pth_anexo, 						PDO::PARAM_STR);
		$insert->bindValue(':dsc_tipo_anexo', 				$registroHorarioTO->dsc_tipo_anexo, 				PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}
}

?>