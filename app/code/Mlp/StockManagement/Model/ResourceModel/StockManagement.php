<?php
namespace Mlp\StockManagement\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Contact Resource Model
 *
 * @author     Miguel Barreorp
 */
class StockManagement extends AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('mlp_stock_management', 'mlp_stock_id');
    }
}