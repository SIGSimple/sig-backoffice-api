<?php

class EmpreendimentoController {
	public static function getEmpreendimentos() {
		$empreendimentoDao = new EmpreendimentoDao();
		$empreendimento = $empreendimentoDao->getEmpreendimentos();
		if($empreendimento)
			Flight::json($empreendimento);
		else
			Flight::halt(404, 'Nenhum empreendimento encontrado.');
	}
}

?>