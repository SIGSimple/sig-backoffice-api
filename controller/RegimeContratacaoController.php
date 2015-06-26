<?php

class RegimeContratacaoController {
	public static function getRegimesContratacao() {
		$regimeContratacaoDao = new RegimeContratacaoDao();
		$items = $regimeContratacaoDao->getRegimesContratacao($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum regime de contratação encontrado.');
	}
}

?>