<?php

class TipoRegistroHorarioController {
	public static function getTiposRegistroHorario() {
		$trhDao = new TipoRegistroHorarioDao();
		$items = $trhDao->getTiposRegistroHorario($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum tipo de registro encontrado.');
	}
}

?>