<?php

class OrigemController {
	public static function getOrigens() {
		$origemDao = new OrigemDao();
		$origem = $origemDao->getOrigens($_GET);
		if($origem)
			Flight::json($origem);
		else
			Flight::halt(404, 'Nenhuma origem encontrada.');
	}
}

?>