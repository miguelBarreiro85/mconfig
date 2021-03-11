<?php
namespace Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Category\OptimizerFilter;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Category\OptimizerFilter
 */
class Interceptor extends \Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Category\OptimizerFilter implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCore\Api\Search\ContextInterface $searchContext, \Smile\ElasticsuiteCatalogOptimizer\Model\ResourceModel\Optimizer\Limitation $limitationResource)
    {
        $this->___init();
        parent::__construct($searchContext, $limitationResource);
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
