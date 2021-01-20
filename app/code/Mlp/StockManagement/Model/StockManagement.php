<?php 
namespace Mlp\StockManagement\Model;
 
 
class StockManagement {

	/**
	 * {@inheritdoc}
	 */
	public function addProducts($param,$quantity)
	{
		return 'api GET return the sku ' . $param . 'and quantity' . $quantity;
	}
}