<?php

class EmpresaController {
	public static function getEmpresas() {
		$empresaDao = new EmpresaDao();
		$empresa = $empresaDao->getEmpresas();
		if($empresa)
			Flight::json($empresa);
		else
			Flight::halt(404, 'Nenhuma empresa encontrada.');
	}
}

?>