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
			"nome"	=> "Lucilia Soares",
			"email"	=> "lucilia.soares@intermultiplas.com.br"
		);
        
        if(sendMail('[SIG BackOffice] Solicitação de Alteração de Dados', 'conferencia_dados.php', $destinatarios, $_POST))
        	Flight::halt(200, '');
        else
        	Flight::halt(500, 'Ocorreu algum erro ao tentar enviar o e-mail!<br/>Tente novamente.');
	}
}

?>