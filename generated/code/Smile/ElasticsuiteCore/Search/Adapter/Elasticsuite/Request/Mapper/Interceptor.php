<?php
namespace Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Mapper;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Mapper
 */
class Interceptor extends \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Mapper implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Query\Builder $queryBuilder, \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\SortOrder\Builder $sortOrderBuilder, \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Aggregation\Builder $aggregationBuilder)
    {
        $this->___init();
        parent::__construct($queryBuilder, $sortOrderBuilder, $aggregationBuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function buildSearchRequest(\Smile\ElasticsuiteCore\Search\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'buildSearchRequest');
        return $pluginInfo ? $this->___callPlugins('buildSearchRequest', func_get_args(), $pluginInfo) : parent::buildSearchRequest($request);
    }
}
