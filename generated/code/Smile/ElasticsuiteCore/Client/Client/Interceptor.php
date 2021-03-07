<?php
namespace Smile\ElasticsuiteCore\Client\Client;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCore\Client\Client
 */
class Interceptor extends \Smile\ElasticsuiteCore\Client\Client implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCore\Api\Client\ClientConfigurationInterface $clientConfiguration, \Smile\ElasticsuiteCore\Client\ClientBuilder $clientBuilder)
    {
        $this->___init();
        parent::__construct($clientConfiguration, $clientBuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function info()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'info');
        return $pluginInfo ? $this->___callPlugins('info', func_get_args(), $pluginInfo) : parent::info();
    }

    /**
     * {@inheritdoc}
     */
    public function ping()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'ping');
        return $pluginInfo ? $this->___callPlugins('ping', func_get_args(), $pluginInfo) : parent::ping();
    }

    /**
     * {@inheritdoc}
     */
    public function createIndex($indexName, $indexSettings)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createIndex');
        return $pluginInfo ? $this->___callPlugins('createIndex', func_get_args(), $pluginInfo) : parent::createIndex($indexName, $indexSettings);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteIndex($indexName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'deleteIndex');
        return $pluginInfo ? $this->___callPlugins('deleteIndex', func_get_args(), $pluginInfo) : parent::deleteIndex($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function indexExists($indexName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'indexExists');
        return $pluginInfo ? $this->___callPlugins('indexExists', func_get_args(), $pluginInfo) : parent::indexExists($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function putIndexSettings($indexName, $indexSettings)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'putIndexSettings');
        return $pluginInfo ? $this->___callPlugins('putIndexSettings', func_get_args(), $pluginInfo) : parent::putIndexSettings($indexName, $indexSettings);
    }

    /**
     * {@inheritdoc}
     */
    public function putMapping($indexName, $mapping)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'putMapping');
        return $pluginInfo ? $this->___callPlugins('putMapping', func_get_args(), $pluginInfo) : parent::putMapping($indexName, $mapping);
    }

    /**
     * {@inheritdoc}
     */
    public function getMapping($indexName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMapping');
        return $pluginInfo ? $this->___callPlugins('getMapping', func_get_args(), $pluginInfo) : parent::getMapping($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function getSettings($indexName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSettings');
        return $pluginInfo ? $this->___callPlugins('getSettings', func_get_args(), $pluginInfo) : parent::getSettings($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function forceMerge($indexName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'forceMerge');
        return $pluginInfo ? $this->___callPlugins('forceMerge', func_get_args(), $pluginInfo) : parent::forceMerge($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshIndex($indexName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'refreshIndex');
        return $pluginInfo ? $this->___callPlugins('refreshIndex', func_get_args(), $pluginInfo) : parent::refreshIndex($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function getIndicesNameByAlias($indexAlias)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndicesNameByAlias');
        return $pluginInfo ? $this->___callPlugins('getIndicesNameByAlias', func_get_args(), $pluginInfo) : parent::getIndicesNameByAlias($indexAlias);
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexAliases($params = []) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexAliases');
        return $pluginInfo ? $this->___callPlugins('getIndexAliases', func_get_args(), $pluginInfo) : parent::getIndexAliases($params);
    }

    /**
     * {@inheritdoc}
     */
    public function updateAliases($aliasActions)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'updateAliases');
        return $pluginInfo ? $this->___callPlugins('updateAliases', func_get_args(), $pluginInfo) : parent::updateAliases($aliasActions);
    }

    /**
     * {@inheritdoc}
     */
    public function bulk($bulkParams)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'bulk');
        return $pluginInfo ? $this->___callPlugins('bulk', func_get_args(), $pluginInfo) : parent::bulk($bulkParams);
    }

    /**
     * {@inheritdoc}
     */
    public function search($params)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'search');
        return $pluginInfo ? $this->___callPlugins('search', func_get_args(), $pluginInfo) : parent::search($params);
    }

    /**
     * {@inheritdoc}
     */
    public function analyze($params)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'analyze');
        return $pluginInfo ? $this->___callPlugins('analyze', func_get_args(), $pluginInfo) : parent::analyze($params);
    }

    /**
     * {@inheritdoc}
     */
    public function indexStats($indexName) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'indexStats');
        return $pluginInfo ? $this->___callPlugins('indexStats', func_get_args(), $pluginInfo) : parent::indexStats($indexName);
    }

    /**
     * {@inheritdoc}
     */
    public function termvectors($params)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'termvectors');
        return $pluginInfo ? $this->___callPlugins('termvectors', func_get_args(), $pluginInfo) : parent::termvectors($params);
    }

    /**
     * {@inheritdoc}
     */
    public function mtermvectors($params)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'mtermvectors');
        return $pluginInfo ? $this->___callPlugins('mtermvectors', func_get_args(), $pluginInfo) : parent::mtermvectors($params);
    }
}
