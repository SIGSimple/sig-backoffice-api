<?php

class FuncaoColaboradorController {
	public static function getUltimaFuncao($cod_colaborador) {
		$funcaoColaboradorDao = new FuncaoColaboradorDao();
		$items = $funcaoColaboradorDao->getUltimaFuncao($cod_colaborador);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma função encontrada para o colaborador.');
	}
}

?>