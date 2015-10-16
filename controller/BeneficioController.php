<?php

class BeneficioController {
	public static function getBeneficiosColaborador() {
		$dao = new BeneficioDao();
		$items = $dao->getBeneficiosColaborador($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum benefício encontrado.');
	}
}

?>