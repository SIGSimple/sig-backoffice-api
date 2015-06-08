<?php

set_time_limit(0);

require_once('config/loader.php');

Flight::route('GET /', function() {
	Flight::halt(200, "<h1 style='margin-top: 30px; text-align: center;'>SIG BackOffice API Services</h1>");
});

Flight::route('GET /usuarios', array('UsuarioController', 'getUsuarios'));
Flight::route('POST /usuario', array('UsuarioController', 'cadastroUsuario'));
Flight::route('POST /logar', array('LoginController', 'logar'));

Flight::start();

?>
