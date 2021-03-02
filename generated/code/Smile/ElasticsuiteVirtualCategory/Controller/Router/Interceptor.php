<?php
namespace Smile\ElasticsuiteVirtualCategory\Controller\Router;

/**
 * Interceptor class for @see \Smile\ElasticsuiteVirtualCategory\Controller\Router
 */
class Interceptor extends \Smile\ElasticsuiteVirtualCategory\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Store\Model\StoreManagerInterface $storeManager, \Smile\ElasticsuiteVirtualCategory\Model\Url $urlModel)
    {
        $this->___init();
        parent::__construct($actionFactory, $eventManager, $storeManager, $urlModel);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request) : ?\Magento\Framework\App\ActionInterface
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
