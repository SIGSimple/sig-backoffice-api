<?php

class MotivoAlteracaoFuncaoController {
	public static function getMotivosAlteracaoFuncao() {
		$motivoAlteracaoFuncaoDao = new MotivoAlteracaoFuncaoDao();
		$items = $motivoAlteracaoFuncaoDao->getMotivosAlteracaoFuncao($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma motivo de alteração de função foi encontrado.');
	}
}

?>