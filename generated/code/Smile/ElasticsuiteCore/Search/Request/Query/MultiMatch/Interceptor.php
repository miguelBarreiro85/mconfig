<?php
namespace Smile\ElasticsuiteCore\Search\Request\Query\MultiMatch;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCore\Search\Request\Query\MultiMatch
 */
class Interceptor extends \Smile\ElasticsuiteCore\Search\Request\Query\MultiMatch implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct($queryText, array $fields, $minimumShouldMatch = '1', $tieBreaker = 1, $name = null, $boost = 1, ?\Smile\ElasticsuiteCore\Api\Search\Request\Container\RelevanceConfiguration\FuzzinessConfigurationInterface $fuzzinessConfig = null, $cutoffFrequency = null, $matchType = 'best_fields')
    {
        $this->___init();
        parent::__construct($queryText, $fields, $minimumShouldMatch, $tieBreaker, $name, $boost, $fuzzinessConfig, $cutoffFrequency, $matchType);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getName');
        return $pluginInfo ? $this->___callPlugins('getName', func_get_args(), $pluginInfo) : parent::getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getBoost()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBoost');
        return $pluginInfo ? $this->___callPlugins('getBoost', func_get_args(), $pluginInfo) : parent::getBoost();
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getType');
        return $pluginInfo ? $this->___callPlugins('getType', func_get_args(), $pluginInfo) : parent::getType();
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryText()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQueryText');
        return $pluginInfo ? $this->___callPlugins('getQueryText', func_get_args(), $pluginInfo) : parent::getQueryText();
    }

    /**
     * {@inheritdoc}
     */
    public function getFields()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFields');
        return $pluginInfo ? $this->___callPlugins('getFields', func_get_args(), $pluginInfo) : parent::getFields();
    }

    /**
     * {@inheritdoc}
     */
    public function getMinimumShouldMatch()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMinimumShouldMatch');
        return $pluginInfo ? $this->___callPlugins('getMinimumShouldMatch', func_get_args(), $pluginInfo) : parent::getMinimumShouldMatch();
    }

    /**
     * {@inheritdoc}
     */
    public function getTieBreaker()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTieBreaker');
        return $pluginInfo ? $this->___callPlugins('getTieBreaker', func_get_args(), $pluginInfo) : parent::getTieBreaker();
    }

    /**
     * {@inheritdoc}
     */
    public function getFuzzinessConfiguration()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFuzzinessConfiguration');
        return $pluginInfo ? $this->___callPlugins('getFuzzinessConfiguration', func_get_args(), $pluginInfo) : parent::getFuzzinessConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function getCutoffFrequency()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCutoffFrequency');
        return $pluginInfo ? $this->___callPlugins('getCutoffFrequency', func_get_args(), $pluginInfo) : parent::getCutoffFrequency();
    }

    /**
     * {@inheritdoc}
     */
    public function getMatchType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMatchType');
        return $pluginInfo ? $this->___callPlugins('getMatchType', func_get_args(), $pluginInfo) : parent::getMatchType();
    }
}
