<?php

class FavorecidoTitularLancamentoFinanceiroController {
	public static function getFavorecidosTitularesByCodLancamentoFinanceiro() {
		$dao = new FavorecidoTitularLancamentoFinanceiroDao();
		$items = $dao->getFavorecidosTitularesByCodLancamentoFinanceiro($_GET);
		if($items)
			Flight::json($items);
		else
			Flight::halt(404, 'Nenhum lançamento encontrado.');
	}
}

?>