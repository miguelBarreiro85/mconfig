<?php
namespace Smile\ElasticsuiteCatalogGraphQl\Model\ResourceModel\Product;

/**
 * Factory class for @see \Smile\ElasticsuiteCatalogGraphQl\Model\ResourceModel\Product\SearchResultCollection
 */
class SearchResultCollectionFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Smile\\ElasticsuiteCatalogGraphQl\\Model\\ResourceModel\\Product\\SearchResultCollection')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Smile\ElasticsuiteCatalogGraphQl\Model\ResourceModel\Product\SearchResultCollection
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
