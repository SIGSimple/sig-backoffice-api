<?php
define('URL_BASE', baseUrl().'/sig-backoffice-web');
define('CHARSET', 'utf8');

// Constantes de configuração do banco de dados
if(serverName() == 'localhost') {
	// DESENVOLVIMENTO - LOCALHOST
	define('HOST', 		'192.168.0.10');
	define('DBNAME', 	'consorciointer2');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
	define('PATH_UPLOAD_FILES', '/Users/filipecoelho/Sites/sig-backoffice-files/');
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