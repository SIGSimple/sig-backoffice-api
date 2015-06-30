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
}
else
{
	// PRODUÇÃO - AMAZON
	define('HOST', 		'localhost');
	define('DBNAME', 	'bd_sig_backoffice');
	define('USER', 		'root');
	define('PASSWORD', 	'150679');
}
?>