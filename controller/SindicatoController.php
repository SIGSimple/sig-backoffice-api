<?php

class SindicatoController {
	public static function getSindicatos() {
		$sindicatoDao = new SindicatoDao();
		$items = $sindicatoDao->getSindicatos($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum sindicato encontrado.');
	}
}

?>