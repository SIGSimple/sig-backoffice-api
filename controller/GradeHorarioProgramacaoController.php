<?php

class GradeHorarioProgramacaoController {
	public static function getGradeHorarioProgramacoes() {
		$gradeHorarioProgramacaoDao = new GradeHorarioProgramacaoDao();
		$items = $gradeHorarioProgramacaoDao->getGradeHorarioProgramacoes($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma programação de grade de horário encontrada.');
	}
}

?>