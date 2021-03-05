<?php
namespace Smile\ElasticsuiteTracker\Model\Event\Mapping\TypeEnforcer;

/**
 * Factory class for @see \Smile\ElasticsuiteTracker\Model\Event\Mapping\TypeEnforcer\Integer
 */
class IntegerFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Smile\\ElasticsuiteTracker\\Model\\Event\\Mapping\\TypeEnforcer\\Integer')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Smile\ElasticsuiteTracker\Model\Event\Mapping\TypeEnforcer\Integer
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
