<?php

class AnexoColaboradorDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveAnexoColaborador(AnexoColaboradorTO $anexoTO) {
		$sql = "INSERT INTO tb_anexo_colaborador (cod_colaborador, nme_anexo, pth_anexo, dsc_tipo_anexo, dsc_contexto_anexo) 
				VALUES (:cod_colaborador, :nme_anexo, :pth_anexo, :dsc_tipo_anexo, :dsc_contexto_anexo);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue('cod_colaborador', $anexoTO->cod_colaborador, PDO::PARAM_INT);
		$insert->bindValue('nme_anexo', $anexoTO->nme_anexo, PDO::PARAM_STR);
		$insert->bindValue('pth_anexo', $anexoTO->pth_anexo, PDO::PARAM_STR);
		$insert->bindValue('dsc_tipo_anexo', $anexoTO->dsc_tipo_anexo, PDO::PARAM_STR);
		$insert->bindValue('dsc_contexto_anexo', $anexoTO->dsc_contexto_anexo, PDO::PARAM_STR) 

		return $insert->execute();
	}

}
?>