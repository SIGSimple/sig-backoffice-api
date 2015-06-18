<?php

class EntidadeController {
	public static function getEntidades() {
		$entidadeDao = new EntidadeDao();
		$items = $entidadeDao->getEntidades($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma entidade encontrada.');
	}
}

?>