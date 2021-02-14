<?php
namespace Smile\ElasticsuiteCore\Search\Request\Query\Builder;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCore\Search\Request\Query\Builder
 */
class Interceptor extends \Smile\ElasticsuiteCore\Search\Request\Query\Builder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Smile\ElasticsuiteCore\Search\Request\Query\QueryFactory $queryFactory, \Smile\ElasticsuiteCore\Search\Request\Query\Fulltext\QueryBuilder $fulltextQueryBuilder, \Smile\ElasticsuiteCore\Search\Request\Query\Filter\QueryBuilder $filterQuerybuilder)
    {
        $this->___init();
        parent::__construct($queryFactory, $fulltextQueryBuilder, $filterQuerybuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function createQuery(\Smile\ElasticsuiteCore\Api\Search\Request\ContainerConfigurationInterface $containerConfiguration, $query, array $filters, $spellingType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createQuery');
        return $pluginInfo ? $this->___callPlugins('createQuery', func_get_args(), $pluginInfo) : parent::createQuery($containerConfiguration, $query, $filters, $spellingType);
    }

    /**
     * {@inheritdoc}
     */
    public function createFilterQuery(\Smile\ElasticsuiteCore\Api\Search\Request\ContainerConfigurationInterface $containerConfiguration, array $filters)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createFilterQuery');
        return $pluginInfo ? $this->___callPlugins('createFilterQuery', func_get_args(), $pluginInfo) : parent::createFilterQuery($containerConfiguration, $filters);
    }

    /**
     * {@inheritdoc}
     */
    public function createFulltextQuery(\Smile\ElasticsuiteCore\Api\Search\Request\ContainerConfigurationInterface $containerConfiguration, $queryText, $spellingType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createFulltextQuery');
        return $pluginInfo ? $this->___callPlugins('createFulltextQuery', func_get_args(), $pluginInfo) : parent::createFulltextQuery($containerConfiguration, $queryText, $spellingType);
    }

    /**
     * {@inheritdoc}
     */
    public function createFilters(\Smile\ElasticsuiteCore\Api\Search\Request\ContainerConfigurationInterface $containerConfiguration, array $filters)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createFilters');
        return $pluginInfo ? $this->___callPlugins('createFilters', func_get_args(), $pluginInfo) : parent::createFilters($containerConfiguration, $filters);
    }
}
