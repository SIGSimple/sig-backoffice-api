<?php

class TerceiroController {
	public static function getTerceiros() {
		$terceiroDao = new TerceiroDao();
		$items = $terceiroDao->getTerceiros($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum terceiro encontrado.');
	}
}

?>