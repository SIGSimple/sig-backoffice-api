<?php

class FeriadoController {
	public static function getFeriadosByMesEstadoCidade($num_mes, $cod_estado, $cod_cidade) {
		$feriadoDao = new FeriadoDao();
		$feriados = $feriadoDao->getFeriadosByMesEstadoCidade($num_mes, $cod_estado, $cod_cidade);
		if($feriados)
			Flight::json($feriados);
		else
			Flight::halt(404, 'Nenhum feriado encontrado!');
	}
}

?>