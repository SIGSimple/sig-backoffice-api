<?php

class GradeHorarioController {
	public static function getGradeHorarios() {
		$gradeHorarioDao = new GradeHorarioDao();
		$items = $gradeHorarioDao->getGradeHorarios($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhuma grade de horário encontrada.');
	}
}

?>