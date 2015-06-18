<?php

set_time_limit(0);

require_once('config/loader.php');

Flight::route('GET /', function() {
	Flight::halt(200, "<h1 style='margin-top: 30px; text-align: center;'>SIG BackOffice API Services</h1>");
});

Flight::route('GET /usuarios', 							array('UsuarioController', 'getUsuarios'));
Flight::route('POST /usuario', 							array('UsuarioController', 'cadastroUsuario'));
Flight::route('POST /logar', 							array('LoginController', 'logar'));
Flight::route('POST /horario/new', 						array('RegistroHorarioController', 'setRegistroHorario'));

Flight::route('GET /grades-horario(.json)', 			array('GradeHorarioController', 'getGradeHorarios'));
Flight::route('GET /grade-horario/programacao(.json)', 	array('GradeHorarioProgramacaoController', 'getGradeHorarioProgramacoes'));
Flight::route('GET /locais-trabalho(.json)', 			array('LocalTrabalhoController', 'getLocaisTrabalho'));
Flight::route('GET /sindicatos(.json)', 				array('SindicatoController', 'getSindicatos'));
Flight::route('GET /funcoes(.json)', 					array('FuncaoController', 'getFuncoes'));
Flight::route('GET /entidades(.json)', 					array('EntidadeController', 'getEntidades'));
Flight::route('GET /planos-saude(.json)', 				array('PlanoSaudeController', 'getPlanosSaude'));
Flight::route('GET /colaboradores(.json)', 				array('ColaboradorController', 'getColaboradores'));
Flight::route('GET /empreendimentos(.json)', 			array('EmpreendimentoController', 'getEmpreendimentos'));
Flight::route('GET /empresas(.json)', 					array('EmpresaController', 'getEmpresas'));
Flight::route('GET /modulos(.json)', 					array('ModuloController', 'getModulos'));

Flight::start();

?>