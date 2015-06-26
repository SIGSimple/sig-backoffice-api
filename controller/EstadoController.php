<?php

class EstadoController {
	public static function getEstados() {
		$estadoDao = new EstadoDao();
		$items = $estadoDao->getEstados($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum estado encontrado.');
	}
}

?>