<?php

class ProgramacaoDiaPonteController {
	public static function getProgramacoesDiaPonte() {
		$pdpDao = new ProgramacaoDiaPonteDao();
		$items = $pdpDao->getProgramacoesDiaPonte($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma programação encontrada!');
	}
}

?>