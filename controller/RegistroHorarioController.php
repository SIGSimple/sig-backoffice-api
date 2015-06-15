<?php
class RegistroHorarioController{
	public static function setRegistroHorario() {
		$registroHorarioDao  = new RegistroHorarioDao();
		$registroHorario = $registroHorarioDao->setRegistroHorario();
		if($registroHorario)
			Flight::json($registroHorario);
		else
			Flight::halt(404, 'Nenhum registro de horário encontrado.');
	}

	public static function setRegistroHorario(){
		$registroHorarioTO   = new RegistroHorarioTO();
		$registroHorarioDao  = new RegistroHorarioDao();
		$validator 			 = new DataValidator();

		$registroHorarioTO->cod_colaborador				= isset($_POST["cod_colaborador"])  		? $_POST["cod_colaborador"] 		: "" ;
		$registroHorarioTO->hor_entrada 				= isset($_POST["hor_entrada"]) 				? $_POST["hor_entrada"]			: "" ;
		$registroHorarioTO->hor_saida_intervalo 		= isset($_POST["hor_saida_intervalo"]) 		? ($_POST["hor_saida_intervalo"])		: "" ;
		$registroHorarioTO->hor_retorno_intervalo 		= isset($_POST["hor_retorno_intervalo"]) 	? $_POST["hor_retorno_intervalo"] 	: "" ;
		$registroHorarioTO->hor_saida 					= isset($_POST["hor_saida"]) 				? $_POST["hor_saida"] 	: "" ;
		$registroHorarioTO->dta_registro 				= isset($_POST["dta_registro"]) 			? $_POST["dta_registro"] 	: "" ;
		$registroHorarioTO->dta_lancamento 				= isset($_POST["dta_lancamento"]) 			? $_POST["dta_lancamento"] 	: "" ;



 		$validator->set_msg('O código do colaborador é obrigatório')
				  ->set('cod_colaborador', $registroHorarioTO->cod_colaborador)
				  ->is_required();

		$validator->set_msg('O horário de entrada é obrigatório')
				  ->set('hor_entrada', $registroHorarioTO->hor_entrada)
				  ->is_required();

		$validator->set_msg('O horário de saída é obrigatório')
				  ->set('hor_saida_intervalo', $registroHorarioTO->hor_saida_intervalo)
				  ->is_required();

		$validator->set_msg('O horário de retorno é obrigatório')
				  ->set('hor_retorno_intervalo', $registroHorarioTO->hor_retorno_intervalo)
				  ->is_required();

	  $validator->set_msg('A hora de saída é obrigatória')
				  ->set('hor_saida', $registroHorarioTO->hor_saida)
				  ->is_required();

	  $validator->set_msg('A data de reigstro é obrigatória')
				  ->set('dta_registro', $registroHorarioTO->dta_registro)
				  ->is_required();

	   $validator->set_msg('A data de lançameto é obrigatória')
				  ->set('dta_lancamento', $registroHorarioTO->dta_lancamento)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		$last_id = $registroHorarioDao->setRegistroHorario($registroHorarioTO);

		$registroHorarioTO->id = $last_id;

		if($registroHorarioTO->id)
			Flight::halt(201, json_encode($registroHorarioTO));
		else
			Flight::halt(500, 'Horário cadastrado com sucesso!');
	}
}
?>