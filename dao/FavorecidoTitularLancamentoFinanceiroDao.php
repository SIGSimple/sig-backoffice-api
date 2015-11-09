<?php
class FavorecidoTitularLancamentoFinanceiroDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveFavorecidoTitularLancamentoFinanceiro(FavorecidoTitularLancamentoFinanceiroTO $favTitLanFinTO) {
		if(!$favTitLanFinTO->cod_favorecido_fornecedor)
			$favTitLanFinTO->cod_favorecido_fornecedor = 'NULL';
		if(!$favTitLanFinTO->cod_favorecido_colaborador)
			$favTitLanFinTO->cod_favorecido_colaborador = 'NULL';
		if(!$favTitLanFinTO->cod_favorecido_terceiro)
			$favTitLanFinTO->cod_favorecido_terceiro = 'NULL';
		if(!$favTitLanFinTO->cod_titular_fornecedor)
			$favTitLanFinTO->cod_titular_fornecedor = 'NULL';
		if(!$favTitLanFinTO->cod_titular_colaborador)
			$favTitLanFinTO->cod_titular_colaborador = 'NULL';
		if(!$favTitLanFinTO->cod_titular_terceiro)
			$favTitLanFinTO->cod_titular_terceiro = 'NULL';

		$sql = "INSERT INTO tb_favorecido_titular_lancamento_financeiro (cod_lancamento_financeiro, cod_favorecido_fornecedor, cod_favorecido_colaborador, cod_favorecido_terceiro, cod_titular_fornecedor, cod_titular_colaborador, cod_titular_terceiro, cod_origem_correspondente, vlr_correspondente, dsc_observacao_adicional) 
			VALUES (". $favTitLanFinTO->cod_lancamento_financeiro .", ". $favTitLanFinTO->cod_favorecido_fornecedor .", ". $favTitLanFinTO->cod_favorecido_colaborador .", ". $favTitLanFinTO->cod_favorecido_terceiro .", ". $favTitLanFinTO->cod_titular_fornecedor .", ". $favTitLanFinTO->cod_titular_colaborador .", ". $favTitLanFinTO->cod_titular_terceiro .", ". $favTitLanFinTO->cod_origem_correspondente .", ". $favTitLanFinTO->vlr_correspondente .", '". $favTitLanFinTO->dsc_observacao_adicional ."');";

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}
}