<?php
namespace Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Search\OptimizerFilter;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Search\OptimizerFilter
 */
class Interceptor extends \Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Search\OptimizerFilter implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCore\Api\Search\ContextInterface $searchContext, \Smile\ElasticsuiteCatalogOptimizer\Model\ResourceModel\Optimizer\Limitation $limitationResource, $containerName = 'quick_search_container')
    {
        $this->___init();
        parent::__construct($searchContext, $limitationResource, $containerName);
    }

    /**
     * {@inheritdoc}
     */
    public function getOptimizerIds()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOptimizerIds');
        return $pluginInfo ? $this->___callPlugins('getOptimizerIds', func_get_args(), $pluginInfo) : parent::getOptimizerIds();
    }
}
