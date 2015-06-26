<?php

class CidadeController {
	public static function getCidades() {
		$cidadeDao = new CidadeDao();
		$items = $cidadeDao->getCidades($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma cidade encontrada.');
	}
}

?>