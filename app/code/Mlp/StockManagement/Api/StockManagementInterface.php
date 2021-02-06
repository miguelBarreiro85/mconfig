<?php 
namespace Mlp\StockManagement\Api;
 
 
interface StockManagementInterface {


	/**
	 * Post for StockManagement api
	 * @param string $sku
	 * @param int $quantity
	 * @return string
	 */
	
	public function addProducts($sku,$quantity);
}
