<?php
namespace Magento\Search\Model\QueryFactory;

/**
 * Interceptor class for @see \Magento\Search\Model\QueryFactory
 */
class Interceptor extends \Magento\Search\Model\QueryFactory implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Stdlib\StringUtils $string, ?\Magento\Search\Helper\Data $queryHelper = null)
    {
        $this->___init();
        parent::__construct($context, $objectManager, $string, $queryHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'get');
        return $pluginInfo ? $this->___callPlugins('get', func_get_args(), $pluginInfo) : parent::get();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'create');
        return $pluginInfo ? $this->___callPlugins('create', func_get_args(), $pluginInfo) : parent::create($data);
    }
}
