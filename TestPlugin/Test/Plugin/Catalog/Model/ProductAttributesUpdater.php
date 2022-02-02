<?php
namespace TestPlugin\Test\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;

class ProductAttributesUpdater
{

public function afterGetName(Product $subject, $result)
    {
        //$title=$subject->_getResource()->getAttribute('brand');
        $title=$subject->getData('brandname');

        //$title = $subject->getAttributeText('brand');
        
        return $title . "  - " .$result;

        
    }

}
?>