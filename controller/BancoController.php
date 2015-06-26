<?php

class BancoController {
	public static function getBancos() {
		$bancoDao = new BancoDao();
		$items = $bancoDao->getBancos($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum banco encontrado.');
	}
}

?>