<?php
namespace Magento\CatalogUrlRewrite\Model\ProductUrlPathGenerator;

/**
 * Interceptor class for @see \Magento\CatalogUrlRewrite\Model\ProductUrlPathGenerator
 */
class Interceptor extends \Magento\CatalogUrlRewrite\Model\ProductUrlPathGenerator implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator $categoryUrlPathGenerator, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository)
    {
        $this->___init();
        parent::__construct($storeManager, $scopeConfig, $categoryUrlPathGenerator, $productRepository);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlPath($product, $category = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrlPath');
        return $pluginInfo ? $this->___callPlugins('getUrlPath', func_get_args(), $pluginInfo) : parent::getUrlPath($product, $category);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlPathWithSuffix($product, $storeId, $category = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrlPathWithSuffix');
        return $pluginInfo ? $this->___callPlugins('getUrlPathWithSuffix', func_get_args(), $pluginInfo) : parent::getUrlPathWithSuffix($product, $storeId, $category);
    }

    /**
     * {@inheritdoc}
     */
    public function getCanonicalUrlPath($product, $category = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCanonicalUrlPath');
        return $pluginInfo ? $this->___callPlugins('getCanonicalUrlPath', func_get_args(), $pluginInfo) : parent::getCanonicalUrlPath($product, $category);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlKey($product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrlKey');
        return $pluginInfo ? $this->___callPlugins('getUrlKey', func_get_args(), $pluginInfo) : parent::getUrlKey($product);
    }
}
