<?php
namespace Smile\ElasticsuiteCore\Index\Mapping;

/**
 * Interceptor class for @see \Smile\ElasticsuiteCore\Index\Mapping
 */
class Interceptor extends \Smile\ElasticsuiteCore\Index\Mapping implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct($idFieldName, array $fields = [])
    {
        $this->___init();
        parent::__construct($idFieldName, $fields);
    }

    /**
     * {@inheritdoc}
     */
    public function asArray()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'asArray');
        return $pluginInfo ? $this->___callPlugins('asArray', func_get_args(), $pluginInfo) : parent::asArray();
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProperties');
        return $pluginInfo ? $this->___callPlugins('getProperties', func_get_args(), $pluginInfo) : parent::getProperties();
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
    public function getField($name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getField');
        return $pluginInfo ? $this->___callPlugins('getField', func_get_args(), $pluginInfo) : parent::getField($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdField()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdField');
        return $pluginInfo ? $this->___callPlugins('getIdField', func_get_args(), $pluginInfo) : parent::getIdField();
    }

    /**
     * {@inheritdoc}
     */
    public function getWeightedSearchProperties($analyzer = null, $defaultField = null, $boost = 1, ?\Smile\ElasticsuiteCore\Api\Index\Mapping\FieldFilterInterface $fieldFilter = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWeightedSearchProperties');
        return $pluginInfo ? $this->___callPlugins('getWeightedSearchProperties', func_get_args(), $pluginInfo) : parent::getWeightedSearchProperties($analyzer, $defaultField, $boost, $fieldFilter);
    }
}
