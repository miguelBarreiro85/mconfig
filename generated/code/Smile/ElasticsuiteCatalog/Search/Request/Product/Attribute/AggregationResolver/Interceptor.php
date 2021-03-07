<?php
namespace Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationResolver;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationResolver
 */
class Interceptor extends \Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationResolver implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationInterface $defaultAggregation, array $aggregations = [])
    {
        $this->___init();
        parent::__construct($defaultAggregation, $aggregations);
    }

    /**
     * {@inheritdoc}
     */
    public function getAggregationData(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAggregationData');
        return $pluginInfo ? $this->___callPlugins('getAggregationData', func_get_args(), $pluginInfo) : parent::getAggregationData($attribute);
    }
}
