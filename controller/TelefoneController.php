<?php

class TelefoneController {
	public static function getTelefones() {
		$telefoneDao = new TelefoneDao();
		$items = $telefoneDao->getTelefones($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum telefone encontrado.');
	}
}

?>