<?php

class DepartamentoController {
	public static function getDepartamentos() {
		$departamentoDao = new DepartamentoDao();
		$items = $departamentoDao->getDepartamentos($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum departamento encontrado.');
	}
}

?>