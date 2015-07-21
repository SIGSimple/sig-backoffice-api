<?php

class TipoDependenciaController {
	public static function getTiposDependencia() {
		$tiposDependenciaDao = new TipoDependenciaDao();
		$items = $tiposDependenciaDao->getTiposDependencia($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum tipo de dependencia encontrado.');
	}
}

?>