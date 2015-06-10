<?php
class ColaboradorController {
	public static function getColaboradores() {
		$colaboradorDao = new ColaboradorDao();
		$colaborador = $colaboradorDao->getColaboradores();
		if($colaborador)
			Flight::json($colaborador);
		else
			Flight::halt(404, 'Nenhum colaborador encontrado.');
	}
}
?>