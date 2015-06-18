<?php

class FuncaoController {
	public static function getFuncoes() {
		$funcaoDao = new FuncaoDao();
		$items = $funcaoDao->getFuncoes($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma função encontrada.');
	}
}

?>