<?php

class TipoTelefoneController {
	public static function getTiposTelefone() {
		$tiposTelefoneDao = new TipoTelefoneDao();
		$items = $tiposTelefoneDao->getTiposTelefone($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum tipo de telefone encontrado.');
	}
}

?>