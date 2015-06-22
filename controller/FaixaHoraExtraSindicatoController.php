<?php

class FaixaHoraExtraSindicatoController
{	
	public static function getFaixaHoraExtraSindicato() {
		$ehesDao = new FaixaHoraExtraSindicatoDao();
		$items = $ehesDao->getFaixaHoraExtraSindicato($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma escala de hora extra encontrada.');
	}
}

?>