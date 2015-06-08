<?php
class UsuarioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getUsuarios() {
		$sql = "SELECT cod_usuario, nme_usuario, nme_login, cod_empreendimento 
				FROM tb_usuario 
				ORDER BY nme_usuario";
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0)
				return $select->fetchAll(PDO::FETCH_ASSOC);
			else
				return false;
		}
		else
			return false;
	}

	public function cadastroUsuario(UsuarioTO $usuarioTO){
		$sql = "INSERT INTO tb_usuario (nme_usuario, nme_login, nme_senha, cod_empreendimento)
		 		VALUES (:nme_usuario, :nme_login, :nme_senha, :cod_empreendimento);";
		$insert = $this->conn->prepare($sql);
		$insert->bindValue(':nme_usuario', 			$usuarioTO->nme_usuario, 		PDO::PARAM_STR);
		$insert->bindValue(':nme_login', 			$usuarioTO->nme_login, 			PDO::PARAM_STR);
		$insert->bindValue(':nme_senha', 			$usuarioTO->nme_senha, 			PDO::PARAM_STR);
		$insert->bindValue(':cod_empreendimento', 	$usuarioTO->cod_empreendimento, PDO::PARAM_STR);
		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}
}
?>