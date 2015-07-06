<?php
define('URL_BASE', baseUrl().'/sig-backoffice-web');
define('CHARSET', 'utf8');

// Constantes de configuração do banco de dados
if(serverName() == 'localhost') {
	// DESENVOLVIMENTO - LOCALHOST
	define('HOST', 		'localhost');
	define('DBNAME', 	'bd_sig_backoffice');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
	define('PATH_UPLOAD_FILES', '/Users/filipecoelho/Sites/sig-backoffice-files/');
}
else
{
	// PRODUÇÃO - AMAZON
	define('HOST', 		'mysql01.consorciointermultip.hospedagemdesites.ws');
	define('DBNAME', 	'consorciointer1');
	define('USER', 		'consorciointer1');
	define('PASSWORD', 	'f150679@Fil');
	define('PATH_UPLOAD_FILES', '/home/consorciointermultip/public_html/files/');
}
?>