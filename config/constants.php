<?php
define('URL_BASE', baseUrl().'/sig-backoffice-web');
define('CHARSET', 'utf8');

// Constantes de configuração do banco de dados
if(serverName() == 'localhost') {
	// DESENVOLVIMENTO - LOCALHOST
	define('HOST', 		'192.168.0.13');
	define('DBNAME', 	'bd_sig_backoffice');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
	define('PATH_UPLOAD_FILES', '/Users/filipecoelho/Sites/sig-backoffice-files/');
}
else
{
	// PRODUÇÃO - AMAZON
	define('HOST', 		'192.168.0.13');
	define('DBNAME', 	'bd_sig_backoffice');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
	define('PATH_UPLOAD_FILES', '/Users/filipecoelho/Sites/sig-backoffice-files/');
}
?>