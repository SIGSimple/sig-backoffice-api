<?php

class RelatorioDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function getConsolidadoNaturezaOperacao($dta_inicio, $dta_final) {
		$sql = "CALL sp_consolidado_despesa_nat_op('$dta_inicio', '$dta_final');";
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$data = $select->fetchALL(PDO::FETCH_ASSOC);

				$newData = [];
				foreach ($data as $key => $value) {
					$newData[] = array(
						'Cód. Natureza de Operação' => $value['num_item'], 
						'Natureza de Operação' => $value['dsc_item'],
						'Origem da Despesa' => $value['dsc_origem'],
						'Valor' => $value['vlr_lancamento']
					);
				}

				return $newData;
			}
			else { 
				return false;
			}
		}
		else {
			return false;
		}
	}

	public function getDistribuicaoDespesasConsorcio($dta_inicio, $dta_final) {
		$sql = "CALL sp_calcula_distribuicao_origem_despesa_consorcio('$dta_inicio', '$dta_final');";
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount() > 0) {
				return $select->fetchALL(PDO::FETCH_ASSOC);
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

}

?>