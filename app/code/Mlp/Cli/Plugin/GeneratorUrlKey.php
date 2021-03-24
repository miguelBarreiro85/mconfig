<?php

namespace Mlp\Cli\Plugin;

class GeneratorUrlKey
{
    public function aroundGetUrlKey(
        \Magento\CatalogUrlRewrite\Model\ProductUrlPathGenerator $subject,
        callable $proceed,
        \Magento\Catalog\Model\Product $product
    ) {
        $sku = $this->getProductSku($product);

        if ($sku!= '') {
            $originalProductName = $product->getName();

            $product->setName($originalProductName . ' '. $sku);
            $result = $proceed($product);
            $product->setName($originalProductName);
        } else {
            $result = $proceed($product);
        }

        return $result;
    }

    private function getProductSku(\Magento\Catalog\Model\Product $product)
    {
        return $product->getSku();
    }
}