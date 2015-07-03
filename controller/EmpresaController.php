<?php

class EmpresaController {
	public static function getEmpresas() {
		$empresaDao = new EmpresaDao();
		$empresa = $empresaDao->getEmpresas($_GET);
		if($empresa)
			Flight::json($empresa);
		else
			Flight::halt(404, 'Nenhuma empresa encontrada.');
	}
}

?>