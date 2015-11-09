<?php
class LancamentoFinanceiroDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveLancamentoFinanceiro(LancamentoFinanceiroTO $lanFinTO) {
	$sql = "INSERT INTO tb_lancamento_financeiro (num_nota_fatura, num_lancamento_contabil, num_documento_banco, dsc_lancamento, vlr_previsto, vlr_realizado, dta_emissao, dta_competencia, dta_vencimento, dta_pagamento, cod_natureza_operacao, cod_conta_contabil, cod_tipo_lancamento, cod_origem_despesa, dsc_observacao) 
			VALUES (:num_nota_fatura, :num_lancamento_contabil, :num_documento_banco, :dsc_lancamento, :vlr_previsto, :vlr_realizado, :dta_emissao, :dta_competencia, :dta_vencimento, :dta_pagamento, :cod_natureza_operacao, :cod_conta_contabil, :cod_tipo_lancamento, :cod_origem_despesa, :dsc_observacao);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':num_nota_fatura', $lanFinTO->num_nota_fatura, PDO::PARAM_STR);
		$insert->bindValue(':num_lancamento_contabil', $lanFinTO->num_lancamento_contabil, PDO::PARAM_STR);
		$insert->bindValue(':num_documento_banco', $lanFinTO->num_documento_banco, PDO::PARAM_STR);
		$insert->bindValue(':dsc_lancamento', $lanFinTO->dsc_lancamento, PDO::PARAM_STR);
		$insert->bindValue(':vlr_previsto', $lanFinTO->vlr_previsto, PDO::PARAM_STR);
		$insert->bindValue(':vlr_realizado', $lanFinTO->vlr_realizado, PDO::PARAM_STR);
		$insert->bindValue(':dta_emissao', $lanFinTO->dta_emissao, PDO::PARAM_STR);
		$insert->bindValue(':dta_competencia', $lanFinTO->dta_competencia, PDO::PARAM_STR);
		$insert->bindValue(':dta_vencimento', $lanFinTO->dta_vencimento, PDO::PARAM_STR);
		$insert->bindValue(':dta_pagamento', $lanFinTO->dta_pagamento, PDO::PARAM_STR);
		$insert->bindValue(':cod_natureza_operacao', $lanFinTO->cod_natureza_operacao, PDO::PARAM_INT);
		$insert->bindValue(':cod_conta_contabil', $lanFinTO->cod_conta_contabil, PDO::PARAM_INT);
		$insert->bindValue(':cod_tipo_lancamento', $lanFinTO->cod_tipo_lancamento, PDO::PARAM_INT);
		$insert->bindValue(':cod_origem_despesa', $lanFinTO->cod_origem_despesa, PDO::PARAM_INT);
		$insert->bindValue(':dsc_observacao', $lanFinTO->dsc_observacao, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}
}