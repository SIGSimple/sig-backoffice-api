<?php

class PlanoContaController {
	public static function getPlanoContas() {
		$dao = new PlanoContaDao;
	
		$data = $dao->getPlanoContas($_GET);

		/*$itemsByReference = array();
		
		// Build array of item references:
		foreach($data as $key => &$item) {
			$itemsByReference[$item['cod_item']] = &$item;
			// Children array:
			$itemsByReference[$item['cod_item']]['children'] = array();
			// Empty data class (so that json_encode adds "data: {}" )
			$itemsByReference[$item['cod_item']]['data'] = new StdClass();
		}

		// Set items as children of the relevant parent item.
		foreach($data as $key => &$item)
			if($item['cod_item_pai'] && isset($itemsByReference[$item['cod_item_pai']]))
				$itemsByReference [$item['cod_item_pai']]['children'][] = &$item;
		
		// Remove items that were added to parents elsewhere:
		foreach($data as $key => &$item) {
			if($item['cod_item_pai'] && isset($itemsByReference[$item['cod_item_pai']]))
				unset($data[$key]);
		}*/

		Flight::json($data);
	}
}

?>