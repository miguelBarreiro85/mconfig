<?php
namespace Smile\ElasticsuiteCatalog\Model\Category\Indexer\Fulltext;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCatalog\Model\Category\Indexer\Fulltext
 */
class Interceptor extends \Smile\ElasticsuiteCatalog\Model\Category\Indexer\Fulltext implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCatalog\Model\Category\Indexer\Fulltext\Action\Full $fullAction, \Magento\Framework\Indexer\SaveHandler\IndexerInterface $indexerHandler, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Search\Request\DimensionFactory $dimensionFactory)
    {
        $this->___init();
        parent::__construct($fullAction, $indexerHandler, $storeManager, $dimensionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($ids)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function executeFull()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeFull');
        return $pluginInfo ? $this->___callPlugins('executeFull', func_get_args(), $pluginInfo) : parent::executeFull();
    }

    /**
     * {@inheritdoc}
     */
    public function executeList(array $categoryIds)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeList');
        return $pluginInfo ? $this->___callPlugins('executeList', func_get_args(), $pluginInfo) : parent::executeList($categoryIds);
    }

    /**
     * {@inheritdoc}
     */
    public function executeRow($categoryId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeRow');
        return $pluginInfo ? $this->___callPlugins('executeRow', func_get_args(), $pluginInfo) : parent::executeRow($categoryId);
    }
}
