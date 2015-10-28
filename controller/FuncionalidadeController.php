<?php

class FuncionalidadeController {
	public static function getFuncionalidades() {
		$dao = new FuncionalidadeDao();
		$items = $dao->getFuncionalidades($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma funcionalidade encontrada.');
	}
}

?>