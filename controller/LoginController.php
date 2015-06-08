<?php
class LoginController {
	public static function logar(){
		$nme_login = isset($_POST['nme_login']) ? $_POST['nme_login'] : "" ;
		$nme_senha = isset($_POST['nme_senha']) ? $_POST['nme_senha'] : "" ;

		$validator = new DataValidator();

		$validator->set_msg('O login é obrigatório')
				  ->set('nme_login' ,$nme_login)
				  ->is_required();

		$validator->set_msg('A senha é obrigatória')
				  ->set('nme_senha' ,$nme_senha)
				  ->is_required();

		if(!$validator->validate()){
			Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode($validator->get_errors()))
							  ->send();
			return ;
		}

		try {
			$loginDao = new LoginDao();

			$usuario = $loginDao->logar($nme_login, md5($nme_senha));

			if($usuario)
				Flight::json($usuario);
			else{
				Flight::response()->status(406)
							  ->header('Content-Type', 'application/json')
							  ->write(json_encode(array("msg"=>"Login ou Senha inválidos!")))
							  ->send();
			}
		} catch(PDOException $e) {
			Flight::halt(500, $e->getMessage());
		}
	}
}
?>
