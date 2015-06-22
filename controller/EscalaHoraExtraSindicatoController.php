<?php

class EscalaHoraExtraSindicatoController
{	
	public static function getEscalaHoraExtraSindicato() {
		$ehesDao = new EscalaHoraExtraSindicatoDao();
		$items = $ehesDao->getEscalaHoraExtraSindicato($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma escala de hora extra encontrada.');
	}
}

?>