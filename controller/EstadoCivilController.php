<?php

class EstadoCivilController {
	public static function getEstadosCivis() {
		$dao = new EstadoCivilDao();
		$items = $dao->getEstadosCivis($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum estado civil encontrada.');
	}
}

?>