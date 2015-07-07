<?php

class EmailController {
	public static function getEmails() {
		$emailDao = new EmailDao();
		$items = $emailDao->getEmails($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum email encontrado.');
	}
}

?>