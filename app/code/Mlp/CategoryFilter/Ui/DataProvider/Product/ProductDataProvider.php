<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Mlp\CategoryFilter\Ui\DataProvider\Product;

use function Aws\filter;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class ProductDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    /**
     * For filter grid according to category
     * @param \Magento\Framework\Api\Filter $filter
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        if ($filter->getField() == 'category_id') {    
            $filterValue = $filter->getValue();
            //Alerar o codigo se for root para dar as que não têm categorias
            if (strcmp($filterValue[0],"2") == 0 ) {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $categoryCollection = $objectManager->get(CategoryCollectionFactory::class);
                $catIds = $categoryCollection->create()->getAllIds();
                $key = array_search("2",$catIds);
                unset($catIds[$key]);
                $this->getCollection()->addCategoriesFilter(['nin' => $catIds]);
            } else {
                $this->getCollection()->addCategoriesFilter(['in' => $filter->getValue()]);
            }
        } elseif (isset($this->addFilterStrategies[$filter->getField()])) {
            $this->addFilterStrategies[$filter->getField()]
                ->addFilter(
                    $this->getCollection(),
                    $filter->getField(),
                    [$filter->getConditionType() => $filter->getValue()]
                );
        } else {
            parent::addFilter($filter);
        }
    }
}