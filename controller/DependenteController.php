<?php

class DependenteController {
	public static function getDependentes() {
		$dependenteDao = new DependenteDao();
		$items = $dependenteDao->getDependentes($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum dependente encontrado.');
	}
}

?>