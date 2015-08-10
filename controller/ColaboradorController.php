<?php

class ColaboradorController {
	public static function getColaboradores() {
		$colaboradorDao = new ColaboradorDao();
		$colaborador = $colaboradorDao->getColaboradores($_GET);
		if($colaborador)
			Flight::json($colaborador);
		else
			Flight::halt(404, 'Nenhum colaborador encontrado.');
	}

	public static function sendDataToUpdate() {
		$destinatarios[] = array(
			"nome"	=> "Filipe Coelho",
			"email"	=> "filipe.coelho@intermultiplas.com.br"
		);
		/*$destinatarios[] = array(
			"nome"	=> "Rinaldo Gualdani Neto",
			"email"	=> "rinaldo.neto@intermultiplas.com.br"
		);*/
        
        if(sendMail('[SIG BackOffice] Solicitação de Alteração de Dados', 'conferencia_dados.php', $destinatarios, $_POST))
        	Flight::halt(200, 'Dados enviado com sucesso!');
        else
        	Flight::halt(500, 'Ocorreu algum erro ao tentar enviar o e-mail!<br/>Tente novamente.');
	}
}

?>