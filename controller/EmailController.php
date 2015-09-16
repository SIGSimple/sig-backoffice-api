<?php

class EmailController {
	public static function getEmailsMensagem() {
		$emailDao = new EmailDao();
		$items = $emailDao->getEmailsMensagem($_GET);

		// TESTE
		/*
		$items[] = array('nme_colaborador'=>'FILIPE MENDONÇA COELHO', 'nme_login'=>'filipe.coelho', 'end_email'=>'filipe.mendonca.coelho@gmail.com');
		$items[] = array('nme_colaborador'=>'FILIPE MENDONÇA COELHO', 'nme_login'=>'filipe.coelho', 'end_email'=>'filipe.coelho@intermultiplas.com.br');
		$items[] = array('nme_colaborador'=>'RINALDO GUALDANI NETO', 'nme_login'=>'rinaldo.neto', 'end_email'=>'rinaldo.neto@intermultiplas.com.br');
		*/

		foreach ($items as $key => $cooperator) {
			$destinatarios = array();
			$destinatarios[] = array(
				"nome"	=> $cooperator['nme_colaborador'],
				"email"	=> $cooperator['end_email']
			);
			
			// TESTE
			//echo "Enviar e-mail para [". $cooperator['nme_colaborador'] ."]:[". $cooperator['end_email'] ."]<br>";
			
			if(sendMail('[SIG BackOffice] - Instabilidade de Acesso e Registro de Ponto', 'instabilidade-internet.php', $destinatarios, $cooperator))
				continue;
			else
				Flight::halt(500, "Erro ao enviar e-mail para [". $cooperator['nme_colaborador'] ."]:[". $cooperator['end_email'] ."]");
		}

		Flight::halt(200, 'E-mails enviados com sucesso!');
	}
	
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