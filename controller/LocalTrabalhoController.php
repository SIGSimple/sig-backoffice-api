<?php

class LocalTrabalhoController {
	public static function getLocaisTrabalho() {
		$localTrabalhoDao = new LocalTrabalhoDao();
		$items = $localTrabalhoDao->getLocaisTrabalho($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum local de trabalho encontrado.');
	}
}

?>