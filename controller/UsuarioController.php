<?php
class UsuarioController{
	public static function getUsuarios() {
		$usuarioDao  = new UsuarioDao();
		$usuarios = $usuarioDao->getUsuarios($_GET);
		if($usuarios)
			Flight::json($usuarios);
		else
			Flight::halt(404, 'Nenhum usuário encontrado.');
	}
}
?>