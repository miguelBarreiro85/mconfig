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
            if (strcmp($filterValue[0],"2") == 0 ) {
                $items=$this->getCollection()->getItems();
                foreach ($items as $key => $item) {
                    $categories = $item->getCategoryIds();
                    if(count($categories) == 0) {
                        $this->getCollection()->removeItemByKey($key);
                    }
                }
            } 
            $this->getCollection()->addCategoriesFilter(['in' => $filter->getValue()]);
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