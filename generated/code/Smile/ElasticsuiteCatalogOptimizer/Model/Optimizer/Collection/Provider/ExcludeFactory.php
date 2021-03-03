<?php
namespace Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Collection\Provider;

/**
 * Factory class for @see \Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Collection\Provider\Exclude
 */
class ExcludeFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Smile\\ElasticsuiteCatalogOptimizer\\Model\\Optimizer\\Collection\\Provider\\Exclude')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Smile\ElasticsuiteCatalogOptimizer\Model\Optimizer\Collection\Provider\Exclude
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
