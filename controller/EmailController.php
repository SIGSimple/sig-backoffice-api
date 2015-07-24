<?php

class EmailController {
	public static function getEmailsMensagem() {
		$emailDao = new EmailDao();
		//$items = $emailDao->getEmailsMensagem($_GET);
		$items[] = array('nme_colaborador'=>'FILIPE MENDONÇA COELHO', 'nme_login'=>'filipe.coelho', 'end_email'=>'filipe.mendonca.coelho@gmail.com');
		//$items[] = array('nme_colaborador'=>'FILIPE MENDONÇA COELHO', 'nme_login'=>'filipe.coelho', 'end_email'=>'filipe.coelho@intermultiplas.com.br');
		//$items[] = array('nme_colaborador'=>'RINALDO GUALDANI NETO', 'nme_login'=>'rinaldo.neto', 'end_email'=>'rinaldo.neto@intermultiplas.com.br');

		foreach ($items as $key => $cooperator) {
			$destinatarios = array();
			$destinatarios[] = array(
				"nome"	=> $cooperator['nme_colaborador'],
				"email"	=> $cooperator['end_email']
			);

			if(sendMail('[Consórcio Intermúltiplas] DP | Acesso a sistema informatizado', 'email-liberacao-acesso.php', $destinatarios, $cooperator))
				continue;
			else {
				echo "Erro ao enviar e-mail para [". $cooperator['nme_colaborador'] ."]:[". $cooperator['end_email'] ."]";
				break;
			}
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