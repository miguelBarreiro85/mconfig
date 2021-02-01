<?php 
namespace Mlp\StockManagement\Model;
use Magento\Framework\Model\AbstractModel;
 
 
class StockManagement extends AbstractModel{

	/**
     * @var \Magento\Framework\Stdlib\DateTime
     */
	protected $_dateTime;
	
	/**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Mlp\StockManagement\Model\ResourceModel\StockManagement::class);
    }
	/**
	 * {@inheritdoc}
	 */
	public function addProducts($sku,$quantity)
	{
		$this->setData("sku",$sku);
		$this->setData("quantity",$quantity);
		$this->getResource()->save($this);
		return 'api GET return the sku ' . $sku . 'and quantity' . $quantity;
	}
}