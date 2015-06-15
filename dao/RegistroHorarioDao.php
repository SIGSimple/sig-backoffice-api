<?php

class RegistroHorarioDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 
	
	public function setRegistroHorario() {
		

		$sql = "INSERT INTO tb_registro_horario (cod_registro_horario, cod_colaborador, hor_entrada, hor_saida_intervalo, hor_retorno_intervalo, hor_saida, dta_registro, dta_lancamento)
		 		VALUES (:cod_registro_horario, :cod_colaborador, :hor_entrada, :hor_saida_intervalo, :hor_retorno_intervalo, :hor_saida, :dta_registro, now());";
		$insert = $this->conn->prepare($sql);
		$insert->bindValue(':cod_registro_horario', 			$usuarioTO->cod_registro_horario, 			PDO::PARAM_STR);
		$insert->bindValue(':cod_colaborador', 					$usuarioTO->cod_colaborador, 				PDO::PARAM_STR);
		$insert->bindValue(':hor_entrada', 						$usuarioTO->hor_entrada, 					PDO::PARAM_STR);
		$insert->bindValue(':hor_saida_intervalo', 				$usuarioTO->hor_saida_intervalo,			PDO::PARAM_STR);
		$insert->bindValue(':hor_retorno_intervalo', 			$usuarioTO->hor_retorno_intervalo, 			PDO::PARAM_STR);
		$insert->bindValue(':hor_saida', 						$usuarioTO->hor_saida, 						PDO::PARAM_STR);
		$insert->bindValue(':dta_registro', 					$usuarioTO->dta_registro, 					PDO::PARAM_STR);
		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}
}

?>