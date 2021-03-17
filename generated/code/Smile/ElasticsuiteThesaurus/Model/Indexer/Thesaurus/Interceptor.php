<?php
namespace Smile\ElasticsuiteThesaurus\Model\Indexer\Thesaurus;

/**
 * Interceptor class for @see \Smile\ElasticsuiteThesaurus\Model\Indexer\Thesaurus
 */
class Interceptor extends \Smile\ElasticsuiteThesaurus\Model\Indexer\Thesaurus implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteThesaurus\Model\ResourceModel\Indexer\Thesaurus $resourceModel, \Magento\Store\Model\StoreManagerInterface $storeManager, \Smile\ElasticsuiteThesaurus\Model\Indexer\IndexHandler $indexHandler)
    {
        $this->___init();
        parent::__construct($resourceModel, $storeManager, $indexHandler);
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
    public function executeList(array $ids)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeList');
        return $pluginInfo ? $this->___callPlugins('executeList', func_get_args(), $pluginInfo) : parent::executeList($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function executeRow($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeRow');
        return $pluginInfo ? $this->___callPlugins('executeRow', func_get_args(), $pluginInfo) : parent::executeRow($id);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($ids)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($ids);
    }
}
