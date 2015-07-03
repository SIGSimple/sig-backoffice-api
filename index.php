<?php

set_time_limit(0);

require_once('config/loader.php');

Flight::route('GET /', function() {
	Flight::halt(200, "<h1 style='margin-top: 30px; text-align: center;'>SIG BackOffice API Services</h1>");
});

Flight::route('GET /usuarios', 										array('UsuarioController', 'getUsuarios'));
Flight::route('POST /usuario/desbloquear/senha', 					array('UsuarioController', 'desbloquearSenhaUsuario'));
Flight::route('POST /usuario', 										array('UsuarioController', 'cadastroUsuario'));
Flight::route('POST /logar', 										array('LoginController', 'logar'));

Flight::route('GET /feriados/@num_mes/@cod_estado/@cod_cidade', 	array('FeriadoController', 'getFeriadosByMesEstadoCidade'));

Flight::route('GET /grades-horario(.json)', 						array('GradeHorarioController', 'getGradeHorarios'));
Flight::route('GET /grade-horario/programacao(.json)', 				array('GradeHorarioProgramacaoController', 'getGradeHorarioProgramacoes'));
Flight::route('GET /locais-trabalho(.json)', 						array('LocalTrabalhoController', 'getLocaisTrabalho'));
Flight::route('GET /sindicatos(.json)', 							array('SindicatoController', 'getSindicatos'));
Flight::route('GET /sindicato/hora-extra/escala(.json)', 			array('EscalaHoraExtraSindicatoController', 'getEscalaHoraExtraSindicato'));
Flight::route('GET /sindicato/hora-extra/faixa(.json)', 			array('FaixaHoraExtraSindicatoController', 'getFaixaHoraExtraSindicato'));
Flight::route('GET /funcoes(.json)', 								array('FuncaoController', 'getFuncoes'));
Flight::route('GET /entidades(.json)', 								array('EntidadeController', 'getEntidades'));
Flight::route('GET /planos-saude(.json)', 							array('PlanoSaudeController', 'getPlanosSaude'));
Flight::route('GET /tipos-registro/horario(.json)', 				array('TipoRegistroHorarioController', 'getTiposRegistroHorario'));
Flight::route('GET /dia-ponte/programacao(.json)', 					array('ProgramacaoDiaPonteController', 'getProgramacoesDiaPonte'));

Flight::route('POST /colaborador/registro/horario/update', 			array('RegistroHorarioController', 'updateRegistroHorario'));
Flight::route('POST /colaborador/registro/horario/new', 			array('RegistroHorarioController', 'setRegistroHorario'));
Flight::route('GET /colaborador/registros/horario', 				array('RegistroHorarioController', 'getRegistrosHorario'));
Flight::route('GET /colaborador/ultima/funcao/@cod_colaborador', 	array('FuncaoColaboradorController', 'getUltimaFuncao'));
Flight::route('GET /colaboradores(.json)', 							array('ColaboradorController', 'getColaboradores'));

Flight::route('GET /empreendimentos(.json)', 						array('EmpreendimentoController', 'getEmpreendimentos'));
Flight::route('GET /empresas(.json)', 								array('EmpresaController', 'getEmpresas'));
Flight::route('GET /modulos(.json)', 								array('ModuloController', 'getModulos'));
Flight::route('GET /estados(.json)', 								array('EstadoController', 'getEstados'));
Flight::route('GET /cidades(.json)', 								array('CidadeController', 'getCidades'));
Flight::route('GET /regimes-contratacao(.json)', 					array('RegimeContratacaoController', 'getRegimesContratacao'));
Flight::route('GET /departamentos(.json)',		 					array('DepartamentoController', 'getDepartamentos'));
Flight::route('GET /bancos(.json)',		 							array('BancoController', 'getBancos'));
Flight::route('GET /origens(.json)',		 						array('OrigemController', 'getOrigens'));
Flight::start();

?>