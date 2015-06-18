<?php

class PlanoSaudeController {
	public static function getPlanosSaude() {
		$planoSaudeDao = new PlanoSaudeDao();
		$items = $planoSaudeDao->getPlanosSaude($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum plano de saúde encontrado.');
	}
}

?>