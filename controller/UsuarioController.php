<?php
class UsuarioController{
	public static function getUsuarios() {
		$usuarioDao  = new UsuarioDao();
		$usuarios = $usuarioDao->getUsuarios();
		if($usuarios)
			Flight::json($usuarios);
		else
			Flight::halt(404, 'Nenhum usuário encontrado.');
	}

	public static function cadastroUsuario(){
		$usuarioTO   = new UsuarioTO();
		$usuarioDao  = new UsuarioDao();
		$validator   = new DataValidator();

		$usuarioTO->nme_usuario			= isset($_POST["nme_usuario"])  		? $_POST["nme_usuario"] 		: "" ;
		$usuarioTO->nme_login 			= isset($_POST["nme_login"]) 			? $_POST["nme_login"]			: "" ;
		$usuarioTO->nme_senha 			= isset($_POST["nme_senha"]) 			? md5($_POST["nme_senha"])		: "" ;
		$usuarioTO->cod_empreendimento 	= isset($_POST["cod_empreendimento"]) 	? $_POST["cod_empreendimento"] 	: "" ;

		$validator->set_msg('O nome é obrigatório')
				  ->set('nme_usuario', $usuarioTO->nme_usuario)
				  ->is_required();

		$validator->set_msg('O login é obrigatório')
				  ->set('nme_login', $usuarioTO->nme_login)
				  ->is_required();

		$validator->set_msg('A senha é obrigatória')
				  ->set('nme_senha', $usuarioTO->nme_senha)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		$last_id = $usuarioDao->cadastroUsuario($usuarioTO);

		$usuarioTO->id = $last_id;

		if($usuarioTO->id)
			Flight::halt(201, json_encode($usuarioTO));
		else
			Flight::halt(500, 'Usuário cadastrado com sucesso!');
	}
}
?>
