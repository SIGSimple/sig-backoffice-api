<?php
define('URL_BASE', baseUrl().'/sig-backoffice-web');
define('CHARSET', 'utf8');

// Constantes de configuração do banco de dados
if(serverName() == 'localhost') {
	// DESENVOLVIMENTO - LOCALHOST

	define('HOST', 		'mysql02.consorciointermultip.hospedagemdesites.ws');
	define('DBNAME', 	'consorciointer2');
	define('USER', 		'consorciointer2');
	define('PASSWORD', 	'f150679@Fil');
	define('PATH_UPLOAD_FILES', '/home/consorciointermultip/public_html/files/');
	
}
else
{
	// PRODUÇÃO - AMAZON
	define('HOST', 		'mysql02.consorciointermultip.hospedagemdesites.ws');
	define('DBNAME', 	'consorciointer2');
	define('USER', 		'consorciointer2');
	define('PASSWORD', 	'f150679@Fil');
	define('PATH_UPLOAD_FILES', '/home/consorciointermultip/public_html/files/');
}
?>