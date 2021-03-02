<?php
namespace Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Aggregation\Builder\DateHistogram;

/**
 * Proxy class for @see \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Aggregation\Builder\DateHistogram
 */
class Proxy extends \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Aggregation\Builder\DateHistogram implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Aggregation\Builder\DateHistogram
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Smile\\ElasticsuiteCore\\Search\\Adapter\\Elasticsuite\\Request\\Aggregation\\Builder\\DateHistogram', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Smile\ElasticsuiteCore\Search\Adapter\Elasticsuite\Request\Aggregation\Builder\DateHistogram
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function buildBucket(\Smile\ElasticsuiteCore\Search\Request\BucketInterface $bucket)
    {
        return $this->_getSubject()->buildBucket($bucket);
    }
}
